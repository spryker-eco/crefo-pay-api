<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClient;
use SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClientInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Converter\CancelConverter;
use SprykerEco\Zed\CrefoPayApi\Business\Converter\CaptureConverter;
use SprykerEco\Zed\CrefoPayApi\Business\Converter\CreateTransactionConverter;
use SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Converter\FinishConverter;
use SprykerEco\Zed\CrefoPayApi\Business\Converter\RefundConverter;
use SprykerEco\Zed\CrefoPayApi\Business\Converter\ReserveConverter;
use SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\CancelRequestValidator;
use SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\CaptureRequestValidator;
use SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\CreateTransactionRequestValidator;
use SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\CrefoPayApiRequestValidatorInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\FinishRequestValidator;
use SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\RefundRequestValidator;
use SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\ReserveRequestValidator;
use SprykerEco\Zed\CrefoPayApi\Business\Validator\Response\CancelResponseValidator;
use SprykerEco\Zed\CrefoPayApi\Business\Validator\Response\CaptureResponseValidator;
use SprykerEco\Zed\CrefoPayApi\Business\Validator\Response\CreateTransactionResponseValidator;
use SprykerEco\Zed\CrefoPayApi\Business\Validator\Response\CrefoPayApiResponseValidatorInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Validator\Response\FinishResponseValidator;
use SprykerEco\Zed\CrefoPayApi\Business\Validator\Response\RefundResponseValidator;
use SprykerEco\Zed\CrefoPayApi\Business\Validator\Response\ReserveResponseValidator;
use SprykerEco\Zed\CrefoPayApi\CrefoPayApiDependencyProvider;
use SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface;

/**
 * @method \SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig getConfig()
 */
class CrefoPayApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClientInterface
     */
    public function createCreateTransactionClient(): CrefoPayApiClientInterface
    {
        return new CrefoPayApiClient(
            $this->createGuzzleClient()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClientInterface
     */
    public function createReserveClient(): CrefoPayApiClientInterface
    {
        return new CrefoPayApiClient(
            $this->createGuzzleClient()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClientInterface
     */
    public function createCaptureClient(): CrefoPayApiClientInterface
    {
        return new CrefoPayApiClient(
            $this->createGuzzleClient()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClientInterface
     */
    public function createCancelClient(): CrefoPayApiClientInterface
    {
        return new CrefoPayApiClient(
            $this->createGuzzleClient()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClientInterface
     */
    public function createRefundClient(): CrefoPayApiClientInterface
    {
        return new CrefoPayApiClient(
            $this->createGuzzleClient()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Client\CrefoPayApiClientInterface
     */
    public function createFinishClient(): CrefoPayApiClientInterface
    {
        return new CrefoPayApiClient(
            $this->createGuzzleClient()
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
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\CrefoPayApiRequestValidatorInterface
     */
    public function createCreateTransactionRequestValidator(): CrefoPayApiRequestValidatorInterface
    {
        return new CreateTransactionRequestValidator();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\CrefoPayApiRequestValidatorInterface
     */
    public function createReserveRequestValidator(): CrefoPayApiRequestValidatorInterface
    {
        return new ReserveRequestValidator();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\CrefoPayApiRequestValidatorInterface
     */
    public function createCaptureRequestValidator(): CrefoPayApiRequestValidatorInterface
    {
        return new CaptureRequestValidator();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\CrefoPayApiRequestValidatorInterface
     */
    public function createCancelRequestValidator(): CrefoPayApiRequestValidatorInterface
    {
        return new CancelRequestValidator();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\CrefoPayApiRequestValidatorInterface
     */
    public function createRefundRequestValidator(): CrefoPayApiRequestValidatorInterface
    {
        return new RefundRequestValidator();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\CrefoPayApiRequestValidatorInterface
     */
    public function createFinishRequestValidator(): CrefoPayApiRequestValidatorInterface
    {
        return new FinishRequestValidator();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface
     */
    public function createCreateTransactionConverter(): CrefoPayApiConverterInterface
    {
        return new CreateTransactionConverter(
            $this->createCreateTransactionResponseValidator(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface
     */
    public function createReserveConverter(): CrefoPayApiConverterInterface
    {
        return new ReserveConverter(
            $this->createReserveResponseValidator(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface
     */
    public function createCaptureConverter(): CrefoPayApiConverterInterface
    {
        return new CaptureConverter(
            $this->createCaptureResponseValidator(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface
     */
    public function createCancelConverter(): CrefoPayApiConverterInterface
    {
        return new CancelConverter(
            $this->createCancelResponseValidator(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface
     */
    public function createRefundConverter(): CrefoPayApiConverterInterface
    {
        return new RefundConverter(
            $this->createRefundResponseValidator(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface
     */
    public function createFinishConverter(): CrefoPayApiConverterInterface
    {
        return new FinishConverter(
            $this->createFinishResponseValidator(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Validator\Response\CrefoPayApiResponseValidatorInterface
     */
    public function createCreateTransactionResponseValidator(): CrefoPayApiResponseValidatorInterface
    {
        return new CreateTransactionResponseValidator();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Validator\Response\CrefoPayApiResponseValidatorInterface
     */
    public function createReserveResponseValidator(): CrefoPayApiResponseValidatorInterface
    {
        return new ReserveResponseValidator();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Validator\Response\CrefoPayApiResponseValidatorInterface
     */
    public function createCaptureResponseValidator(): CrefoPayApiResponseValidatorInterface
    {
        return new CaptureResponseValidator();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Validator\Response\CrefoPayApiResponseValidatorInterface
     */
    public function createCancelResponseValidator(): CrefoPayApiResponseValidatorInterface
    {
        return new CancelResponseValidator();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Validator\Response\CrefoPayApiResponseValidatorInterface
     */
    public function createRefundResponseValidator(): CrefoPayApiResponseValidatorInterface
    {
        return new RefundResponseValidator();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Business\Validator\Response\CrefoPayApiResponseValidatorInterface
     */
    public function createFinishResponseValidator(): CrefoPayApiResponseValidatorInterface
    {
        return new FinishResponseValidator();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface
     */
    public function getUtilEncodingService(): CrefoPayApiToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(CrefoPayApiDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
