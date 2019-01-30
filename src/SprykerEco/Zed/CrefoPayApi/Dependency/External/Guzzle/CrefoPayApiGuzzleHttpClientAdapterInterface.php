<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle;

use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface;

interface CrefoPayApiGuzzleHttpClientAdapterInterface
{
    /**
     * @param string $url
     * @param array $formParams
     *
     * @throws \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Exception\CrefoPayApiGuzzleRequestException
     *
     * @return \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface
     */
    public function post(string $url, array $formParams = []): CrefoPayApiGuzzleResponseInterface;
}
