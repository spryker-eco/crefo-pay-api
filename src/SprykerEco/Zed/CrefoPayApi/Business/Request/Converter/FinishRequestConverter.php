<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Request\Converter;

use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig;

class FinishRequestConverter implements CrefoPayApiRequestConverterInterface
{
    /**
     * @var \SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig
     */
    protected $config;

    /**
     * @param \SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig $config
     */
    public function __construct(CrefoPayApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    public function convertRequestTransferToArray(CrefoPayApiRequestTransfer $requestTransfer): array
    {
        $finishRequest = $requestTransfer->getFinishRequest();
        if ($finishRequest === null) {
            return [];
        }

        return [
            $this->config->getApiFieldMerchantId() => $finishRequest->getMerchantID(),
            $this->config->getApiFieldStoreId() => $finishRequest->getStoreID(),
            $this->config->getApiFieldOrderId() => $finishRequest->getOrderID(),
        ];
    }
}
