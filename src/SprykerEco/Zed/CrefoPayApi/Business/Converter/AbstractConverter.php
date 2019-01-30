<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Converter;

use Generated\Shared\Transfer\CrefoPayApiErrorResponseTransfer;
use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;
use SprykerEco\Shared\CrefoPayApi\CrefoPayApiConfig;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface;
use SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface;

abstract class AbstractConverter implements CrefoPayApiConverterInterface
{
    protected const EXTERNAL_ERROR_MESSAGE = 'CrefoPay service temporarily unavailable.';

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface
     */
    protected $encodingService;

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     * @param array $responseData
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    abstract protected function updateResponseTransferWithApiCallResponse(
        CrefoPayApiResponseTransfer $responseTransfer,
        array $responseData
    ): CrefoPayApiResponseTransfer;

    /**
     * @param \SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface $encodingService
     */
    public function __construct(
        CrefoPayApiToUtilEncodingServiceInterface $encodingService
    ) {
        $this->encodingService = $encodingService;
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

        if (!$isSuccess || !$this->isResultCodeSuccess($responseData)) {
            return $this->createResponseTransferWithError($responseData);
        }

        $responseTransfer = $this->createSuccessResponseTransfer();
        $responseTransfer = $this->updateResponseTransferWithApiCallResponse($responseTransfer, $responseData);

        return $responseTransfer;
    }

    /**
     * @param array $responseData
     *
     * @return bool
     */
    protected function isResultCodeSuccess(array $responseData): bool
    {
        if ($responseData === null) {
            return false;
        }

        $resultCode = $responseData[CrefoPayApiConfig::API_RESPONSE_FIELD_RESULT_CODE];

        return isset($resultCode) && ($resultCode === 0 || $resultCode === 1);
    }

    /**
     * @param array|null $responseData
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    protected function createResponseTransferWithError(?array $responseData): CrefoPayApiResponseTransfer
    {
        $errorTransfer = (new CrefoPayApiErrorResponseTransfer())
            ->setMessage(static::EXTERNAL_ERROR_MESSAGE)
            ->setErrorType(CrefoPayApiConfig::API_ERROR_TYPE_EXTERNAL);

        if ($responseData !== null) {
            $errorTransfer->fromArray($responseData, true);
        }

        return (new CrefoPayApiResponseTransfer())
            ->setIsSuccess(false)
            ->setError($errorTransfer);
    }

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    protected function createSuccessResponseTransfer(): CrefoPayApiResponseTransfer
    {
        return (new CrefoPayApiResponseTransfer())
            ->setIsSuccess(true);
    }
}
