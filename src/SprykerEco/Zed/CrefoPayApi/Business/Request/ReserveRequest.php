<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Request;

use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use SprykerEco\Zed\CrefoPayApi\Business\Builder\Request\CrefoPayApiRequestBuilderInterface;
use SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig;

class ReserveRequest implements CrefoPayApiRequestInterface
{
    protected const REQUEST_TYPE = 'reserve';

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
    public function getFormParams(CrefoPayApiRequestTransfer $requestTransfer): array
    {
        return $this->requestBuilder->buildRequestPayload($requestTransfer);
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->config->getReserveActionUrl();
    }

    /**
     * @return string
     */
    public function getRequestType(): string
    {
        return static::REQUEST_TYPE;
    }
}
