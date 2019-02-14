<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Persistence;

use Generated\Shared\Transfer\PaymentCrefoPayApiLogTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;
use SprykerEco\Zed\CrefoPayApi\Persistence\Mapper\CrefoPayApiPersistenceMapperInterface;

/**
 * @method \SprykerEco\Zed\CrefoPayApi\Persistence\CrefoPayApiPersistenceFactory getFactory()
 */
class CrefoPayApiEntityManager extends AbstractEntityManager implements CrefoPayApiEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentCrefoPayApiLogTransfer $paymentCrefoPayApiLogTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentCrefoPayApiLogTransfer
     */
    public function savePaymentCrefoPayApiLog(
        PaymentCrefoPayApiLogTransfer $paymentCrefoPayApiLogTransfer
    ): PaymentCrefoPayApiLogTransfer {
        $paymentCrefoPayApiLogEntity = $this->getFactory()
            ->createPaymentCrefoPayApiLogQuery()
            ->filterByRequestType($paymentCrefoPayApiLogTransfer->getRequestType())
            ->filterByCrefoPayOrderId($paymentCrefoPayApiLogTransfer->getCrefoPayOrderId())
            ->filterBySalt($paymentCrefoPayApiLogTransfer->getSalt())
            ->findOneOrCreate();

        $paymentCrefoPayApiLogEntity->fromArray(
            $paymentCrefoPayApiLogTransfer->modifiedToArray()
        );
        $paymentCrefoPayApiLogEntity->save();

        return $this->getMapper()
            ->mapEntityToPaymentCrefoPayApiLogTransfer(
                $paymentCrefoPayApiLogEntity,
                $paymentCrefoPayApiLogTransfer
            );
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Persistence\Mapper\CrefoPayApiPersistenceMapperInterface
     */
    protected function getMapper(): CrefoPayApiPersistenceMapperInterface
    {
        return $this->getFactory()->createCrefoPayApiPersistenceMapper();
    }
}
