<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business;

use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;

interface CrefoPayApiFacadeInterface
{
    /**
     * Specification:
     *  - This call starts a transaction in the CrefoPay system.
     *  - The workflow depends on the integrationType.
     *  - Further, this call can act both as registerUser and updateUser call if an unknown/known userID is provided.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function performCreateTransactionApiCall(CrefoPayApiRequestTransfer $requestTransfer): CrefoPayApiResponseTransfer;

    /**
     * Specification:
     *  - This call reserves amount in the CrefoPay system.
     *  - <CreateTransaction> call has to be called successfully before calling the reserve call.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function performReserveApiCall(CrefoPayApiRequestTransfer $requestTransfer): CrefoPayApiResponseTransfer;

    /**
     * Specification:
     *  - The capture call allows the merchant to create orders or part-orders for already started transactions.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function performCaptureApiCall(CrefoPayApiRequestTransfer $requestTransfer): CrefoPayApiResponseTransfer;

    /**
     * Specification:
     *  - The cancel call allows the merchant to cancel an transaction where no capture has been processed yet.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function performCancelApiCall(CrefoPayApiRequestTransfer $requestTransfer): CrefoPayApiResponseTransfer;

    /**
     * Specification:
     *  - The refund call allows the merchant to return money to the user.
     *  - At least one capture on a transaction is required to perform a refund.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function performRefundApiCall(CrefoPayApiRequestTransfer $requestTransfer): CrefoPayApiResponseTransfer;

    /**
     * Specification:
     *  - The finish call allows the merchant to finish an transaction where at least one capture has been created.
     *  - All overpaid amounts are paid back to the user, but also all open captures are voided.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function performFinishApiCall(CrefoPayApiRequestTransfer $requestTransfer): CrefoPayApiResponseTransfer;
}
