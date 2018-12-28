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
        // TODO: Implement performCreateTransactionApiCall() method.
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
        // TODO: Implement performReserveApiCall() method.
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
        // TODO: Implement performCaptureApiCall() method.
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
        // TODO: Implement performCancelApiCall() method.
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
        // TODO: Implement performRefundApiCall() method.
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
        // TODO: Implement performFinishApiCall() method.
    }
}
