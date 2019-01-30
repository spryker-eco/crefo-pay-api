<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Converter;

use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface;

interface CrefoPayApiConverterInterface
{
    /**
     * @param \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface $response
     * @param bool $isSuccess
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function convertToResponseTransfer(
        CrefoPayApiGuzzleResponseInterface $response,
        bool $isSuccess = true
    ): CrefoPayApiResponseTransfer;
}
