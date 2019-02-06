<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Exception\CrefoPayApiGuzzleRequestException;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponse;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface;

class CrefoPayApiGuzzleHttpClientAdapter implements CrefoPayApiGuzzleHttpClientAdapterInterface
{
    protected const DEFAULT_TIMEOUT = 45;
    protected const HEADER_CONTENT_TYPE_KEY = 'Content-Type';
    protected const HEADER_CONTENT_TYPE_VALUE = 'application/x-www-form-urlencoded';

    /**
     * @var \GuzzleHttp\Client
     */
    protected $guzzleHttpClient;

    public function __construct()
    {
        $this->guzzleHttpClient = new Client([
            RequestOptions::TIMEOUT => static::DEFAULT_TIMEOUT,
            RequestOptions::HEADERS => [
                static::HEADER_CONTENT_TYPE_KEY => static::HEADER_CONTENT_TYPE_VALUE,
            ],
        ]);
    }

    /**
     * @param string $url
     * @param array $formParams
     *
     * @throws \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Exception\CrefoPayApiGuzzleRequestException
     *
     * @return \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface
     */
    public function post(string $url, array $formParams = []): CrefoPayApiGuzzleResponseInterface
    {
        try {
            $options = [
                RequestOptions::FORM_PARAMS => $formParams,
            ];
            $response = $this->guzzleHttpClient->post($url, $options);
        } catch (RequestException $requestException) {
            $response = new CrefoPayApiGuzzleResponse(
                $requestException->getResponse()->getBody(),
                $requestException->getResponse()->getHeaders()
            );
            throw new CrefoPayApiGuzzleRequestException(
                $response,
                $requestException->getMessage(),
                $requestException->getCode(),
                $requestException
            );
        }

        return new CrefoPayApiGuzzleResponse(
            $response->getBody(),
            $response->getHeaders()
        );
    }
}
