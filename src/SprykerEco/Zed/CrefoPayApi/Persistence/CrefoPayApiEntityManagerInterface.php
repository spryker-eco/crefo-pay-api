<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Persistence;

use Generated\Shared\Transfer\PaymentCrefoPayApiLogTransfer;

interface CrefoPayApiEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentCrefoPayApiLogTransfer $paymentCrefoPayApiLogTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentCrefoPayApiLogTransfer
     */
    public function savePaymentCrefoPayApiLog(
        PaymentCrefoPayApiLogTransfer $paymentCrefoPayApiLogTransfer
    ): PaymentCrefoPayApiLogTransfer;
}
