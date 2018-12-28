<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Request;

class CaptureRequest extends AbstractRequest implements CrefoPayApiRequestInterface
{
    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->config->getCaptureActionUrl();
    }

    /**
     * @return string
     */
    public function getHttpMethod(): string
    {
        return static::METHOD_POST;
    }
}
