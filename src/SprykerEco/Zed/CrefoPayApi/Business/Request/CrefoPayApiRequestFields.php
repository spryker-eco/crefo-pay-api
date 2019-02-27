<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Request;

interface CrefoPayApiRequestFields
{
    public const API_FIELD_MERCHANT_ID = 'merchantID';
    public const API_FIELD_STORE_ID = 'storeID';
    public const API_FIELD_ORDER_ID = 'orderID';
    public const API_FIELD_USER_ID = 'userID';
    public const API_FIELD_CAPTURE_ID = 'captureID';
    public const API_FIELD_INTEGRATION_TYPE = 'integrationType';
    public const API_FIELD_AUTO_CAPTURE = 'autoCapture';
    public const API_FIELD_MERCHANT_REFERENCE = 'merchantReference';
    public const API_FIELD_CONTEXT = 'context';
    public const API_FIELD_USER_TYPE = 'userType';
    public const API_FIELD_USER_RISK_CLASS = 'userRiskClass';
    public const API_FIELD_USER_IP_ADDRESS = 'userIpAddress';
    public const API_FIELD_COMPANY_DATA = 'companyData';
    public const API_FIELD_USER_DATA = 'userData';
    public const API_FIELD_BILLING_RECIPIENT = 'billingRecipient';
    public const API_FIELD_BILLING_ADDRESS = 'billingAddress';
    public const API_FIELD_SHIPPING_RECIPIENT = 'shippingRecipient';
    public const API_FIELD_SHIPPING_ADDRESS = 'shippingAddress';
    public const API_FIELD_AMOUNT = 'amount';
    public const API_FIELD_REFUND_DESCRIPTION = 'refundDescription';
    public const API_FIELD_PAYMENT_METHOD = 'paymentMethod';
    public const API_FIELD_PAYMENT_INSTRUMENT_ID = 'paymentInstrumentID';
    public const API_FIELD_ADDITIONAL_INFORMATION = 'additionalInformation';
    public const API_FIELD_BASKET_ITEMS = 'basketItems';
    public const API_FIELD_BASKET_VALIDITY = 'basketValidity';
    public const API_FIELD_LOCALE = 'locale';
    public const API_FIELD_CVV = 'cvv';
    public const API_FIELD_MAC = 'mac';

    public const API_OBJECT_AMOUNT_FIELD_AMOUNT = 'amount';
    public const API_OBJECT_AMOUNT_FIELD_VAT_AMOUNT = 'vatAmount';
    public const API_OBJECT_AMOUNT_FIELD_VAT_RATE = 'vatRate';

    public const API_OBJECT_ADDITIONAL_INFORMATION_FIELD_SALUTATION = 'salutation';
    public const API_OBJECT_ADDITIONAL_INFORMATION_FIELD_DATE_OF_BIRTH = 'dateOfBirth';

    public const API_OBJECT_BASKET_ITEM_FIELD_TEXT = 'basketItemText';
    public const API_OBJECT_BASKET_ITEM_FIELD_ID = 'basketItemID';
    public const API_OBJECT_BASKET_ITEM_FIELD_COUNT = 'basketItemCount';
    public const API_OBJECT_BASKET_ITEM_FIELD_AMOUNT = 'basketItemAmount';
    public const API_OBJECT_BASKET_ITEM_FIELD_RISK_CLASS = 'basketItemRiskClass';
    public const API_OBJECT_BASKET_ITEM_FIELD_TYPE = 'basketItemType';

    public const API_OBJECT_COMPANY_FIELD_NAME = 'companyName';
    public const API_OBJECT_COMPANY_FIELD_EMAIL = 'email';
    public const API_OBJECT_COMPANY_FIELD_REGISTER_TYPE = 'companyRegisterType';
    public const API_OBJECT_COMPANY_FIELD_REGISTRATION_ID = 'companyRegistrationID';
    public const API_OBJECT_COMPANY_FIELD_VAT_ID = 'companyVatID';
    public const API_OBJECT_COMPANY_FIELD_TAX_ID = 'companyTaxID';

    public const API_OBJECT_PERSON_FIELD_SALUTATION = 'salutation';
    public const API_OBJECT_PERSON_FIELD_NAME = 'name';
    public const API_OBJECT_PERSON_FIELD_SURNAME = 'surname';
    public const API_OBJECT_PERSON_FIELD_DATE_OF_BIRTH = 'dateOfBirth';
    public const API_OBJECT_PERSON_FIELD_EMAIL = 'email';
    public const API_OBJECT_PERSON_FIELD_PHONE_NUMBER = 'phoneNumber';
    public const API_OBJECT_PERSON_FIELD_FAX_NUMBER = 'faxNumber';

    public const API_OBJECT_ADDRESS_FIELD_STREET = 'street';
    public const API_OBJECT_ADDRESS_FIELD_HOUSE_NUMBER = 'no';
    public const API_OBJECT_ADDRESS_FIELD_ADDITIONAL = 'additional';
    public const API_OBJECT_ADDRESS_FIELD_ZIP = 'zip';
    public const API_OBJECT_ADDRESS_FIELD_CITY = 'city';
    public const API_OBJECT_ADDRESS_FIELD_STATE = 'state';
    public const API_OBJECT_ADDRESS_FIELD_COUNTRY = 'country';
}
