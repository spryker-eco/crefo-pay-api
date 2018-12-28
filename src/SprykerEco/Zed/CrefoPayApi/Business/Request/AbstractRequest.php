<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Request;

use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use GuzzleHttp\RequestOptions;
use SprykerEco\Zed\CrefoPayApi\Business\Builder\Request\CrefoPayApiRequestBuilderInterface;
use SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig;

abstract class AbstractRequest implements CrefoPayApiRequestInterface
{
    protected const METHOD_POST = 'POST';
    protected const METHOD_GET = 'GET';
    protected const DEFAULT_TIMEOUT = 45;
    protected const HEADER_CONTENT_TYPE_KEY = 'Content-Type';
    protected const HEADER_CONTENT_TYPE_VALUE = 'application/x-www-form-urlencoded';

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Business\Builder\Request\CrefoPayApiRequestBuilderInterface
     */
    protected $requestBuilder;

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig
     */
    protected $config;

    /**
     * @param \SprykerEco\Zed\CrefoPayApi\Business\Builder\Request\CrefoPayApiRequestBuilderInterface $requestBuilder
     * @param \SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig $config
     */
    public function __construct(
        CrefoPayApiRequestBuilderInterface $requestBuilder,
        CrefoPayApiConfig $config
    ) {
        $this->requestBuilder = $requestBuilder;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    public function getRequestOptions(CrefoPayApiRequestTransfer $requestTransfer): array
    {
        return [
            RequestOptions::TIMEOUT => static::DEFAULT_TIMEOUT,
            RequestOptions::HEADERS => $this->getHeaders(),
            RequestOptions::FORM_PARAMS => $this->getFormParams($requestTransfer),
        ];
    }

    /**
     * @return string[]
     */
    protected function getHeaders(): array
    {
        return [
            static::HEADER_CONTENT_TYPE_KEY => static::HEADER_CONTENT_TYPE_VALUE,
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    protected function getFormParams(CrefoPayApiRequestTransfer $requestTransfer): array
    {
        return $this->requestBuilder->buildRequestPayload($requestTransfer);
    }
}
