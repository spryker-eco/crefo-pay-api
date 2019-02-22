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
use SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig;

class ReserveRequestConverter implements CrefoPayApiRequestConverterInterface
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
        $reserveRequest = $requestTransfer->getReserveRequest();
        if ($reserveRequest === null) {
            return [];
        }

        return [
            $this->config->getApiFieldMerchantId() => $reserveRequest->getMerchantID(),
            $this->config->getApiFieldStoreId() => $reserveRequest->getStoreID(),
            $this->config->getApiFieldOrderId() => $reserveRequest->getOrderID(),
            $this->config->getApiFieldPaymentMethod() => $reserveRequest->getPaymentMethod(),
            $this->config->getApiFieldPaymentInstrumentId() => $reserveRequest->getPaymentInstrumentID(),
            $this->config->getApiFieldAdditionalInformation() => $this->getAdditionalInformationData($reserveRequest->getAdditionalInformation()),
            $this->config->getApiFieldAmount() => $this->getAmountData($reserveRequest->getAmount()),
            $this->config->getApiFieldBasketItems() => $this->getBasketItemsData($reserveRequest->getBasketItems()),
            $this->config->getApiFieldCvv() => $reserveRequest->getCvv(),
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
            $this->config->getApiObjectAdditionalInformationFieldSalutation() => $reserveInformationRequestTransfer->getSalutation(),
            $this->config->getApiObjectAdditionalInformationFieldDateOfBirth() => $reserveInformationRequestTransfer->getDateOfBirth(),
        ];
    }

    /**
     * @param \ArrayObject|\Generated\Shared\Transfer\CrefoPayApiBasketItemTransfer[] $basketItems
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
            $basketItems->getArrayCopy()
        );
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiBasketItemTransfer|null $basketItem
     *
     * @return array
     */
    protected function convertBasketItemTransferToArray(?CrefoPayApiBasketItemTransfer $basketItem): array
    {
        if ($basketItem === null) {
            return [];
        }

        return [
            $this->config->getApiObjectBasketItemFieldText() => $basketItem->getBasketItemText(),
            $this->config->getApiObjectBasketItemFieldId() => $basketItem->getBasketItemID(),
            $this->config->getApiObjectBasketItemFieldCount() => $basketItem->getBasketItemCount(),
            $this->config->getApiObjectBasketItemFieldAmount() => $this->getAmountData($basketItem->getBasketItemAmount()),
            $this->config->getApiObjectBasketItemFieldRiskClass() => $basketItem->getBasketItemRiskClass(),
            $this->config->getApiObjectBasketItemFieldType() => $basketItem->getBasketItemType(),
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
