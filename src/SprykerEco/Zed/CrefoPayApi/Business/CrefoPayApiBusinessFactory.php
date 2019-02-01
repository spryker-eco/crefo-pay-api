<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Request\Builder\CancelRequestBuilder;
use SprykerEco\Zed\CrefoPayApi\Business\Request\Builder\CaptureRequestBuilder;
use SprykerEco\Zed\CrefoPayApi\Business\Request\Builder\CreateTransactionRequestBuilder;
use SprykerEco\Zed\CrefoPayApi\Business\Request\Builder\CrefoPayApiRequestBuilderInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Request\Builder\FinishRequestBuilder;
use SprykerEco\Zed\CrefoPayApi\Business\Request\Builder\RefundRequestBuilder;
use SprykerEco\Zed\CrefoPayApi\Business\Request\Builder\ReserveRequestBuilder;
use SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClient;
use SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClientInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Response\Converter\CrefoPayApiResponseConverter;
use SprykerEco\Zed\CrefoPayApi\Business\Response\Converter\CrefoPayApiResponseConverterInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Response\Mapper\CancelResponseMapper;
use SprykerEco\Zed\CrefoPayApi\Business\Response\Mapper\CaptureResponseMapper;
use SprykerEco\Zed\CrefoPayApi\Business\Response\Mapper\CreateTransactionResponseMapper;
use SprykerEco\Zed\CrefoPayApi\Business\Response\Mapper\CrefoPayApiResponseMapperInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Response\Mapper\FinishResponseMapper;
use SprykerEco\Zed\CrefoPayApi\Business\Response\Mapper\RefundResponseMapper;
use SprykerEco\Zed\CrefoPayApi\Business\Response\Mapper\ReserveResponseMapper;
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
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\CrefoPayApiGuzzleHttpClientAdapterInterface;
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
            $this->getCrefoPayApiHttpClient(),
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
            $this->getCrefoPayApiHttpClient(),
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
            $this->getCrefoPayApiHttpClient(),
            $this->createCaptureRequest(),
            $this->createCaptureConverter(),
            $this->createLogger()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClientInterface
     */
    public function createCancelClient(): CrefoPayApiClientInterface
    {
        return new CrefoPayApiClient(
            $this->getCrefoPayApiHttpClient(),
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
            $this->getCrefoPayApiHttpClient(),
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
            $this->getCrefoPayApiHttpClient(),
            $this->createFinishRequest(),
            $this->createFinishConverter(),
            $this->createLogger()
        );
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
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Request\Builder\CrefoPayApiRequestBuilderInterface
     */
    public function createCreateTransactionRequestBuilder(): CrefoPayApiRequestBuilderInterface
    {
        return new CreateTransactionRequestBuilder(
            $this->getUtilEncodingService(),
            $this->getCrefoPayApiService(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Request\Builder\CrefoPayApiRequestBuilderInterface
     */
    public function createReserveRequestBuilder(): CrefoPayApiRequestBuilderInterface
    {
        return new ReserveRequestBuilder(
            $this->getUtilEncodingService(),
            $this->getCrefoPayApiService(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Request\Builder\CrefoPayApiRequestBuilderInterface
     */
    public function createCaptureRequestBuilder(): CrefoPayApiRequestBuilderInterface
    {
        return new CaptureRequestBuilder(
            $this->getUtilEncodingService(),
            $this->getCrefoPayApiService(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Request\Builder\CrefoPayApiRequestBuilderInterface
     */
    public function createCancelRequestBuilder(): CrefoPayApiRequestBuilderInterface
    {
        return new CancelRequestBuilder(
            $this->getUtilEncodingService(),
            $this->getCrefoPayApiService(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Request\Builder\CrefoPayApiRequestBuilderInterface
     */
    public function createRefundRequestBuilder(): CrefoPayApiRequestBuilderInterface
    {
        return new RefundRequestBuilder(
            $this->getUtilEncodingService(),
            $this->getCrefoPayApiService(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Request\Builder\CrefoPayApiRequestBuilderInterface
     */
    public function createFinishRequestBuilder(): CrefoPayApiRequestBuilderInterface
    {
        return new FinishRequestBuilder(
            $this->getUtilEncodingService(),
            $this->getCrefoPayApiService(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Response\Converter\CrefoPayApiResponseConverterInterface
     */
    public function createCreateTransactionConverter(): CrefoPayApiResponseConverterInterface
    {
        return new CrefoPayApiResponseConverter(
            $this->getUtilEncodingService(),
            $this->createCreateTransactionResponseMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Response\Converter\CrefoPayApiResponseConverterInterface
     */
    public function createReserveConverter(): CrefoPayApiResponseConverterInterface
    {
        return new CrefoPayApiResponseConverter(
            $this->getUtilEncodingService(),
            $this->createReserveResponseMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Response\Converter\CrefoPayApiResponseConverterInterface
     */
    public function createCaptureConverter(): CrefoPayApiResponseConverterInterface
    {
        return new CrefoPayApiResponseConverter(
            $this->getUtilEncodingService(),
            $this->createCaptureResponseMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Response\Converter\CrefoPayApiResponseConverterInterface
     */
    public function createCancelConverter(): CrefoPayApiResponseConverterInterface
    {
        return new CrefoPayApiResponseConverter(
            $this->getUtilEncodingService(),
            $this->createCancelResponseMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Response\Converter\CrefoPayApiResponseConverterInterface
     */
    public function createRefundConverter(): CrefoPayApiResponseConverterInterface
    {
        return new CrefoPayApiResponseConverter(
            $this->getUtilEncodingService(),
            $this->createRefundResponseMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Response\Converter\CrefoPayApiResponseConverterInterface
     */
    public function createFinishConverter(): CrefoPayApiResponseConverterInterface
    {
        return new CrefoPayApiResponseConverter(
            $this->getUtilEncodingService(),
            $this->createFinishResponseMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Response\Mapper\CrefoPayApiResponseMapperInterface
     */
    public function createCreateTransactionResponseMapper(): CrefoPayApiResponseMapperInterface
    {
        return new CreateTransactionResponseMapper();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Response\Mapper\CrefoPayApiResponseMapperInterface
     */
    public function createReserveResponseMapper(): CrefoPayApiResponseMapperInterface
    {
        return new ReserveResponseMapper();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Response\Mapper\CrefoPayApiResponseMapperInterface
     */
    public function createCaptureResponseMapper(): CrefoPayApiResponseMapperInterface
    {
        return new CaptureResponseMapper();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Response\Mapper\CrefoPayApiResponseMapperInterface
     */
    public function createCancelResponseMapper(): CrefoPayApiResponseMapperInterface
    {
        return new CancelResponseMapper();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Response\Mapper\CrefoPayApiResponseMapperInterface
     */
    public function createRefundResponseMapper(): CrefoPayApiResponseMapperInterface
    {
        return new RefundResponseMapper();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Response\Mapper\CrefoPayApiResponseMapperInterface
     */
    public function createFinishResponseMapper(): CrefoPayApiResponseMapperInterface
    {
        return new FinishResponseMapper();
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

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\CrefoPayApiGuzzleHttpClientAdapterInterface
     */
    public function getCrefoPayApiHttpClient(): CrefoPayApiGuzzleHttpClientAdapterInterface
    {
        return $this->getProvidedDependency(CrefoPayApiDependencyProvider::CREFO_PAY_API_HTTP_CLIENT);
    }
}
