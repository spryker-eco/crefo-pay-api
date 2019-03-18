<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\CrefoPayApi;

use Codeception\Actor;
use Generated\Shared\Transfer\CrefoPayApiCancelRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiCaptureRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiCreateTransactionRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiFinishRequestTransfer;
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
        return (new CrefoPayApiCreateTransactionRequestTransfer());
    }

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiReserveRequestTransfer
     */
    protected function createReserveApiRequestTransfer(): CrefoPayApiReserveRequestTransfer
    {
        return (new CrefoPayApiReserveRequestTransfer());
    }

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiCancelRequestTransfer
     */
    protected function createCancelApiRequestTransfer(): CrefoPayApiCancelRequestTransfer
    {
        return (new CrefoPayApiCancelRequestTransfer());
    }

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiCaptureRequestTransfer
     */
    protected function createCaptureApiRequestTransfer(): CrefoPayApiCaptureRequestTransfer
    {
        return (new CrefoPayApiCaptureRequestTransfer());
    }

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiRefundRequestTransfer
     */
    protected function createRefundApiRequestTransfer(): CrefoPayApiRefundRequestTransfer
    {
        return (new CrefoPayApiRefundRequestTransfer());
    }

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiFinishRequestTransfer
     */
    protected function createFinishApiRequestTransfer(): CrefoPayApiFinishRequestTransfer
    {
        return (new CrefoPayApiFinishRequestTransfer());
    }
}
