<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\CrefoPayApi;

use ArrayObject;
use Codeception\Actor;
use Codeception\Scenario;
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
 *
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

    /**
     * @var int
     */
    protected const MERCHANT_ID = 265;

    /**
     * @var string
     */
    protected const STORE_ID = 'SprykerDevTestEUR';

    /**
     * @var string
     */
    protected const ORDER_ID = 'DE--22-5c9098f724af27.85915877';

    /**
     * @var string
     */
    protected const USER_ID = 'DE--22';

    /**
     * @var string
     */
    protected const INTEGRATION_TYPE = 'SecureFields';

    /**
     * @var string
     */
    protected const AUTO_CAPTURE = 'false';

    /**
     * @var string
     */
    protected const CONTEXT = 'ONLINE';

    /**
     * @var string
     */
    protected const USER_TYPE = 'PRIVATE';

    /**
     * @var int
     */
    protected const USER_RISK_CLASS = 1;

    /**
     * @var string
     */
    protected const USER_IP_ADDRESS = '10.10.0.1';

    /**
     * @var string
     */
    protected const PERSON_SALUTATION = 'M';

    /**
     * @var string
     */
    protected const PERSON_NAME = 'John';

    /**
     * @var string
     */
    protected const PERSON_SURNAME = 'Doe';

    /**
     * @var string
     */
    protected const PERSON_EMAIL = 'john.doe@mail.com';

    /**
     * @var string
     */
    protected const ADDRESS_STREET = 'Street';

    /**
     * @var string
     */
    protected const ADDRESS_NO = '130';

    /**
     * @var string
     */
    protected const ADDRESS_ADDITIONAL = 'Additional';

    /**
     * @var string
     */
    protected const ADDRESS_ZIP = '20537';

    /**
     * @var string
     */
    protected const ADDRESS_CITY = 'Hamburg';

    /**
     * @var string
     */
    protected const ADDRESS_COUNTRY = 'DE';

    /**
     * @var int
     */
    protected const AMOUNT_AMOUNT = 26772;

    /**
     * @var int
     */
    protected const AMOUNT_VAT_RATE = 19;

    /**
     * @var int
     */
    protected const AMOUNT_VAT_AMOUNT = 4275;

    /**
     * @var string
     */
    protected const BASKET_ITEM_TYPE = 'DEFAULT';

    /**
     * @var int
     */
    protected const BASKET_ITEM_RISK_CLASS = 1;

    /**
     * @var string
     */
    protected const BASKET_ITEM_TEXT = 'Canon PowerShot N';

    /**
     * @var string
     */
    protected const BASKET_ITEM_ID = '035_17360369';

    /**
     * @var int
     */
    protected const BASKET_ITEM_COUNT = 2;

    /**
     * @var string
     */
    protected const BASKET_ITEM_SHIPPING_TYPE = 'SHIPPINGCOSTS';

    /**
     * @var string
     */
    protected const BASKET_ITEM_SHIPPING_TEXT = 'Shipping Costs';

    /**
     * @var int
     */
    protected const BASKET_ITEM_SHIPPING_COUNT = 1;

    /**
     * @var int
     */
    protected const BASKET_ITEM_SHIPPING_AMOUNT = 1000;

    /**
     * @var int
     */
    protected const BASKET_ITEM_SHIPPING_VAT_RATE = 19;

    /**
     * @var int
     */
    protected const BASKET_ITEM_SHIPPING_VAT_AMOUNT = 160;

    /**
     * @var string
     */
    protected const LOCALE = 'EN';

    /**
     * @var string
     */
    protected const PAYMENT_METHOD = 'CC';

    /**
     * @var string
     */
    protected const PAYMENT_INSTRUMENT_ID = '3DQ0kvzLkDQJ18Th5n-8Gg';

    /**
     * @var string
     */
    protected const CAPTURE_ID = '64c8a11132f11d5cd3ed83bf89f64b';

    /**
     * @var string
     */
    protected const REFUND_DESCRIPTION = 'Refund description';

    /**
     * @param \Codeception\Scenario $scenario
     */
    public function __construct(Scenario $scenario)
    {
        parent::__construct($scenario);
        $this->setUpConfig();
    }

    /**
     * @return void
     */
    public function setUpConfig(): void
    {
        $this->setConfig('CREFO_PAY_API:CREATE_TRANSACTION_API_ENDPOINT', 'https://sandbox.crefopay.de/2.0/createTransaction');
        $this->setConfig('CREFO_PAY_API:RESERVE_API_ENDPOINT', 'https://sandbox.crefopay.de/2.0/reserve');
        $this->setConfig('CREFO_PAY_API:CAPTURE_API_ENDPOINT', 'https://sandbox.crefopay.de/2.0/capture');
        $this->setConfig('CREFO_PAY_API:CANCEL_API_ENDPOINT', 'https://sandbox.crefopay.de/2.0/cancel');
        $this->setConfig('CREFO_PAY_API:REFUND_API_ENDPOINT', 'https://sandbox.crefopay.de/2.0/refund');
        $this->setConfig('CREFO_PAY_API:FINISH_API_ENDPOINT', 'https://sandbox.crefopay.de/2.0/finish');
        $this->setConfig('CREFO_PAY_API:PRIVATE_KEY', 'GE2PM37816PYL4D7');
        $this->setConfig('CREFO_PAY_API:PUBLIC_KEY', 'c90f2f01d8bbf5c923b6acfb15eb18bd9ad0d230c4ca0d736d538cfed69685b9');
    }

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
