<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Builder\Request;

use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;

class ReserveRequestBuilder extends AbstractRequestBuilder
{
    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    protected function convertRequestTransferToArray(CrefoPayApiRequestTransfer $requestTransfer): array
    {
        return $requestTransfer->getReserveRequest()->toArray(true, true);
    }
}
