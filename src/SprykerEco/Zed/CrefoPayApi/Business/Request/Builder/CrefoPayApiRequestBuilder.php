<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Request\Builder;

use ArrayObject;
use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Request\Converter\CrefoPayApiRequestConverterInterface;
use SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig;
use SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface;

class CrefoPayApiRequestBuilder implements CrefoPayApiRequestBuilderInterface
{
    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Business\Request\Converter\CrefoPayApiRequestConverterInterface
     */
    protected $requestConverter;

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface
     */
    protected $encodingService;

    /**
     * @var \SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceInterface
     */
    protected $service;

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig
     */
    protected $config;

    /**
     * @param \SprykerEco\Zed\CrefoPayApi\Business\Request\Converter\CrefoPayApiRequestConverterInterface $requestConverter
     * @param \SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface $encodingService
     * @param \SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceInterface $service
     * @param \SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig $config
     */
    public function __construct(
        CrefoPayApiRequestConverterInterface $requestConverter,
        CrefoPayApiToUtilEncodingServiceInterface $encodingService,
        CrefoPayApiServiceInterface $service,
        CrefoPayApiConfig $config
    ) {
        $this->requestConverter = $requestConverter;
        $this->encodingService = $encodingService;
        $this->service = $service;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    public function buildRequestPayload(CrefoPayApiRequestTransfer $requestTransfer): array
    {
        $requestPayload = $this->requestConverter
            ->convertRequestTransferToArray($requestTransfer);
        $requestPayload = $this->removeRedundantParams($requestPayload);
        $requestPayload = $this->convertNestedArrayToJson($requestPayload);
        $requestPayload[$this->config->getApiFieldMac()] = $this->service->calculateMac($requestPayload);

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
                $data[$key] = $this->removeRedundantParams((array)$value);
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
