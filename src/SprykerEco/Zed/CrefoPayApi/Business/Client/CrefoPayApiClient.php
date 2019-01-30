<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Client;

use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;
use SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Logger\CrefoPayApiLoggerInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Request\CrefoPayApiRequestInterface;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\CrefoPayApiGuzzleHttpClientAdapterInterface;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Exception\CrefoPayApiGuzzleRequestException;

class CrefoPayApiClient implements CrefoPayApiClientInterface
{
    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\CrefoPayApiGuzzleHttpClientAdapterInterface
     */
    protected $httpClient;

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Business\Request\CrefoPayApiRequestInterface
     */
    protected $request;

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface
     */
    protected $converter;

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Business\Logger\CrefoPayApiLoggerInterface
     */
    protected $logger;

    /**
     * @param \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\CrefoPayApiGuzzleHttpClientAdapterInterface $httpClient
     * @param \SprykerEco\Zed\CrefoPayApi\Business\Request\CrefoPayApiRequestInterface $request
     * @param \SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface $converter
     * @param \SprykerEco\Zed\CrefoPayApi\Business\Logger\CrefoPayApiLoggerInterface $logger
     */
    public function __construct(
        CrefoPayApiGuzzleHttpClientAdapterInterface $httpClient,
        CrefoPayApiRequestInterface $request,
        CrefoPayApiConverterInterface $converter,
        CrefoPayApiLoggerInterface $logger
    ) {
        $this->httpClient = $httpClient;
        $this->request = $request;
        $this->converter = $converter;
        $this->logger = $logger;

    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function performRequest(CrefoPayApiRequestTransfer $requestTransfer): CrefoPayApiResponseTransfer
    {
        $isSuccess = true;

        try {
            $response = $this->httpClient->post(
                $this->request->getUrl(),
                $this->request->getFormParams($requestTransfer)
            );

        } catch (CrefoPayApiGuzzleRequestException $requestException) {
            $isSuccess = false;
            $response = $requestException->getResponse();
        }

        $responseTransfer = $this->converter->convertToResponseTransfer($response, $isSuccess);
        $paymentCrefoPayApiLogTransfer = $this->logger
            ->logApiCall(
                $requestTransfer,
                $responseTransfer,
                $this->request->getRequestType()
            );

        $responseTransfer->setCrefoPayApiLogId($paymentCrefoPayApiLogTransfer->getIdPaymentCrefoPayApiLog());

        return $responseTransfer;
    }
}