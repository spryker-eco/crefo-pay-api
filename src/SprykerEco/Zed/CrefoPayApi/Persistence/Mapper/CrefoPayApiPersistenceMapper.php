<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Persistence\Mapper;

use Generated\Shared\Transfer\PaymentCrefoPayApiLogTransfer;
use Orm\Zed\CrefoPayApi\Persistence\SpyPaymentCrefoPayApiLog;

class CrefoPayApiPersistenceMapper
{
    /**
     * @param \Orm\Zed\CrefoPayApi\Persistence\SpyPaymentCrefoPayApiLog $paymentCrefoPayApiLogEntity
     * @param \Generated\Shared\Transfer\PaymentCrefoPayApiLogTransfer $paymentCrefoPayApiLogTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentCrefoPayApiLogTransfer
     */
    public function mapEntityToPaymentCrefoPayApiLogTransfer(
        SpyPaymentCrefoPayApiLog $paymentCrefoPayApiLogEntity,
        PaymentCrefoPayApiLogTransfer $paymentCrefoPayApiLogTransfer
    ): PaymentCrefoPayApiLogTransfer {
        $paymentCrefoPayApiLogTransfer->fromArray(
            $paymentCrefoPayApiLogEntity->toArray(),
            true,
        );

        return $paymentCrefoPayApiLogTransfer;
    }
}
