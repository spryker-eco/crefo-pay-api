<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business;

use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerEco\Zed\CrefoPayApi\Business\CrefoPayApiBusinessFactory getFactory()
 * @method \SprykerEco\Zed\CrefoPayApi\Persistence\CrefoPayApiEntityManagerInterface getEntityManager()
 */
class CrefoPayApiFacade extends AbstractFacade implements CrefoPayApiFacadeInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function performCreateTransactionApiCall(CrefoPayApiRequestTransfer $requestTransfer): CrefoPayApiResponseTransfer
    {
        return $this->getFactory()
            ->createCreateTransactionClient()
            ->performRequest($requestTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function performReserveApiCall(CrefoPayApiRequestTransfer $requestTransfer): CrefoPayApiResponseTransfer
    {
        return $this->getFactory()
            ->createReserveClient()
            ->performRequest($requestTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function performCaptureApiCall(CrefoPayApiRequestTransfer $requestTransfer): CrefoPayApiResponseTransfer
    {
        return $this->getFactory()
            ->createCaptureClient()
            ->performRequest($requestTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function performCancelApiCall(CrefoPayApiRequestTransfer $requestTransfer): CrefoPayApiResponseTransfer
    {
        return $this->getFactory()
            ->createCancelClient()
            ->performRequest($requestTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function performRefundApiCall(CrefoPayApiRequestTransfer $requestTransfer): CrefoPayApiResponseTransfer
    {
        return $this->getFactory()
            ->createRefundClient()
            ->performRequest($requestTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function performFinishApiCall(CrefoPayApiRequestTransfer $requestTransfer): CrefoPayApiResponseTransfer
    {
        return $this->getFactory()
            ->createFinishClient()
            ->performRequest($requestTransfer);
    }
}
