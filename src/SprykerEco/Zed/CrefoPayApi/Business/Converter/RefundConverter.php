<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Converter;

use Generated\Shared\Transfer\CrefoPayApiRefundResponseTransfer;
use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;

class RefundConverter extends AbstractConverter
{
    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     * @param array $responseData
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    protected function updateResponseTransferWithApiCallResponse(
        CrefoPayApiResponseTransfer $responseTransfer,
        array $responseData
    ): CrefoPayApiResponseTransfer {
        $responseTransfer->setRefundResponse(
            (new CrefoPayApiRefundResponseTransfer())->fromArray($responseData, true)
        );

        return $responseTransfer;
    }
}
