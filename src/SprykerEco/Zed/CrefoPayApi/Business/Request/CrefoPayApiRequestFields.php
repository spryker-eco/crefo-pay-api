<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Request;

interface CrefoPayApiRequestFields
{
    /**
     * @var string
     */
    public const API_FIELD_MERCHANT_ID = 'merchantID';

    /**
     * @var string
     */
    public const API_FIELD_STORE_ID = 'storeID';

    /**
     * @var string
     */
    public const API_FIELD_ORDER_ID = 'orderID';

    /**
     * @var string
     */
    public const API_FIELD_USER_ID = 'userID';

    /**
     * @var string
     */
    public const API_FIELD_CAPTURE_ID = 'captureID';

    /**
     * @var string
     */
    public const API_FIELD_INTEGRATION_TYPE = 'integrationType';

    /**
     * @var string
     */
    public const API_FIELD_AUTO_CAPTURE = 'autoCapture';

    /**
     * @var string
     */
    public const API_FIELD_MERCHANT_REFERENCE = 'merchantReference';

    /**
     * @var string
     */
    public const API_FIELD_CONTEXT = 'context';

    /**
     * @var string
     */
    public const API_FIELD_USER_TYPE = 'userType';

    /**
     * @var string
     */
    public const API_FIELD_USER_RISK_CLASS = 'userRiskClass';

    /**
     * @var string
     */
    public const API_FIELD_USER_IP_ADDRESS = 'userIpAddress';

    /**
     * @var string
     */
    public const API_FIELD_COMPANY_DATA = 'companyData';

    /**
     * @var string
     */
    public const API_FIELD_USER_DATA = 'userData';

    /**
     * @var string
     */
    public const API_FIELD_BILLING_RECIPIENT = 'billingRecipient';

    /**
     * @var string
     */
    public const API_FIELD_BILLING_ADDRESS = 'billingAddress';

    /**
     * @var string
     */
    public const API_FIELD_SHIPPING_RECIPIENT = 'shippingRecipient';

    /**
     * @var string
     */
    public const API_FIELD_SHIPPING_ADDRESS = 'shippingAddress';

    /**
     * @var string
     */
    public const API_FIELD_AMOUNT = 'amount';

    /**
     * @var string
     */
    public const API_FIELD_REFUND_DESCRIPTION = 'refundDescription';

    /**
     * @var string
     */
    public const API_FIELD_PAYMENT_METHOD = 'paymentMethod';

    /**
     * @var string
     */
    public const API_FIELD_PAYMENT_INSTRUMENT_ID = 'paymentInstrumentID';

    /**
     * @var string
     */
    public const API_FIELD_ADDITIONAL_INFORMATION = 'additionalInformation';

    /**
     * @var string
     */
    public const API_FIELD_BASKET_ITEMS = 'basketItems';

    /**
     * @var string
     */
    public const API_FIELD_BASKET_VALIDITY = 'basketValidity';

    /**
     * @var string
     */
    public const API_FIELD_LOCALE = 'locale';

    /**
     * @var string
     */
    public const API_FIELD_CVV = 'cvv';

    /**
     * @var string
     */
    public const API_FIELD_MAC = 'mac';

    /**
     * @var string
     */
    public const API_OBJECT_AMOUNT_FIELD_AMOUNT = 'amount';

    /**
     * @var string
     */
    public const API_OBJECT_AMOUNT_FIELD_VAT_AMOUNT = 'vatAmount';

    /**
     * @var string
     */
    public const API_OBJECT_AMOUNT_FIELD_VAT_RATE = 'vatRate';

    /**
     * @var string
     */
    public const API_OBJECT_ADDITIONAL_INFORMATION_FIELD_SALUTATION = 'salutation';

    /**
     * @var string
     */
    public const API_OBJECT_ADDITIONAL_INFORMATION_FIELD_DATE_OF_BIRTH = 'dateOfBirth';

    /**
     * @var string
     */
    public const API_OBJECT_BASKET_ITEM_FIELD_TEXT = 'basketItemText';

    /**
     * @var string
     */
    public const API_OBJECT_BASKET_ITEM_FIELD_ID = 'basketItemID';

    /**
     * @var string
     */
    public const API_OBJECT_BASKET_ITEM_FIELD_COUNT = 'basketItemCount';

    /**
     * @var string
     */
    public const API_OBJECT_BASKET_ITEM_FIELD_AMOUNT = 'basketItemAmount';

    /**
     * @var string
     */
    public const API_OBJECT_BASKET_ITEM_FIELD_RISK_CLASS = 'basketItemRiskClass';

    /**
     * @var string
     */
    public const API_OBJECT_BASKET_ITEM_FIELD_TYPE = 'basketItemType';

    /**
     * @var string
     */
    public const API_OBJECT_COMPANY_FIELD_NAME = 'companyName';

    /**
     * @var string
     */
    public const API_OBJECT_COMPANY_FIELD_EMAIL = 'email';

    /**
     * @var string
     */
    public const API_OBJECT_COMPANY_FIELD_REGISTER_TYPE = 'companyRegisterType';

    /**
     * @var string
     */
    public const API_OBJECT_COMPANY_FIELD_REGISTRATION_ID = 'companyRegistrationID';

    /**
     * @var string
     */
    public const API_OBJECT_COMPANY_FIELD_VAT_ID = 'companyVatID';

    /**
     * @var string
     */
    public const API_OBJECT_COMPANY_FIELD_TAX_ID = 'companyTaxID';

    /**
     * @var string
     */
    public const API_OBJECT_PERSON_FIELD_SALUTATION = 'salutation';

    /**
     * @var string
     */
    public const API_OBJECT_PERSON_FIELD_NAME = 'name';

    /**
     * @var string
     */
    public const API_OBJECT_PERSON_FIELD_SURNAME = 'surname';

    /**
     * @var string
     */
    public const API_OBJECT_PERSON_FIELD_DATE_OF_BIRTH = 'dateOfBirth';

    /**
     * @var string
     */
    public const API_OBJECT_PERSON_FIELD_EMAIL = 'email';

    /**
     * @var string
     */
    public const API_OBJECT_PERSON_FIELD_PHONE_NUMBER = 'phoneNumber';

    /**
     * @var string
     */
    public const API_OBJECT_PERSON_FIELD_FAX_NUMBER = 'faxNumber';


    /**
     * @var string
     */
    public const API_OBJECT_ADDRESS_FIELD_STREET = 'street';

    /**
     * @var string
     */
    public const API_OBJECT_ADDRESS_FIELD_HOUSE_NUMBER = 'no';

    /**
     * @var string
     */
    public const API_OBJECT_ADDRESS_FIELD_ADDITIONAL = 'additional';

    /**
     * @var string
     */
    public const API_OBJECT_ADDRESS_FIELD_ZIP = 'zip';

    /**
     * @var string
     */
    public const API_OBJECT_ADDRESS_FIELD_CITY = 'city';

    /**
     * @var string
     */
    public const API_OBJECT_ADDRESS_FIELD_STATE = 'state';

    /**
     * @var string
     */
    public const API_OBJECT_ADDRESS_FIELD_COUNTRY = 'country';
}
