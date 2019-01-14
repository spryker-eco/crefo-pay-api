<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Logger;

use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;

interface CrefoPayApiLoggerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     * @param string $requestType
     *
     * @return void
     */
    public function logApiCall(
        CrefoPayApiRequestTransfer $requestTransfer,
        CrefoPayApiResponseTransfer $responseTransfer,
        string $requestType
    ): void;
}
