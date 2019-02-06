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
     * @var array
     */
    protected $headers;

    /**
     * @param \Psr\Http\Message\StreamInterface $responseBody
     * @param array $headers
     */
    public function __construct(StreamInterface $responseBody, array $headers = [])
    {
        $this->responseBody = $responseBody;
        $this->headers = $headers;
    }

    /**
     * @return string
     */
    public function getResponseBody(): string
    {
        return (string)$this->responseBody;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param string $header
     *
     * @return string|null
     */
    public function getHeader(string $header): ?string
    {
        if (!isset($this->headers[$header])) {
            return null;
        }

        return (string)reset($this->headers[$header]);
    }
}
