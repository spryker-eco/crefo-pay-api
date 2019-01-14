<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Request;

class ReserveRequest extends AbstractRequest implements CrefoPayApiRequestInterface
{
    protected const REQUEST_TYPE = 'reserve';

    /**
     * @return string
     */
    public function getRequestType(): string
    {
        return static::REQUEST_TYPE;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->config->getReserveActionUrl();
    }
}
