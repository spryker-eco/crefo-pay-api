<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Request\Converter;

use Generated\Shared\Transfer\CrefoPayApiAmountTransfer;
use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig;

class RefundRequestConverter implements CrefoPayApiRequestConverterInterface
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
        $refundRequest = $requestTransfer->getRefundRequest();
        if ($refundRequest === null) {
            return [];
        }

        return [
            $this->config->getApiFieldMerchantId() => $refundRequest->getMerchantID(),
            $this->config->getApiFieldStoreId() => $refundRequest->getStoreID(),
            $this->config->getApiFieldOrderId() => $refundRequest->getOrderID(),
            $this->config->getApiFieldCaptureId() => $refundRequest->getCaptureID(),
            $this->config->getApiFieldAmount() => $this->getAmountData($refundRequest->getAmount()),
            $this->config->getApiFieldRefundDescription() => $refundRequest->getRefundDescription(),
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiAmountTransfer|null $amountTransfer
     *
     * @return array|null
     */
    protected function getAmountData(?CrefoPayApiAmountTransfer $amountTransfer): ?array
    {
        return $amountTransfer ? $this->convertAmountTransferToArray($amountTransfer) : null;
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiAmountTransfer $amountTransfer
     *
     * @return array
     */
    protected function convertAmountTransferToArray(CrefoPayApiAmountTransfer $amountTransfer): array
    {
        return [
            $this->config->getApiObjectAmountFieldAmount() => $amountTransfer->getAmount(),
            $this->config->getApiObjectAmountFieldVatAmount() => $amountTransfer->getVatAmount(),
            $this->config->getApiObjectAmountFieldVatRate() => $amountTransfer->getVatRate(),
        ];
    }
}
