<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Client;

use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Logger\CrefoPayApiLoggerInterface;
use SprykerEco\Zed\CrefoPayApi\Business\Request\CrefoPayApiRequestInterface;

class CrefoPayApiClient implements CrefoPayApiClientInterface
{
    /**
     * @var \GuzzleHttp\ClientInterface|\GuzzleHttp\Client
     */
    protected $client;

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
     * @param \GuzzleHttp\ClientInterface|\GuzzleHttp\Client $client
     * @param \SprykerEco\Zed\CrefoPayApi\Business\Request\CrefoPayApiRequestInterface $request
     * @param \SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface $converter
     * @param \SprykerEco\Zed\CrefoPayApi\Business\Logger\CrefoPayApiLoggerInterface $logger
     */
    public function __construct(
        ClientInterface $client,
        CrefoPayApiRequestInterface $request,
        CrefoPayApiConverterInterface $converter,
        CrefoPayApiLoggerInterface $logger
    ) {
        $this->client = $client;
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
            $response = $this->client->post(
                $this->request->getUrl(),
                $this->request->getRequestOptions($requestTransfer)
            );

        } catch (RequestException $requestException) {
            $isSuccess = false;
            $response = $requestException->getResponse();
        }

        $responseTransfer = $this->converter->convertToResponseTransfer($response, $isSuccess);
        $this->logger
            ->logApiCall(
                $requestTransfer,
                $responseTransfer,
                $this->request->getRequestType()
            );

        return $responseTransfer;
    }
}