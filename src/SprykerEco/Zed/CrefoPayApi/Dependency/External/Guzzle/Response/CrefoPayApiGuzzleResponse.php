<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response;

use Psr\Http\Message\StreamInterface;

class CrefoPayApiGuzzleResponse implements CrefoPayApiGuzzleResponseInterface
{
    /**
     * @var \Psr\Http\Message\StreamInterface
     */
    protected $responseBody;

    /**
     * @param \Psr\Http\Message\StreamInterface $responseBody
     */
    public function __construct(StreamInterface $responseBody)
    {
        $this->responseBody = $responseBody;
    }

    /**
     * @return string
     */
    public function getResponseBody(): string
    {
        return (string)$this->responseBody;
    }
}
