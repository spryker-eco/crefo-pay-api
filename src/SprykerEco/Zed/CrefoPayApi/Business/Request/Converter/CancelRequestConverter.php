<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Request\Converter;

use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use SprykerEco\Zed\CrefoPayApi\Business\Request\CrefoPayApiRequestFields;

class CancelRequestConverter implements CrefoPayApiRequestConverterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    public function convertRequestTransferToArray(CrefoPayApiRequestTransfer $requestTransfer): array
    {
        $cancelRequest = $requestTransfer->getCancelRequest();
        if ($cancelRequest === null) {
            return [];
        }

        return [
            CrefoPayApiRequestFields::API_FIELD_MERCHANT_ID => $cancelRequest->getMerchantID(),
            CrefoPayApiRequestFields::API_FIELD_STORE_ID => $cancelRequest->getStoreID(),
            CrefoPayApiRequestFields::API_FIELD_ORDER_ID => $cancelRequest->getOrderID(),
        ];
    }
}
