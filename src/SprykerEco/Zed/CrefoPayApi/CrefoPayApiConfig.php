<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\CrefoPayApi\CrefoPayApiConstants;

/**
 * @method \SprykerEco\Shared\CrefoPayApi\CrefoPayApiConfig getSharedConfig()
 */
class CrefoPayApiConfig extends AbstractBundleConfig
{
    protected const API_HEADER_MAC = 'X-Payco-HMAC';
    protected const API_RESPONSE_FIELD_RESULT_CODE = 'resultCode';
    protected const API_ERROR_TYPE_EXTERNAL = 'EXTERNAL';

    protected const API_FIELD_MERCHANT_ID = 'merchantID';
    protected const API_FIELD_STORE_ID = 'storeID';
    protected const API_FIELD_ORDER_ID = 'orderID';
    protected const API_FIELD_USER_ID = 'userID';
    protected const API_FIELD_CAPTURE_ID = 'captureID';
    protected const API_FIELD_INTEGRATION_TYPE = 'integrationType';
    protected const API_FIELD_AUTO_CAPTURE = 'autoCapture';
    protected const API_FIELD_MERCHANT_REFERENCE = 'merchantReference';
    protected const API_FIELD_CONTEXT = 'context';
    protected const API_FIELD_USER_TYPE = 'userType';
    protected const API_FIELD_USER_RISK_CLASS = 'userRiskClass';
    protected const API_FIELD_USER_IP_ADDRESS = 'userIpAddress';
    protected const API_FIELD_COMPANY_DATA = 'companyData';
    protected const API_FIELD_USER_DATA = 'userData';
    protected const API_FIELD_BILLING_RECIPIENT = 'billingRecipient';
    protected const API_FIELD_BILLING_ADDRESS = 'billingAddress';
    protected const API_FIELD_SHIPPING_RECIPIENT = 'shippingRecipient';
    protected const API_FIELD_SHIPPING_ADDRESS = 'shippingAddress';
    protected const API_FIELD_AMOUNT = 'amount';
    protected const API_FIELD_REFUND_DESCRIPTION = 'refundDescription';
    protected const API_FIELD_PAYMENT_METHOD = 'paymentMethod';
    protected const API_FIELD_PAYMENT_INSTRUMENT_ID = 'paymentInstrumentID';
    protected const API_FIELD_ADDITIONAL_INFORMATION = 'additionalInformation';
    protected const API_FIELD_BASKET_ITEMS = 'basketItems';
    protected const API_FIELD_BASKET_VALIDITY = 'basketValidity';
    protected const API_FIELD_LOCALE = 'locale';
    protected const API_FIELD_CVV = 'cvv';

    protected const API_OBJECT_AMOUNT_FIELD_AMOUNT = 'amount';
    protected const API_OBJECT_AMOUNT_FIELD_VAT_AMOUNT = 'vatAmount';
    protected const API_OBJECT_AMOUNT_FIELD_VAT_RATE = 'vatRate';

    protected const API_OBJECT_ADDITIONAL_INFORMATION_FIELD_SALUTATION = 'salutation';
    protected const API_OBJECT_ADDITIONAL_INFORMATION_FIELD_DATE_OF_BIRTH = 'dateOfBirth';

    protected const API_OBJECT_BASKET_ITEM_FIELD_TEXT = 'basketItemText';
    protected const API_OBJECT_BASKET_ITEM_FIELD_ID = 'basketItemID';
    protected const API_OBJECT_BASKET_ITEM_FIELD_COUNT = 'basketItemCount';
    protected const API_OBJECT_BASKET_ITEM_FIELD_AMOUNT = 'basketItemAmount';
    protected const API_OBJECT_BASKET_ITEM_FIELD_RISK_CLASS = 'basketItemRiskClass';
    protected const API_OBJECT_BASKET_ITEM_FIELD_TYPE = 'basketItemType';

    protected const API_OBJECT_COMPANY_FIELD_NAME = 'companyName';
    protected const API_OBJECT_COMPANY_FIELD_EMAIL = 'email';
    protected const API_OBJECT_COMPANY_FIELD_REGISTER_TYPE = 'companyRegisterType';
    protected const API_OBJECT_COMPANY_FIELD_REGISTRATION_ID = 'companyRegistrationID';
    protected const API_OBJECT_COMPANY_FIELD_VAT_ID = 'companyVatID';
    protected const API_OBJECT_COMPANY_FIELD_TAX_ID = 'companyTaxID';

    protected const API_OBJECT_PERSON_FIELD_SALUTATION = 'salutation';
    protected const API_OBJECT_PERSON_FIELD_NAME = 'name';
    protected const API_OBJECT_PERSON_FIELD_SURNAME = 'surname';
    protected const API_OBJECT_PERSON_FIELD_DATE_OF_BIRTH = 'dateOfBirth';
    protected const API_OBJECT_PERSON_FIELD_EMAIL = 'email';
    protected const API_OBJECT_PERSON_FIELD_PHONE_NUMBER = 'phoneNumber';
    protected const API_OBJECT_PERSON_FIELD_FAX_NUMBER = 'faxNumber';

    protected const API_OBJECT_ADDRESS_FIELD_STREET = 'street';
    protected const API_OBJECT_ADDRESS_FIELD_HOUSE_NUMBER = 'no';
    protected const API_OBJECT_ADDRESS_FIELD_ADDITIONAL = 'additional';
    protected const API_OBJECT_ADDRESS_FIELD_ZIP = 'zip';
    protected const API_OBJECT_ADDRESS_FIELD_CITY = 'city';
    protected const API_OBJECT_ADDRESS_FIELD_STATE = 'state';
    protected const API_OBJECT_ADDRESS_FIELD_COUNTRY = 'country';

    /**
     * @return string
     */
    public function getCreateTransactionActionUrl(): string
    {
        return $this->get(CrefoPayApiConstants::CREATE_TRANSACTION_ACTION_URL);
    }

    /**
     * @return string
     */
    public function getReserveActionUrl(): string
    {
        return $this->get(CrefoPayApiConstants::RESERVE_ACTION_URL);
    }

    /**
     * @return string
     */
    public function getCaptureActionUrl(): string
    {
        return $this->get(CrefoPayApiConstants::CAPTURE_ACTION_URL);
    }

    /**
     * @return string
     */
    public function getCancelActionUrl(): string
    {
        return $this->get(CrefoPayApiConstants::CANCEL_ACTION_URL);
    }

    /**
     * @return string
     */
    public function getRefundActionUrl(): string
    {
        return $this->get(CrefoPayApiConstants::REFUND_ACTION_URL);
    }

    /**
     * @return string
     */
    public function getFinishActionUrl(): string
    {
        return $this->get(CrefoPayApiConstants::FINISH_ACTION_URL);
    }

    /**
     * @return string
     */
    public function getApiFieldMac(): string
    {
        return $this->getSharedConfig()->getApiFieldMac();
    }

    /**
     * @return int
     */
    public function getResultCodeOk(): int
    {
        return $this->getSharedConfig()->getResultCodeOk();
    }

    /**
     * @return int
     */
    public function getResultCodeRedirect(): int
    {
        return $this->getSharedConfig()->getResultCodeRedirect();
    }

    /**
     * @return string
     */
    public function getApiHeaderMac(): string
    {
        return static::API_HEADER_MAC;
    }

    /**
     * @return string
     */
    public function getApiResponseFieldResultCode(): string
    {
        return static::API_RESPONSE_FIELD_RESULT_CODE;
    }

    /**
     * @return string
     */
    public function getApiErrorTypeExternal(): string
    {
        return static::API_ERROR_TYPE_EXTERNAL;
    }

    /**
     * @return string
     */
    public function getApiFieldMerchantId(): string
    {
        return static::API_FIELD_MERCHANT_ID;
    }

    /**
     * @return string
     */
    public function getApiFieldStoreId(): string
    {
        return static::API_FIELD_STORE_ID;
    }

    /**
     * @return string
     */
    public function getApiFieldOrderId(): string
    {
        return static::API_FIELD_ORDER_ID;
    }

    /**
     * @return string
     */
    public function getApiFieldUserId(): string
    {
        return static::API_FIELD_USER_ID;
    }

    /**
     * @return string
     */
    public function getApiFieldCaptureId(): string
    {
        return static::API_FIELD_CAPTURE_ID;
    }

    /**
     * @return string
     */
    public function getApiFieldIntegrationType(): string
    {
        return static::API_FIELD_INTEGRATION_TYPE;
    }

    /**
     * @return string
     */
    public function getApiFieldAutoCapture(): string
    {
        return static::API_FIELD_AUTO_CAPTURE;
    }

    /**
     * @return string
     */
    public function getApiFieldMerchantReference(): string
    {
        return static::API_FIELD_MERCHANT_REFERENCE;
    }

    /**
     * @return string
     */
    public function getApiFieldContext(): string
    {
        return static::API_FIELD_CONTEXT;
    }

    /**
     * @return string
     */
    public function getApiFieldUserType(): string
    {
        return static::API_FIELD_USER_TYPE;
    }

    /**
     * @return string
     */
    public function getApiFieldUserRiskClass(): string
    {
        return static::API_FIELD_USER_RISK_CLASS;
    }

    /**
     * @return string
     */
    public function getApiFieldUserIpAddress(): string
    {
        return static::API_FIELD_USER_IP_ADDRESS;
    }

    /**
     * @return string
     */
    public function getApiFieldCompanyData(): string
    {
        return static::API_FIELD_COMPANY_DATA;
    }

    /**
     * @return string
     */
    public function getApiFieldUserData(): string
    {
        return static::API_FIELD_USER_DATA;
    }

    /**
     * @return string
     */
    public function getApiFieldBillingRecipient(): string
    {
        return static::API_FIELD_BILLING_RECIPIENT;
    }

    /**
     * @return string
     */
    public function getApiFieldBillingAddress(): string
    {
        return static::API_FIELD_BILLING_ADDRESS;
    }

    /**
     * @return string
     */
    public function getApiFieldShippingRecipient(): string
    {
        return static::API_FIELD_SHIPPING_RECIPIENT;
    }

    /**
     * @return string
     */
    public function getApiFieldShippingAddress(): string
    {
        return static::API_FIELD_SHIPPING_ADDRESS;
    }

    /**
     * @return string
     */
    public function getApiFieldAmount(): string
    {
        return static::API_FIELD_AMOUNT;
    }

    /**
     * @return string
     */
    public function getApiFieldRefundDescription(): string
    {
        return static::API_FIELD_REFUND_DESCRIPTION;
    }

    /**
     * @return string
     */
    public function getApiFieldPaymentMethod(): string
    {
        return static::API_FIELD_PAYMENT_METHOD;
    }

    /**
     * @return string
     */
    public function getApiFieldPaymentInstrumentId(): string
    {
        return static::API_FIELD_PAYMENT_INSTRUMENT_ID;
    }

    /**
     * @return string
     */
    public function getApiFieldAdditionalInformation(): string
    {
        return static::API_FIELD_ADDITIONAL_INFORMATION;
    }

    /**
     * @return string
     */
    public function getApiFieldBasketItems(): string
    {
        return static::API_FIELD_BASKET_ITEMS;
    }

    /**
     * @return string
     */
    public function getApiFieldBasketValidity(): string
    {
        return static::API_FIELD_BASKET_VALIDITY;
    }

    /**
     * @return string
     */
    public function getApiFieldLocale(): string
    {
        return static::API_FIELD_LOCALE;
    }

    /**
     * @return string
     */
    public function getApiFieldCvv(): string
    {
        return static::API_FIELD_CVV;
    }

    /**
     * @return string
     */
    public function getApiObjectAmountFieldAmount(): string
    {
        return static::API_OBJECT_AMOUNT_FIELD_AMOUNT;
    }

    /**
     * @return string
     */
    public function getApiObjectAmountFieldVatAmount(): string
    {
        return static::API_OBJECT_AMOUNT_FIELD_VAT_AMOUNT;
    }

    /**
     * @return string
     */
    public function getApiObjectAmountFieldVatRate(): string
    {
        return static::API_OBJECT_AMOUNT_FIELD_VAT_RATE;
    }

    /**
     * @return string
     */
    public function getApiObjectAdditionalInformationFieldSalutation(): string
    {
        return static::API_OBJECT_ADDITIONAL_INFORMATION_FIELD_SALUTATION;
    }

    /**
     * @return string
     */
    public function getApiObjectAdditionalInformationFieldDateOfBirth(): string
    {
        return static::API_OBJECT_ADDITIONAL_INFORMATION_FIELD_DATE_OF_BIRTH;
    }

    /**
     * @return string
     */
    public function getApiObjectBasketItemFieldText(): string
    {
        return static::API_OBJECT_BASKET_ITEM_FIELD_TEXT;
    }

    /**
     * @return string
     */
    public function getApiObjectBasketItemFieldId(): string
    {
        return static::API_OBJECT_BASKET_ITEM_FIELD_ID;
    }

    /**
     * @return string
     */
    public function getApiObjectBasketItemFieldCount(): string
    {
        return static::API_OBJECT_BASKET_ITEM_FIELD_COUNT;
    }

    /**
     * @return string
     */
    public function getApiObjectBasketItemFieldAmount(): string
    {
        return static::API_OBJECT_BASKET_ITEM_FIELD_AMOUNT;
    }

    /**
     * @return string
     */
    public function getApiObjectBasketItemFieldRiskClass(): string
    {
        return static::API_OBJECT_BASKET_ITEM_FIELD_RISK_CLASS;
    }

    /**
     * @return string
     */
    public function getApiObjectBasketItemFieldType(): string
    {
        return static::API_OBJECT_BASKET_ITEM_FIELD_TYPE;
    }

    /**
     * @return string
     */
    public function getApiObjectCompanyFieldName(): string
    {
        return static::API_OBJECT_COMPANY_FIELD_NAME;
    }

    /**
     * @return string
     */
    public function getApiObjectCompanyFieldEmail(): string
    {
        return static::API_OBJECT_COMPANY_FIELD_EMAIL;
    }

    /**
     * @return string
     */
    public function getApiObjectCompanyFieldRegisterType(): string
    {
        return static::API_OBJECT_COMPANY_FIELD_REGISTER_TYPE;
    }

    /**
     * @return string
     */
    public function getApiObjectCompanyFieldRegistrationId(): string
    {
        return static::API_OBJECT_COMPANY_FIELD_REGISTRATION_ID;
    }

    /**
     * @return string
     */
    public function getApiObjectCompanyFieldVatId(): string
    {
        return static::API_OBJECT_COMPANY_FIELD_VAT_ID;
    }

    /**
     * @return string
     */
    public function getApiObjectCompanyFieldTaxId(): string
    {
        return static::API_OBJECT_COMPANY_FIELD_TAX_ID;
    }

    /**
     * @return string
     */
    public function getApiObjectPersonFieldSalutation(): string
    {
        return static::API_OBJECT_PERSON_FIELD_SALUTATION;
    }

    /**
     * @return string
     */
    public function getApiObjectPersonFieldName(): string
    {
        return static::API_OBJECT_PERSON_FIELD_NAME;
    }

    /**
     * @return string
     */
    public function getApiObjectPersonFieldSurname(): string
    {
        return static::API_OBJECT_PERSON_FIELD_SURNAME;
    }

    /**
     * @return string
     */
    public function getApiObjectPersonFieldDateOfBirth(): string
    {
        return static::API_OBJECT_PERSON_FIELD_DATE_OF_BIRTH;
    }

    /**
     * @return string
     */
    public function getApiObjectPersonFieldEmail(): string
    {
        return static::API_OBJECT_PERSON_FIELD_EMAIL;
    }

    /**
     * @return string
     */
    public function getApiObjectPersonFieldPhoneNumber(): string
    {
        return static::API_OBJECT_PERSON_FIELD_PHONE_NUMBER;
    }

    /**
     * @return string
     */
    public function getApiObjectPersonFieldFaxNumber(): string
    {
        return static::API_OBJECT_PERSON_FIELD_FAX_NUMBER;
    }

    /**
     * @return string
     */
    public function getApiObjectAddressFieldStreet(): string
    {
        return static::API_OBJECT_ADDRESS_FIELD_STREET;
    }

    /**
     * @return string
     */
    public function getApiObjectAddressFieldHouseNumber(): string
    {
        return static::API_OBJECT_ADDRESS_FIELD_HOUSE_NUMBER;
    }

    /**
     * @return string
     */
    public function getApiObjectAddressFieldAdditional(): string
    {
        return static::API_OBJECT_ADDRESS_FIELD_ADDITIONAL;
    }

    /**
     * @return string
     */
    public function getApiObjectAddressFieldZip(): string
    {
        return static::API_OBJECT_ADDRESS_FIELD_ZIP;
    }

    /**
     * @return string
     */
    public function getApiObjectAddressFieldCity(): string
    {
        return static::API_OBJECT_ADDRESS_FIELD_CITY;
    }

    /**
     * @return string
     */
    public function getApiObjectAddressFieldState(): string
    {
        return static::API_OBJECT_ADDRESS_FIELD_STATE;
    }

    /**
     * @return string
     */
    public function getApiObjectAddressFieldCountry(): string
    {
        return static::API_OBJECT_ADDRESS_FIELD_COUNTRY;
    }
}
