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
use SprykerEco\Zed\CrefoPayApi\Business\Exception\InvalidRequestTypeException;
use SprykerEco\Zed\CrefoPayApi\Persistence\CrefoPayApiEntityManagerInterface;

class CrefoPayApiLogger implements CrefoPayApiLoggerInterface
{
    use TransactionTrait;

    /**
     * @var string
     */
    protected const GET_REQUEST_METHOD = 'get%sRequest';

    /**
     * @var string
     */
    protected const GET_RESPONSE_METHOD = 'get%sResponse';

    /**
     * @var string
     */
    protected const INVALID_REQUEST_TYPE_ERROR_MESSAGE = 'Request type "%s" is not supported';

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Persistence\CrefoPayApiEntityManagerInterface
     */
    protected $entityManager;

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
     * @return \Generated\Shared\Transfer\PaymentCrefoPayApiLogTransfer
     */
    public function logApiCall(
        CrefoPayApiRequestTransfer $requestTransfer,
        CrefoPayApiResponseTransfer $responseTransfer,
        string $requestType
    ): PaymentCrefoPayApiLogTransfer {
        $paymentCrefoPayApiLog = $this->createPaymentCrefoPayApiLogTransfer(
            $requestTransfer,
            $responseTransfer,
            $requestType,
        );

        return $this->getTransactionHandler()->handleTransaction(function () use ($paymentCrefoPayApiLog) {
            return $this->entityManager->savePaymentCrefoPayApiLog($paymentCrefoPayApiLog);
        });
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     * @param string $requestType
     *
     * @return \Generated\Shared\Transfer\PaymentCrefoPayApiLogTransfer
     */
    protected function createPaymentCrefoPayApiLogTransfer(
        CrefoPayApiRequestTransfer $requestTransfer,
        CrefoPayApiResponseTransfer $responseTransfer,
        string $requestType
    ): PaymentCrefoPayApiLogTransfer {
        return (new PaymentCrefoPayApiLogTransfer())
            ->setRequestType($requestType)
            ->setCrefoPayOrderId($this->getCrefoPayOrderId($requestTransfer, $requestType))
            ->setIsSuccess($responseTransfer->getIsSuccess())
            ->setResultCode($this->getResultCode($responseTransfer, $requestType))
            ->setMessage($this->getMessage($responseTransfer, $requestType))
            ->setSalt($this->getSalt($responseTransfer, $requestType))
            ->setRequest($requestTransfer->serialize())
            ->setResponse($responseTransfer->serialize());
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     * @param string $requestType
     *
     * @throws \SprykerEco\Zed\CrefoPayApi\Business\Exception\InvalidRequestTypeException
     *
     * @return string
     */
    protected function getCrefoPayOrderId(CrefoPayApiRequestTransfer $requestTransfer, string $requestType): string
    {
        $method = sprintf(static::GET_REQUEST_METHOD, ucfirst($requestType));

        if (!method_exists($requestTransfer, $method)) {
            throw new InvalidRequestTypeException(
                sprintf(static::INVALID_REQUEST_TYPE_ERROR_MESSAGE, $requestType),
            );
        }

        return $requestTransfer->$method()->getOrderID();
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     * @param string $requestType
     *
     * @throws \SprykerEco\Zed\CrefoPayApi\Business\Exception\InvalidRequestTypeException
     *
     * @return int|null
     */
    protected function getResultCode(CrefoPayApiResponseTransfer $responseTransfer, string $requestType): ?int
    {
        if ($responseTransfer->getIsSuccess() === false && $responseTransfer->getError() !== null) {
            return $responseTransfer->getError()->getResultCode();
        }

        $method = sprintf(static::GET_RESPONSE_METHOD, ucfirst($requestType));

        if (!method_exists($responseTransfer, $method)) {
            throw new InvalidRequestTypeException();
        }

        return $responseTransfer->$method()->getResultCode();
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     * @param string $requestType
     *
     * @throws \SprykerEco\Zed\CrefoPayApi\Business\Exception\InvalidRequestTypeException
     *
     * @return string|null
     */
    protected function getMessage(CrefoPayApiResponseTransfer $responseTransfer, string $requestType): ?string
    {
        if ($responseTransfer->getIsSuccess() === false && $responseTransfer->getError() !== null) {
            return $responseTransfer->getError()->getMessage();
        }

        $method = sprintf(static::GET_RESPONSE_METHOD, ucfirst($requestType));

        if (!method_exists($responseTransfer, $method)) {
            throw new InvalidRequestTypeException();
        }

        return $responseTransfer->$method()->getMessage();
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     * @param string $requestType
     *
     * @throws \SprykerEco\Zed\CrefoPayApi\Business\Exception\InvalidRequestTypeException
     *
     * @return string|null
     */
    protected function getSalt(CrefoPayApiResponseTransfer $responseTransfer, string $requestType): ?string
    {
        if ($responseTransfer->getIsSuccess() === false && $responseTransfer->getError() !== null) {
            return $responseTransfer->getError()->getSalt();
        }

        $method = sprintf(static::GET_RESPONSE_METHOD, ucfirst($requestType));

        if (!method_exists($responseTransfer, $method)) {
            throw new InvalidRequestTypeException();
        }

        return $responseTransfer->$method()->getSalt();
    }
}
