<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Response\Converter;

use Generated\Shared\Transfer\CrefoPayApiErrorResponseTransfer;
use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;
use SprykerEco\Zed\CrefoPayApi\Business\Response\Mapper\CrefoPayApiResponseMapperInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Response\Validator\CrefoPayApiResponseValidatorInterface;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface;
use SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface;

class CrefoPayApiResponseConverter implements CrefoPayApiResponseConverterInterface
{
    /**
     * @var string
     */
    protected const API_ERROR_TYPE_EXTERNAL = 'EXTERNAL';
    /**
     * @var string
     */
    protected const EXTERNAL_ERROR_MESSAGE = 'CrefoPay service temporarily unavailable.';

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface
     */
    protected $encodingService;

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Business\Response\Mapper\CrefoPayApiResponseMapperInterface
     */
    protected $responseMapper;

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Business\Response\Validator\CrefoPayApiResponseValidatorInterface
     */
    protected $responseValidator;

    /**
     * @param \SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface $encodingService
     * @param \SprykerEco\Zed\CrefoPayApi\Business\Response\Mapper\CrefoPayApiResponseMapperInterface $responseMapper
     * @param \SprykerEco\Zed\CrefoPayApi\Business\Response\Validator\CrefoPayApiResponseValidatorInterface $responseValidator
     */
    public function __construct(
        CrefoPayApiToUtilEncodingServiceInterface $encodingService,
        CrefoPayApiResponseMapperInterface $responseMapper,
        CrefoPayApiResponseValidatorInterface $responseValidator
    ) {
        $this->encodingService = $encodingService;
        $this->responseMapper = $responseMapper;
        $this->responseValidator = $responseValidator;
    }

    /**
     * @param \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface $response
     * @param bool $isSuccess
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function convertToResponseTransfer(
        CrefoPayApiGuzzleResponseInterface $response,
        bool $isSuccess = true
    ): CrefoPayApiResponseTransfer {
        $responseData = $this->encodingService->decodeJson($response->getResponseBody(), true);
        $responseTransfer = $this->createResponseTransfer($isSuccess);

        if (!$isSuccess || !$this->responseValidator->validateResponse($response, $responseData)) {
            return $this->updateResponseTransferWithError($responseTransfer, $responseData);
        }

        return $this->responseMapper
            ->mapResponseDataToResponseTransfer($responseData, $responseTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     * @param array|null $responseData
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    protected function updateResponseTransferWithError(
        CrefoPayApiResponseTransfer $responseTransfer,
        ?array $responseData
    ): CrefoPayApiResponseTransfer {
        $errorTransfer = (new CrefoPayApiErrorResponseTransfer())
            ->setMessage(static::EXTERNAL_ERROR_MESSAGE)
            ->setErrorType(static::API_ERROR_TYPE_EXTERNAL);

        if ($responseData !== null) {
            $errorTransfer->fromArray($responseData, true);
        }

        return $responseTransfer
            ->setIsSuccess(false)
            ->setError($errorTransfer);
    }

    /**
     * @param bool $isSuccess
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    protected function createResponseTransfer(bool $isSuccess): CrefoPayApiResponseTransfer
    {
        return (new CrefoPayApiResponseTransfer())
            ->setIsSuccess($isSuccess);
    }
}
