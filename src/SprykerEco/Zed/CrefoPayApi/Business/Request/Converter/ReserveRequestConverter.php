<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Request\Converter;

use ArrayObject;
use Generated\Shared\Transfer\CrefoPayApiAmountTransfer;
use Generated\Shared\Transfer\CrefoPayApiBasketItemTransfer;
use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiReserveInformationRequestTransfer;
use SprykerEco\Zed\CrefoPayApi\Business\Request\CrefoPayApiRequestFields;

class ReserveRequestConverter implements CrefoPayApiRequestConverterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    public function convertRequestTransferToArray(CrefoPayApiRequestTransfer $requestTransfer): array
    {
        $reserveRequest = $requestTransfer->getReserveRequest();
        if ($reserveRequest === null) {
            return [];
        }

        return [
            CrefoPayApiRequestFields::API_FIELD_MERCHANT_ID => $reserveRequest->getMerchantID(),
            CrefoPayApiRequestFields::API_FIELD_STORE_ID => $reserveRequest->getStoreID(),
            CrefoPayApiRequestFields::API_FIELD_ORDER_ID => $reserveRequest->getOrderID(),
            CrefoPayApiRequestFields::API_FIELD_PAYMENT_METHOD => $reserveRequest->getPaymentMethod(),
            CrefoPayApiRequestFields::API_FIELD_PAYMENT_INSTRUMENT_ID => $reserveRequest->getPaymentInstrumentID(),
            CrefoPayApiRequestFields::API_FIELD_ADDITIONAL_INFORMATION => $this->getAdditionalInformationData($reserveRequest->getAdditionalInformation()),
            CrefoPayApiRequestFields::API_FIELD_AMOUNT => $this->getAmountData($reserveRequest->getAmount()),
            CrefoPayApiRequestFields::API_FIELD_BASKET_ITEMS => $this->getBasketItemsData($reserveRequest->getBasketItems()),
            CrefoPayApiRequestFields::API_FIELD_CVV => $reserveRequest->getCvv(),
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiReserveInformationRequestTransfer|null $reserveInformationRequestTransfer
     *
     * @return array|null
     */
    protected function getAdditionalInformationData(?CrefoPayApiReserveInformationRequestTransfer $reserveInformationRequestTransfer): ?array
    {
        return $reserveInformationRequestTransfer ? $this->convertAdditionalInformationTransferToArray($reserveInformationRequestTransfer) : null;
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiReserveInformationRequestTransfer $reserveInformationRequestTransfer
     *
     * @return array
     */
    protected function convertAdditionalInformationTransferToArray(CrefoPayApiReserveInformationRequestTransfer $reserveInformationRequestTransfer): array
    {
        return [
            CrefoPayApiRequestFields::API_OBJECT_ADDITIONAL_INFORMATION_FIELD_SALUTATION => $reserveInformationRequestTransfer->getSalutation(),
            CrefoPayApiRequestFields::API_OBJECT_ADDITIONAL_INFORMATION_FIELD_DATE_OF_BIRTH => $reserveInformationRequestTransfer->getDateOfBirth(),
        ];
    }

    /**
     * @param \ArrayObject|array<\Generated\Shared\Transfer\CrefoPayApiBasketItemTransfer> $basketItems
     *
     * @return array|null
     */
    protected function getBasketItemsData(ArrayObject $basketItems): ?array
    {
        if ($basketItems->count() === 0) {
            return null;
        }

        return array_map(
            function (CrefoPayApiBasketItemTransfer $basketItem) {
                return $this->convertBasketItemTransferToArray($basketItem);
            },
            $basketItems->getArrayCopy(),
        );
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiBasketItemTransfer $basketItem
     *
     * @return array
     */
    protected function convertBasketItemTransferToArray(CrefoPayApiBasketItemTransfer $basketItem): array
    {
        return [
            CrefoPayApiRequestFields::API_OBJECT_BASKET_ITEM_FIELD_TEXT => $basketItem->getBasketItemText(),
            CrefoPayApiRequestFields::API_OBJECT_BASKET_ITEM_FIELD_ID => $basketItem->getBasketItemID(),
            CrefoPayApiRequestFields::API_OBJECT_BASKET_ITEM_FIELD_COUNT => $basketItem->getBasketItemCount(),
            CrefoPayApiRequestFields::API_OBJECT_BASKET_ITEM_FIELD_AMOUNT => $this->getAmountData($basketItem->getBasketItemAmount()),
            CrefoPayApiRequestFields::API_OBJECT_BASKET_ITEM_FIELD_RISK_CLASS => $basketItem->getBasketItemRiskClass(),
            CrefoPayApiRequestFields::API_OBJECT_BASKET_ITEM_FIELD_TYPE => $basketItem->getBasketItemType(),
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
