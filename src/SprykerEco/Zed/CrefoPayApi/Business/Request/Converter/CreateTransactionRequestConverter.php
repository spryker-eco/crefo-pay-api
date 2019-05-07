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
use SprykerEco\Zed\CrefoPayApi\Business\Request\CrefoPayApiRequestFields;

class CreateTransactionRequestConverter implements CrefoPayApiRequestConverterInterface
{
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
            CrefoPayApiRequestFields::API_FIELD_MERCHANT_ID => $createTransactionRequest->getMerchantID(),
            CrefoPayApiRequestFields::API_FIELD_STORE_ID => $createTransactionRequest->getStoreID(),
            CrefoPayApiRequestFields::API_FIELD_ORDER_ID => $createTransactionRequest->getOrderID(),
            CrefoPayApiRequestFields::API_FIELD_USER_ID => $createTransactionRequest->getUserID(),
            CrefoPayApiRequestFields::API_FIELD_INTEGRATION_TYPE => $createTransactionRequest->getIntegrationType(),
            CrefoPayApiRequestFields::API_FIELD_AUTO_CAPTURE => $createTransactionRequest->getAutoCapture(),
            CrefoPayApiRequestFields::API_FIELD_MERCHANT_REFERENCE => $createTransactionRequest->getMerchantReference(),
            CrefoPayApiRequestFields::API_FIELD_CONTEXT => $createTransactionRequest->getContext(),
            CrefoPayApiRequestFields::API_FIELD_USER_TYPE => $createTransactionRequest->getUserType(),
            CrefoPayApiRequestFields::API_FIELD_USER_RISK_CLASS => $createTransactionRequest->getUserRiskClass(),
            CrefoPayApiRequestFields::API_FIELD_USER_IP_ADDRESS => $createTransactionRequest->getUserIpAddress(),
            CrefoPayApiRequestFields::API_FIELD_COMPANY_DATA => $this->getCompanyData($createTransactionRequest->getCompanyData()),
            CrefoPayApiRequestFields::API_FIELD_USER_DATA => $this->getUserData($createTransactionRequest->getUserData()),
            CrefoPayApiRequestFields::API_FIELD_BILLING_RECIPIENT => $createTransactionRequest->getBillingRecipient(),
            CrefoPayApiRequestFields::API_FIELD_BILLING_ADDRESS => $this->getAddressData($createTransactionRequest->getBillingAddress()),
            CrefoPayApiRequestFields::API_FIELD_SHIPPING_RECIPIENT => $createTransactionRequest->getShippingRecipient(),
            CrefoPayApiRequestFields::API_FIELD_SHIPPING_ADDRESS => $this->getAddressData($createTransactionRequest->getShippingAddress()),
            CrefoPayApiRequestFields::API_FIELD_AMOUNT => $this->getAmountData($createTransactionRequest->getAmount()),
            CrefoPayApiRequestFields::API_FIELD_BASKET_ITEMS => $this->getBasketItemsData($createTransactionRequest->getBasketItems()),
            CrefoPayApiRequestFields::API_FIELD_BASKET_VALIDITY => $createTransactionRequest->getBasketValidity(),
            CrefoPayApiRequestFields::API_FIELD_LOCALE => $createTransactionRequest->getLocale(),
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
            CrefoPayApiRequestFields::API_OBJECT_BASKET_ITEM_FIELD_TEXT => $basketItem->getBasketItemText(),
            CrefoPayApiRequestFields::API_OBJECT_BASKET_ITEM_FIELD_ID => $basketItem->getBasketItemID(),
            CrefoPayApiRequestFields::API_OBJECT_BASKET_ITEM_FIELD_COUNT => $basketItem->getBasketItemCount(),
            CrefoPayApiRequestFields::API_OBJECT_BASKET_ITEM_FIELD_AMOUNT => $this->getAmountData($basketItem->getBasketItemAmount()),
            CrefoPayApiRequestFields::API_OBJECT_BASKET_ITEM_FIELD_RISK_CLASS => $basketItem->getBasketItemRiskClass(),
            CrefoPayApiRequestFields::API_OBJECT_BASKET_ITEM_FIELD_TYPE => $basketItem->getBasketItemType(),
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
            CrefoPayApiRequestFields::API_OBJECT_AMOUNT_FIELD_AMOUNT => $amountTransfer->getAmount(),
            CrefoPayApiRequestFields::API_OBJECT_AMOUNT_FIELD_VAT_AMOUNT => $amountTransfer->getVatAmount(),
            CrefoPayApiRequestFields::API_OBJECT_AMOUNT_FIELD_VAT_RATE => $amountTransfer->getVatRate(),
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
            CrefoPayApiRequestFields::API_OBJECT_COMPANY_FIELD_NAME => $companyTransfer->getCompanyName(),
            CrefoPayApiRequestFields::API_OBJECT_COMPANY_FIELD_EMAIL => $companyTransfer->getEmail(),
            CrefoPayApiRequestFields::API_OBJECT_COMPANY_FIELD_REGISTER_TYPE => $companyTransfer->getCompanyRegisterType(),
            CrefoPayApiRequestFields::API_OBJECT_COMPANY_FIELD_REGISTRATION_ID => $companyTransfer->getCompanyRegistrationID(),
            CrefoPayApiRequestFields::API_OBJECT_COMPANY_FIELD_VAT_ID => $companyTransfer->getCompanyVatID(),
            CrefoPayApiRequestFields::API_OBJECT_COMPANY_FIELD_TAX_ID => $companyTransfer->getCompanyTaxID(),
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
            CrefoPayApiRequestFields::API_OBJECT_PERSON_FIELD_SALUTATION => $personTransfer->getSalutation(),
            CrefoPayApiRequestFields::API_OBJECT_PERSON_FIELD_NAME => $personTransfer->getName(),
            CrefoPayApiRequestFields::API_OBJECT_PERSON_FIELD_SURNAME => $personTransfer->getSurname(),
            CrefoPayApiRequestFields::API_OBJECT_PERSON_FIELD_DATE_OF_BIRTH => $personTransfer->getDateOfBirth(),
            CrefoPayApiRequestFields::API_OBJECT_PERSON_FIELD_EMAIL => $personTransfer->getEmail(),
            CrefoPayApiRequestFields::API_OBJECT_PERSON_FIELD_PHONE_NUMBER => $personTransfer->getPhoneNumber(),
            CrefoPayApiRequestFields::API_OBJECT_PERSON_FIELD_FAX_NUMBER => $personTransfer->getFaxNumber(),
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
            CrefoPayApiRequestFields::API_OBJECT_ADDRESS_FIELD_STREET => $addressTransfer->getStreet(),
            CrefoPayApiRequestFields::API_OBJECT_ADDRESS_FIELD_HOUSE_NUMBER => $addressTransfer->getNo(),
            CrefoPayApiRequestFields::API_OBJECT_ADDRESS_FIELD_ADDITIONAL => $addressTransfer->getAdditional(),
            CrefoPayApiRequestFields::API_OBJECT_ADDRESS_FIELD_ZIP => $addressTransfer->getZip(),
            CrefoPayApiRequestFields::API_OBJECT_ADDRESS_FIELD_CITY => $addressTransfer->getCity(),
            CrefoPayApiRequestFields::API_OBJECT_ADDRESS_FIELD_STATE => $addressTransfer->getState(),
            CrefoPayApiRequestFields::API_OBJECT_ADDRESS_FIELD_COUNTRY => $addressTransfer->getCountry(),
        ];
    }
}
