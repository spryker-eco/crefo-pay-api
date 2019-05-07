<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Request\Converter;

use Generated\Shared\Transfer\CrefoPayApiAmountTransfer;
use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use SprykerEco\Zed\CrefoPayApi\Business\Request\CrefoPayApiRequestFields;

class CaptureRequestConverter implements CrefoPayApiRequestConverterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    public function convertRequestTransferToArray(CrefoPayApiRequestTransfer $requestTransfer): array
    {
        $captureRequest = $requestTransfer->getCaptureRequest();
        if ($captureRequest === null) {
            return [];
        }

        return [
            CrefoPayApiRequestFields::API_FIELD_MERCHANT_ID => $captureRequest->getMerchantID(),
            CrefoPayApiRequestFields::API_FIELD_STORE_ID => $captureRequest->getStoreID(),
            CrefoPayApiRequestFields::API_FIELD_ORDER_ID => $captureRequest->getOrderID(),
            CrefoPayApiRequestFields::API_FIELD_CAPTURE_ID => $captureRequest->getCaptureID(),
            CrefoPayApiRequestFields::API_FIELD_AMOUNT => $this->getAmountData($captureRequest->getAmount()),
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
            CrefoPayApiRequestFields::API_OBJECT_AMOUNT_FIELD_AMOUNT => $amountTransfer->getAmount(),
            CrefoPayApiRequestFields::API_OBJECT_AMOUNT_FIELD_VAT_AMOUNT => $amountTransfer->getVatAmount(),
            CrefoPayApiRequestFields::API_OBJECT_AMOUNT_FIELD_VAT_RATE => $amountTransfer->getVatRate(),
        ];
    }
}
