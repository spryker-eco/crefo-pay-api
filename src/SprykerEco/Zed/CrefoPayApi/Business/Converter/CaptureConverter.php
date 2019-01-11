<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Converter;

use Generated\Shared\Transfer\CrefoPayApiCaptureResponseTransfer;
use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;

class CaptureConverter extends AbstractConverter
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
        $responseTransfer->setCaptureResponse(
            (new CrefoPayApiCaptureResponseTransfer())->fromArray($responseData, true)
        );

        return $responseTransfer;
    }
}
