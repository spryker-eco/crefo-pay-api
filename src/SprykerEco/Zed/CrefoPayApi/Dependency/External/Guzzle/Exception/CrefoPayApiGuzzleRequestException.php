<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Exception;

use Exception;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface;
use Throwable;

class CrefoPayApiGuzzleRequestException extends Exception
{
    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface
     */
    protected $response;

    /**
     * @param \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface $response
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(
        CrefoPayApiGuzzleResponseInterface $response,
        $message = "",
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->response = $response;
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface
     */
    public function getResponse(): CrefoPayApiGuzzleResponseInterface
    {
        return $this->response;
    }
}
