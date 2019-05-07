<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Response\Mapper;

use Generated\Shared\Transfer\CrefoPayApiRefundResponseTransfer;
use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;

class RefundResponseMapper implements CrefoPayApiResponseMapperInterface
{
    /**
     * @param array $responseData
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function mapResponseDataToResponseTransfer(
        array $responseData,
        CrefoPayApiResponseTransfer $responseTransfer
    ): CrefoPayApiResponseTransfer {
        $responseTransfer->setRefundResponse(
            (new CrefoPayApiRefundResponseTransfer())->fromArray($responseData, true)
        );

        return $responseTransfer;
    }
}
