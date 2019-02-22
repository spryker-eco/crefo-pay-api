<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Request\Converter;

use ArrayObject;
use Generated\Shared\Transfer\CrefoPayApiAddressTransfer;
use Generated\Shared\Transfer\CrefoPayApiAmountTransfer;
use Generated\Shared\Transfer\CrefoPayApiBasketItemTransfer;
use Generated\Shared\Transfer\CrefoPayApiCompanyTransfer;
use Generated\Shared\Transfer\CrefoPayApiPersonTransfer;
use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig;

class CreateTransactionRequestConverter implements CrefoPayApiRequestConverterInterface
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
        $createTransactionRequest = $requestTransfer->getCreateTransactionRequest();
        if ($createTransactionRequest === null) {
            return [];
        }

        return [
            $this->config->getApiFieldMerchantId() => $createTransactionRequest->getMerchantID(),
            $this->config->getApiFieldStoreId() => $createTransactionRequest->getStoreID(),
            $this->config->getApiFieldOrderId() => $createTransactionRequest->getOrderID(),
            $this->config->getApiFieldUserId() => $createTransactionRequest->getUserID(),
            $this->config->getApiFieldIntegrationType() => $createTransactionRequest->getIntegrationType(),
            $this->config->getApiFieldAutoCapture() => $createTransactionRequest->getAutoCapture(),
            $this->config->getApiFieldMerchantReference() => $createTransactionRequest->getMerchantReference(),
            $this->config->getApiFieldContext() => $createTransactionRequest->getContext(),
            $this->config->getApiFieldUserType() => $createTransactionRequest->getUserType(),
            $this->config->getApiFieldUserRiskClass() => $createTransactionRequest->getUserRiskClass(),
            $this->config->getApiFieldUserIpAddress() => $createTransactionRequest->getUserIpAddress(),
            $this->config->getApiFieldCompanyData() => $this->getCompanyData($createTransactionRequest->getCompanyData()),
            $this->config->getApiFieldUserData() => $this->getUserData($createTransactionRequest->getUserData()),
            $this->config->getApiFieldBillingRecipient() => $createTransactionRequest->getBillingRecipient(),
            $this->config->getApiFieldBillingAddress() => $this->getAddressData($createTransactionRequest->getBillingAddress()),
            $this->config->getApiFieldShippingRecipient() => $createTransactionRequest->getShippingRecipient(),
            $this->config->getApiFieldShippingAddress() => $this->getAddressData($createTransactionRequest->getShippingAddress()),
            $this->config->getApiFieldAmount() => $this->getAmountData($createTransactionRequest->getAmount()),
            $this->config->getApiFieldBasketItems() => $this->getBasketItemsData($createTransactionRequest->getBasketItems()),
            $this->config->getApiFieldBasketValidity() => $createTransactionRequest->getBasketValidity(),
            $this->config->getApiFieldLocale() => $createTransactionRequest->getLocale(),
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiCompanyTransfer|null $companyTransfer
     *
     * @return array|null
     */
    protected function getCompanyData(?CrefoPayApiCompanyTransfer $companyTransfer): ?array
    {
        return $companyTransfer ? $this->convertCompanyTransferToArray($companyTransfer) : null;
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiPersonTransfer|null $personTransfer
     *
     * @return array|null
     */
    protected function getUserData(?CrefoPayApiPersonTransfer $personTransfer): ?array
    {
        return $personTransfer ? $this->convertPersonTransferToArray($personTransfer) : null;
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiAddressTransfer|null $addressTransfer
     *
     * @return array|null
     */
    protected function getAddressData(?CrefoPayApiAddressTransfer $addressTransfer): ?array
    {
        return $addressTransfer ? $this->convertAddressTransferToArray($addressTransfer) : null;
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
     * @param \Generated\Shared\Transfer\CrefoPayApiBasketItemTransfer $basketItem
     *
     * @return array
     */
    protected function convertBasketItemTransferToArray(CrefoPayApiBasketItemTransfer $basketItem): array
    {
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

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiCompanyTransfer $companyTransfer
     *
     * @return array
     */
    protected function convertCompanyTransferToArray(CrefoPayApiCompanyTransfer $companyTransfer): array
    {
        return [
            $this->config->getApiObjectCompanyFieldName() => $companyTransfer->getCompanyName(),
            $this->config->getApiObjectCompanyFieldEmail() => $companyTransfer->getEmail(),
            $this->config->getApiObjectCompanyFieldRegisterType() => $companyTransfer->getCompanyRegisterType(),
            $this->config->getApiObjectCompanyFieldRegistrationId() => $companyTransfer->getCompanyRegistrationID(),
            $this->config->getApiObjectCompanyFieldVatId() => $companyTransfer->getCompanyVatID(),
            $this->config->getApiObjectCompanyFieldTaxId() => $companyTransfer->getCompanyTaxID(),
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiPersonTransfer $personTransfer
     *
     * @return array
     */
    protected function convertPersonTransferToArray(CrefoPayApiPersonTransfer $personTransfer): array
    {
        return [
            $this->config->getApiObjectPersonFieldSalutation() => $personTransfer->getSalutation(),
            $this->config->getApiObjectPersonFieldName() => $personTransfer->getName(),
            $this->config->getApiObjectPersonFieldSurname() => $personTransfer->getSurname(),
            $this->config->getApiObjectPersonFieldDateOfBirth() => $personTransfer->getDateOfBirth(),
            $this->config->getApiObjectPersonFieldEmail() => $personTransfer->getEmail(),
            $this->config->getApiObjectPersonFieldPhoneNumber() => $personTransfer->getPhoneNumber(),
            $this->config->getApiObjectPersonFieldFaxNumber() => $personTransfer->getFaxNumber(),
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiAddressTransfer $addressTransfer
     *
     * @return array
     */
    protected function convertAddressTransferToArray(CrefoPayApiAddressTransfer $addressTransfer): array
    {
        return [
            $this->config->getApiObjectAddressFieldStreet() => $addressTransfer->getStreet(),
            $this->config->getApiObjectAddressFieldHouseNumber() => $addressTransfer->getNo(),
            $this->config->getApiObjectAddressFieldAdditional() => $addressTransfer->getAdditional(),
            $this->config->getApiObjectAddressFieldZip() => $addressTransfer->getZip(),
            $this->config->getApiObjectAddressFieldCity() => $addressTransfer->getCity(),
            $this->config->getApiObjectAddressFieldState() => $addressTransfer->getState(),
            $this->config->getApiObjectAddressFieldCountry() => $addressTransfer->getCountry(),
        ];
    }
}
