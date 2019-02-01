<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Request\Builder;

use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;

class CaptureRequestBuilder extends AbstractRequestBuilder
{
    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    protected function convertRequestTransferToArray(CrefoPayApiRequestTransfer $requestTransfer): array
    {
        return $requestTransfer->getCaptureRequest()->toArray(true, true);
    }
}
