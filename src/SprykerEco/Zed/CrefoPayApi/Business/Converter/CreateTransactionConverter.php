<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Converter;

use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;

class CreateTransactionConverter extends AbstractConverter
{
    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     * @param array $responseData
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    protected function createResponseTransferWithApiCallResponse(
        CrefoPayApiResponseTransfer $responseTransfer,
        array $responseData
    ): CrefoPayApiResponseTransfer {
        return $responseTransfer;
    }
}
