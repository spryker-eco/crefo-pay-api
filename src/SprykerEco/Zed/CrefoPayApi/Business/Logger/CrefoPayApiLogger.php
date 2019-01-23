<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Logger;

use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;
use Generated\Shared\Transfer\PaymentCrefoPayApiLogTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;
use SprykerEco\Zed\CrefoPayApi\Persistence\CrefoPayApiEntityManagerInterface;

class CrefoPayApiLogger implements CrefoPayApiLoggerInterface
{
    use TransactionTrait;

    protected const GET_REQUEST_METHOD = 'get%sRequest';
    protected const GET_RESPONSE_METHOD = 'get%sResponse';

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Persistence\CrefoPayApiEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var string
     */
    protected $requestType;

    /**
     * @param \SprykerEco\Zed\CrefoPayApi\Persistence\CrefoPayApiEntityManagerInterface $entityManager
     */
    public function __construct(CrefoPayApiEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     * @param string $requestType
     *
     * @return void
     */
    public function logApiCall(
        CrefoPayApiRequestTransfer $requestTransfer,
        CrefoPayApiResponseTransfer $responseTransfer,
        string $requestType
    ): void {
        $this->requestType = $requestType;
        $paymentCrefoPayApiLog = $this->createPaymentCrefoPayApiLogTransfer(
            $requestTransfer,
            $responseTransfer
        );

        $this->getTransactionHandler()->handleTransaction(function () use ($paymentCrefoPayApiLog) {
            return $this->entityManager->savePaymentCrefoPayApiLog($paymentCrefoPayApiLog);
        });
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentCrefoPayApiLogTransfer
     */
    protected function createPaymentCrefoPayApiLogTransfer(
        CrefoPayApiRequestTransfer $requestTransfer,
        CrefoPayApiResponseTransfer $responseTransfer
    ): PaymentCrefoPayApiLogTransfer {
        return (new PaymentCrefoPayApiLogTransfer)
            ->setRequestType($this->requestType)
            ->setCrefoPayOrderId($this->getCrefoPayOrderId($requestTransfer))
            ->setIsSuccess($responseTransfer->getIsSuccess())
            ->setResultCode($this->getResultCode($responseTransfer))
            ->setMessage($this->getMessage($responseTransfer))
            ->setSalt($this->getSalt($responseTransfer))
            ->setRequest($requestTransfer->serialize())
            ->setResponse($responseTransfer->serialize());
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return string
     */
    protected function getCrefoPayOrderId(CrefoPayApiRequestTransfer $requestTransfer): string
    {
        $method = sprintf(static::GET_REQUEST_METHOD, ucfirst($this->requestType));

        return $requestTransfer->$method()->getOrderID();
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     *
     * @return int
     */
    protected function getResultCode(CrefoPayApiResponseTransfer $responseTransfer): int
    {
        if ($responseTransfer->getIsSuccess() === false) {
            return $responseTransfer->getError()->getResultCode();
        }

        $method = sprintf(static::GET_RESPONSE_METHOD, ucfirst($this->requestType));

        return $responseTransfer->$method()->getResultCode();
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     *
     * @return string|null
     */
    protected function getMessage(CrefoPayApiResponseTransfer $responseTransfer): ?string
    {
        if ($responseTransfer->getIsSuccess() === false) {
            return $responseTransfer->getError()->getMessage();
        }

        $method = sprintf(static::GET_RESPONSE_METHOD, ucfirst($this->requestType));

        return $responseTransfer->$method()->getMessage();
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     *
     * @return string
     */
    protected function getSalt(CrefoPayApiResponseTransfer $responseTransfer): string
    {
        if ($responseTransfer->getIsSuccess() === false) {
            return $responseTransfer->getError()->getSalt();
        }

        $method = sprintf(static::GET_RESPONSE_METHOD, ucfirst($this->requestType));

        return $responseTransfer->$method()->getSalt();
    }
}
