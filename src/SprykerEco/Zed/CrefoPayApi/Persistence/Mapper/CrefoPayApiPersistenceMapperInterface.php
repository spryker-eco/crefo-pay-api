<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Persistence\Mapper;

use Generated\Shared\Transfer\PaymentCrefoPayApiLogTransfer;
use Generated\Shared\Transfer\SpyPaymentCrefoPayApiLogEntityTransfer;

interface CrefoPayApiPersistenceMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentCrefoPayApiLogTransfer $paymentCrefoPayApiLogTransfer
     * @param \Generated\Shared\Transfer\SpyPaymentCrefoPayApiLogEntityTransfer $paymentCrefoPayApiLogEntityTransfer
     *
     * @return \Generated\Shared\Transfer\SpyPaymentCrefoPayApiLogEntityTransfer
     */
    public function mapPaymentCrefoPayApiLogTransferToEntityTransfer(
        PaymentCrefoPayApiLogTransfer $paymentCrefoPayApiLogTransfer,
        SpyPaymentCrefoPayApiLogEntityTransfer $paymentCrefoPayApiLogEntityTransfer
    ): SpyPaymentCrefoPayApiLogEntityTransfer;

    /**
     * @param \Generated\Shared\Transfer\SpyPaymentCrefoPayApiLogEntityTransfer $paymentCrefoPayApiLogEntityTransfer
     * @param \Generated\Shared\Transfer\PaymentCrefoPayApiLogTransfer $paymentCrefoPayApiLogTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentCrefoPayApiLogTransfer
     */
    public function mapEntityTransferToPaymentCrefoPayApiLogTransfer(
        SpyPaymentCrefoPayApiLogEntityTransfer $paymentCrefoPayApiLogEntityTransfer,
        PaymentCrefoPayApiLogTransfer $paymentCrefoPayApiLogTransfer
    ): PaymentCrefoPayApiLogTransfer;
}
