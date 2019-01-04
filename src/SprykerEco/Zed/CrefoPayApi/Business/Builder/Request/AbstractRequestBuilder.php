<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Builder\Request;

use ArrayObject;
use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\CrefoPayApiRequestValidatorInterface;
use SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface;

abstract class AbstractRequestBuilder implements CrefoPayApiRequestBuilderInterface
{
    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\CrefoPayApiRequestValidatorInterface
     */
    protected $validator;

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface
     */
    protected $encodingService;

    /**
     * @var \SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceInterface
     */
    protected $service;

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    abstract protected function convertRequestTransferToArray(CrefoPayApiRequestTransfer $requestTransfer): array;

    /**
     * @param \SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\CrefoPayApiRequestValidatorInterface $validator
     * @param \SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface $encodingService
     * @param \SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceInterface $service
     */
    public function __construct(
        CrefoPayApiRequestValidatorInterface $validator,
        CrefoPayApiToUtilEncodingServiceInterface $encodingService,
        CrefoPayApiServiceInterface $service
    ) {
        $this->validator = $validator;
        $this->encodingService = $encodingService;
        $this->service = $service;
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    public function buildRequestPayload(CrefoPayApiRequestTransfer $requestTransfer): array
    {
        $this->validator->validate($requestTransfer);
        $requestPayload = $this->convertRequestTransferToArray($requestTransfer);
        $requestPayload = $this->removeRedundantParams($requestPayload);
        $requestPayload = $this->convertNestedArrayToJson($requestPayload);
        $requestPayload['mac'] = $this->service->calculateMac($requestPayload);

        return $requestPayload;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function removeRedundantParams(array $data): array
    {
        $data = array_filter($data, function ($item) {
            if ($item instanceof ArrayObject) {
                return $item->count() !== 0;
            }
            return $item !== null;
        });

        foreach ($data as $key => $value) {
            if (is_array($value) || $value instanceof ArrayObject) {
                $data[$key] = $this->removeRedundantParams($value);
            }
        }

        return $data;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function convertNestedArrayToJson(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value) || $value instanceof ArrayObject) {
                $data[$key] = $this->encodingService->encodeJson($value);
            }
        }

        return $data;
    }
}
