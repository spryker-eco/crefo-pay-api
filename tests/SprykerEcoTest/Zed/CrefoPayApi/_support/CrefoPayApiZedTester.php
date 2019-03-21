<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\CrefoPayApi;

use ArrayObject;
use Codeception\Actor;
use Generated\Shared\Transfer\CrefoPayApiAddressTransfer;
use Generated\Shared\Transfer\CrefoPayApiAmountTransfer;
use Generated\Shared\Transfer\CrefoPayApiBasketItemTransfer;
use Generated\Shared\Transfer\CrefoPayApiCancelRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiCaptureRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiCreateTransactionRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiFinishRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiPersonTransfer;
use Generated\Shared\Transfer\CrefoPayApiRefundRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiReserveRequestTransfer;
use SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceInterface;
use SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\CrefoPayApiGuzzleHttpClientAdapter;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\CrefoPayApiGuzzleHttpClientAdapterInterface;
use SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceBridge;
use SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface;
use SprykerEco\Zed\CrefoPayApi\Persistence\CrefoPayApiEntityManager;
use SprykerEco\Zed\CrefoPayApi\Persistence\CrefoPayApiEntityManagerInterface;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class CrefoPayApiZedTester extends Actor
{
    use _generated\CrefoPayApiZedTesterActions;

    protected const MERCHANT_ID = 265;
    protected const STORE_ID = 'SprykerDevTestEUR';
    protected const ORDER_ID = 'DE--22-5c9098f724af27.85915877';
    protected const USER_ID = 'DE--22';
    protected const INTEGRATION_TYPE = 'SecureFields';
    protected const AUTO_CAPTURE = 'false';
    protected const CONTEXT = 'ONLINE';
    protected const USER_TYPE = 'PRIVATE';
    protected const USER_RISK_CLASS = 1;
    protected const USER_IP_ADDRESS = '10.10.0.1';
    protected const PERSON_SALUTATION = 'M';
    protected const PERSON_NAME = 'John';
    protected const PERSON_SURNAME = 'Doe';
    protected const PERSON_EMAIL = 'john.doe@mail.com';
    protected const ADDRESS_STREET = 'Street';
    protected const ADDRESS_NO = '130';
    protected const ADDRESS_ADDITIONAL = 'Additional';
    protected const ADDRESS_ZIP = '20537';
    protected const ADDRESS_CITY = 'Hamburg';
    protected const ADDRESS_COUNTRY = 'DE';
    protected const AMOUNT_AMOUNT = 26772;
    protected const AMOUNT_VAT_RATE = 19;
    protected const AMOUNT_VAT_AMOUNT = 4275;
    protected const BASKET_ITEM_TYPE = 'DEFAULT';
    protected const BASKET_ITEM_RISK_CLASS = 1;
    protected const BASKET_ITEM_TEXT = 'Canon PowerShot N';
    protected const BASKET_ITEM_ID = '035_17360369';
    protected const BASKET_ITEM_COUNT = 2;
    protected const BASKET_ITEM_SHIPPING_TYPE = 'SHIPPINGCOSTS';
    protected const BASKET_ITEM_SHIPPING_TEXT = 'Shipping Costs';
    protected const BASKET_ITEM_SHIPPING_COUNT = 1;
    protected const BASKET_ITEM_SHIPPING_AMOUNT = 1000;
    protected const BASKET_ITEM_SHIPPING_VAT_RATE = 19;
    protected const BASKET_ITEM_SHIPPING_VAT_AMOUNT = 160;
    protected const LOCALE = 'EN';
    protected const PAYMENT_METHOD = 'CC';
    protected const PAYMENT_INSTRUMENT_ID = '3DQ0kvzLkDQJ18Th5n-8Gg';
    protected const CAPTURE_ID = '64c8a11132f11d5cd3ed83bf89f64b';
    protected const REFUND_DESCRIPTION = 'Refund description';

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiRequestTransfer
     */
    public function createRequestTransfer(): CrefoPayApiRequestTransfer
    {
        return (new CrefoPayApiRequestTransfer())
            ->setCreateTransactionRequest($this->createCreateTransactionApiRequestTransfer())
            ->setReserveRequest($this->createReserveApiRequestTransfer())
            ->setCancelRequest($this->createCancelApiRequestTransfer())
            ->setCaptureRequest($this->createCaptureApiRequestTransfer())
            ->setRefundRequest($this->createRefundApiRequestTransfer())
            ->setFinishRequest($this->createFinishApiRequestTransfer());
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig
     */
    public function createConfig(): CrefoPayApiConfig
    {
        return new CrefoPayApiConfig();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Persistence\CrefoPayApiEntityManagerInterface
     */
    public function createEntityManager(): CrefoPayApiEntityManagerInterface
    {
        return new CrefoPayApiEntityManager();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface
     */
    public function createUtilEncodingService(): CrefoPayApiToUtilEncodingServiceInterface
    {
        return new CrefoPayApiToUtilEncodingServiceBridge($this->getLocator()->utilEncoding()->service());
    }

    /**
     * @return \SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceInterface
     */
    public function createCrefoPayApiService(): CrefoPayApiServiceInterface
    {
        return $this->getLocator()->crefoPayApi()->service();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\CrefoPayApiGuzzleHttpClientAdapterInterface
     */
    public function createCrefoPayApiHttpClient(): CrefoPayApiGuzzleHttpClientAdapterInterface
    {
        return new CrefoPayApiGuzzleHttpClientAdapter();
    }

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiCreateTransactionRequestTransfer
     */
    protected function createCreateTransactionApiRequestTransfer(): CrefoPayApiCreateTransactionRequestTransfer
    {
        return (new CrefoPayApiCreateTransactionRequestTransfer())
            ->setMerchantID(static::MERCHANT_ID)
            ->setStoreID(static::STORE_ID)
            ->setOrderID(static::ORDER_ID)
            ->setUserID(static::USER_ID)
            ->setIntegrationType(static::INTEGRATION_TYPE)
            ->setAutoCapture(static::AUTO_CAPTURE)
            ->setContext(static::CONTEXT)
            ->setUserType(static::USER_TYPE)
            ->setUserRiskClass(static::USER_RISK_CLASS)
            ->setUserIpAddress(static::USER_IP_ADDRESS)
            ->setUserData($this->createCrefoPayApiPersonTransfer())
            ->setBillingAddress($this->createCrefoPayApiAddressTransfer())
            ->setShippingAddress($this->createCrefoPayApiAddressTransfer())
            ->setAmount($this->createCrefoPayApiAmountTransfer())
            ->setBasketItems($this->createBasket())
            ->setLocale(static::LOCALE);
    }

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiReserveRequestTransfer
     */
    protected function createReserveApiRequestTransfer(): CrefoPayApiReserveRequestTransfer
    {
        return (new CrefoPayApiReserveRequestTransfer())
            ->setMerchantID(static::MERCHANT_ID)
            ->setStoreID(static::STORE_ID)
            ->setOrderID(static::ORDER_ID)
            ->setPaymentMethod(static::PAYMENT_METHOD)
            ->setPaymentInstrumentID(static::PAYMENT_INSTRUMENT_ID)
            ->setAmount($this->createCrefoPayApiAmountTransfer())
            ->setBasketItems($this->createBasket());
    }

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiCancelRequestTransfer
     */
    protected function createCancelApiRequestTransfer(): CrefoPayApiCancelRequestTransfer
    {
        return (new CrefoPayApiCancelRequestTransfer())
            ->setMerchantID(static::MERCHANT_ID)
            ->setStoreID(static::STORE_ID)
            ->setOrderID(static::ORDER_ID);
    }

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiCaptureRequestTransfer
     */
    protected function createCaptureApiRequestTransfer(): CrefoPayApiCaptureRequestTransfer
    {
        return (new CrefoPayApiCaptureRequestTransfer())
            ->setMerchantID(static::MERCHANT_ID)
            ->setStoreID(static::STORE_ID)
            ->setOrderID(static::ORDER_ID)
            ->setCaptureID(static::CAPTURE_ID)
            ->setAmount($this->createCrefoPayApiAmountTransfer());
    }

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiRefundRequestTransfer
     */
    protected function createRefundApiRequestTransfer(): CrefoPayApiRefundRequestTransfer
    {
        return (new CrefoPayApiRefundRequestTransfer())
            ->setMerchantID(static::MERCHANT_ID)
            ->setStoreID(static::STORE_ID)
            ->setOrderID(static::ORDER_ID)
            ->setCaptureID(static::CAPTURE_ID)
            ->setAmount($this->createCrefoPayApiAmountTransfer())
            ->setRefundDescription(static::REFUND_DESCRIPTION);
    }

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiFinishRequestTransfer
     */
    protected function createFinishApiRequestTransfer(): CrefoPayApiFinishRequestTransfer
    {
        return (new CrefoPayApiFinishRequestTransfer())
            ->setMerchantID(static::MERCHANT_ID)
            ->setStoreID(static::STORE_ID)
            ->setOrderID(static::ORDER_ID);
    }

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiPersonTransfer
     */
    protected function createCrefoPayApiPersonTransfer(): CrefoPayApiPersonTransfer
    {
        return (new CrefoPayApiPersonTransfer())
            ->setSalutation(static::PERSON_SALUTATION)
            ->setName(static::PERSON_NAME)
            ->setSurname(static::PERSON_SURNAME)
            ->setEmail(static::PERSON_EMAIL);
    }

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiAddressTransfer
     */
    protected function createCrefoPayApiAddressTransfer(): CrefoPayApiAddressTransfer
    {
        return (new CrefoPayApiAddressTransfer())
            ->setStreet(static::ADDRESS_STREET)
            ->setNo(static::ADDRESS_NO)
            ->setAdditional(static::ADDRESS_ADDITIONAL)
            ->setZip(static::ADDRESS_ZIP)
            ->setCity(static::ADDRESS_CITY)
            ->setCountry(static::ADDRESS_COUNTRY);
    }

    /**
     * @return \ArrayObject
     */
    protected function createBasket(): ArrayObject
    {
        $item = (new CrefoPayApiBasketItemTransfer())
            ->setBasketItemType(static::BASKET_ITEM_TYPE)
            ->setBasketItemRiskClass(static::BASKET_ITEM_RISK_CLASS)
            ->setBasketItemText(static::BASKET_ITEM_TEXT)
            ->setBasketItemID(static::BASKET_ITEM_ID)
            ->setBasketItemCount(static::BASKET_ITEM_COUNT)
            ->setBasketItemAmount($this->createCrefoPayApiAmountTransfer());

        $shippingCost = (new CrefoPayApiBasketItemTransfer())
            ->setBasketItemType(static::BASKET_ITEM_SHIPPING_TYPE)
            ->setBasketItemText(static::BASKET_ITEM_SHIPPING_TEXT)
            ->setBasketItemCount(static::BASKET_ITEM_SHIPPING_COUNT)
            ->setBasketItemAmount($this->createShippingCrefoPayApiAmountTransfer());

        return new ArrayObject([$item, $shippingCost]);
    }

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiAmountTransfer
     */
    protected function createCrefoPayApiAmountTransfer(): CrefoPayApiAmountTransfer
    {
        return (new CrefoPayApiAmountTransfer())
            ->setAmount(static::AMOUNT_AMOUNT)
            ->setVatRate(static::AMOUNT_VAT_RATE)
            ->setVatAmount(static::AMOUNT_VAT_AMOUNT);
    }

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiAmountTransfer
     */
    protected function createShippingCrefoPayApiAmountTransfer(): CrefoPayApiAmountTransfer
    {
        return (new CrefoPayApiAmountTransfer())
            ->setAmount(static::BASKET_ITEM_SHIPPING_AMOUNT)
            ->setVatRate(static::BASKET_ITEM_SHIPPING_VAT_RATE)
            ->setVatAmount(static::BASKET_ITEM_SHIPPING_VAT_AMOUNT);
    }
}
