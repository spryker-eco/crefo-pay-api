<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Converter;

use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;
use Psr\Http\Message\ResponseInterface;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;
use SprykerEco\Zed\CrefoPayApi\Business\Validator\Response\CrefoPayApiResponseValidatorInterface;
use SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface;

abstract class AbstractConverter implements CrefoPayApiConverterInterface
{
    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Business\Validator\Response\CrefoPayApiResponseValidatorInterface
     */
    protected $validator;

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
    abstract protected function createResponseTransferWithApiCallResponse(
        CrefoPayApiResponseTransfer $responseTransfer,
        array $responseData
    ): CrefoPayApiResponseTransfer;

    /**
     * @param \SprykerEco\Zed\CrefoPayApi\Business\Validator\Response\CrefoPayApiResponseValidatorInterface $validator
     * @param \SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface $encodingService
     */
    public function __construct(
        CrefoPayApiResponseValidatorInterface $validator,
        CrefoPayApiToUtilEncodingServiceInterface $encodingService
    ) {
        $this->validator = $validator;
        $this->encodingService = $encodingService;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param bool $isSuccess
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function convertToResponseTransfer(
        ResponseInterface $response,
        bool $isSuccess = true
    ): CrefoPayApiResponseTransfer {
        $responseData = $this->encodingService->decodeJson($response->getBody(), true);
        $responseTransfer = $this->createResponseTransferWithApiCallResponse(
            new CrefoPayApiResponseTransfer(),
            $responseData
        );

        try {
            $this->validator->validate($responseTransfer);
        } catch (RequiredTransferPropertyException $requiredTransferPropertyException) {

        }


        return $responseTransfer;
    }
}
