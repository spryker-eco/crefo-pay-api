<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Builder\Request\CancelRequestBuilder;
use SprykerEco\Zed\CrefoPayApi\Business\Builder\Request\CaptureRequestBuilder;
use SprykerEco\Zed\CrefoPayApi\Business\Builder\Request\CreateTransactionRequestBuilder;
use SprykerEco\Zed\CrefoPayApi\Business\Builder\Request\CrefoPayApiRequestBuilderInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Builder\Request\FinishRequestBuilder;
use SprykerEco\Zed\CrefoPayApi\Business\Builder\Request\RefundRequestBuilder;
use SprykerEco\Zed\CrefoPayApi\Business\Builder\Request\ReserveRequestBuilder;
use SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClient;
use SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClientInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Converter\CancelConverter;
use SprykerEco\Zed\CrefoPayApi\Business\Converter\CaptureConverter;
use SprykerEco\Zed\CrefoPayApi\Business\Converter\CreateTransactionConverter;
use SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Converter\FinishConverter;
use SprykerEco\Zed\CrefoPayApi\Business\Converter\RefundConverter;
use SprykerEco\Zed\CrefoPayApi\Business\Converter\ReserveConverter;
use SprykerEco\Zed\CrefoPayApi\Business\Logger\CrefoPayApiLogger;
use SprykerEco\Zed\CrefoPayApi\Business\Logger\CrefoPayApiLoggerInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Request\CancelRequest;
use SprykerEco\Zed\CrefoPayApi\Business\Request\CaptureRequest;
use SprykerEco\Zed\CrefoPayApi\Business\Request\CreateTransactionRequest;
use SprykerEco\Zed\CrefoPayApi\Business\Request\CrefoPayApiRequestInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Request\FinishRequest;
use SprykerEco\Zed\CrefoPayApi\Business\Request\RefundRequest;
use SprykerEco\Zed\CrefoPayApi\Business\Request\ReserveRequest;
use SprykerEco\Zed\CrefoPayApi\CrefoPayApiDependencyProvider;
use SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface;

/**
 * @method \SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig getConfig()
 * @method \SprykerEco\Zed\CrefoPayApi\Persistence\CrefoPayApiEntityManagerInterface getEntityManager()
 */
class CrefoPayApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClientInterface
     */
    public function createCreateTransactionClient(): CrefoPayApiClientInterface
    {
        return new CrefoPayApiClient(
            $this->createGuzzleClient(),
            $this->createCreateTransactionRequest(),
            $this->createCreateTransactionConverter(),
            $this->createLogger()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClientInterface
     */
    public function createReserveClient(): CrefoPayApiClientInterface
    {
        return new CrefoPayApiClient(
            $this->createGuzzleClient(),
            $this->createReserveRequest(),
            $this->createReserveConverter(),
            $this->createLogger()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClientInterface
     */
    public function createCaptureClient(): CrefoPayApiClientInterface
    {
        return new CrefoPayApiClient(
            $this->createGuzzleClient(),
            $this->createCaptureRequest(),
            $this->createCancelConverter(),
            $this->createLogger()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClientInterface
     */
    public function createCancelClient(): CrefoPayApiClientInterface
    {
        return new CrefoPayApiClient(
            $this->createGuzzleClient(),
            $this->createCancelRequest(),
            $this->createCancelConverter(),
            $this->createLogger()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClientInterface
     */
    public function createRefundClient(): CrefoPayApiClientInterface
    {
        return new CrefoPayApiClient(
            $this->createGuzzleClient(),
            $this->createRefundRequest(),
            $this->createRefundConverter(),
            $this->createLogger()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClientInterface
     */
    public function createFinishClient(): CrefoPayApiClientInterface
    {
        return new CrefoPayApiClient(
            $this->createGuzzleClient(),
            $this->createFinishRequest(),
            $this->createFinishConverter(),
            $this->createLogger()
        );
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    public function createGuzzleClient(): ClientInterface
    {
        return new Client();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Request\CrefoPayApiRequestInterface
     */
    public function createCreateTransactionRequest(): CrefoPayApiRequestInterface
    {
        return new CreateTransactionRequest(
            $this->createCreateTransactionRequestBuilder(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Request\CrefoPayApiRequestInterface
     */
    public function createReserveRequest(): CrefoPayApiRequestInterface
    {
        return new ReserveRequest(
            $this->createReserveRequestBuilder(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Request\CrefoPayApiRequestInterface
     */
    public function createCaptureRequest(): CrefoPayApiRequestInterface
    {
        return new CaptureRequest(
            $this->createCaptureRequestBuilder(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Request\CrefoPayApiRequestInterface
     */
    public function createCancelRequest(): CrefoPayApiRequestInterface
    {
        return new CancelRequest(
            $this->createCancelRequestBuilder(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Request\CrefoPayApiRequestInterface
     */
    public function createRefundRequest(): CrefoPayApiRequestInterface
    {
        return new RefundRequest(
            $this->createRefundRequestBuilder(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Request\CrefoPayApiRequestInterface
     */
    public function createFinishRequest(): CrefoPayApiRequestInterface
    {
        return new FinishRequest(
            $this->createFinishRequestBuilder(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Builder\Request\CrefoPayApiRequestBuilderInterface
     */
    public function createCreateTransactionRequestBuilder(): CrefoPayApiRequestBuilderInterface
    {
        return new CreateTransactionRequestBuilder(
            $this->getUtilEncodingService(),
            $this->getCrefoPayApiService()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Builder\Request\CrefoPayApiRequestBuilderInterface
     */
    public function createReserveRequestBuilder(): CrefoPayApiRequestBuilderInterface
    {
        return new ReserveRequestBuilder(
            $this->getUtilEncodingService(),
            $this->getCrefoPayApiService()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Builder\Request\CrefoPayApiRequestBuilderInterface
     */
    public function createCaptureRequestBuilder(): CrefoPayApiRequestBuilderInterface
    {
        return new CaptureRequestBuilder(
            $this->getUtilEncodingService(),
            $this->getCrefoPayApiService()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Builder\Request\CrefoPayApiRequestBuilderInterface
     */
    public function createCancelRequestBuilder(): CrefoPayApiRequestBuilderInterface
    {
        return new CancelRequestBuilder(
            $this->getUtilEncodingService(),
            $this->getCrefoPayApiService()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Builder\Request\CrefoPayApiRequestBuilderInterface
     */
    public function createRefundRequestBuilder(): CrefoPayApiRequestBuilderInterface
    {
        return new RefundRequestBuilder(
            $this->getUtilEncodingService(),
            $this->getCrefoPayApiService()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Builder\Request\CrefoPayApiRequestBuilderInterface
     */
    public function createFinishRequestBuilder(): CrefoPayApiRequestBuilderInterface
    {
        return new FinishRequestBuilder(
            $this->getUtilEncodingService(),
            $this->getCrefoPayApiService()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface
     */
    public function createCreateTransactionConverter(): CrefoPayApiConverterInterface
    {
        return new CreateTransactionConverter($this->getUtilEncodingService());
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface
     */
    public function createReserveConverter(): CrefoPayApiConverterInterface
    {
        return new ReserveConverter($this->getUtilEncodingService());
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface
     */
    public function createCaptureConverter(): CrefoPayApiConverterInterface
    {
        return new CaptureConverter($this->getUtilEncodingService());
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface
     */
    public function createCancelConverter(): CrefoPayApiConverterInterface
    {
        return new CancelConverter($this->getUtilEncodingService());
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface
     */
    public function createRefundConverter(): CrefoPayApiConverterInterface
    {
        return new RefundConverter($this->getUtilEncodingService());
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface
     */
    public function createFinishConverter(): CrefoPayApiConverterInterface
    {
        return new FinishConverter($this->getUtilEncodingService());
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Logger\CrefoPayApiLoggerInterface
     */
    public function createLogger(): CrefoPayApiLoggerInterface
    {
        return new CrefoPayApiLogger($this->getEntityManager());
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface
     */
    public function getUtilEncodingService(): CrefoPayApiToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(CrefoPayApiDependencyProvider::SERVICE_UTIL_ENCODING);
    }

    /**
     * @return \SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceInterface
     */
    public function getCrefoPayApiService(): CrefoPayApiServiceInterface
    {
        return $this->getProvidedDependency(CrefoPayApiDependencyProvider::SERVICE_CREFO_PAY_API);
    }
}
