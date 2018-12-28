<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Validator\Request;

use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;

class CancelRequestValidator implements CrefoPayApiRequestValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return void
     */
    public function validate(CrefoPayApiRequestTransfer $requestTransfer): void
    {
        $requestTransfer->requireCancelRequest();
    }
}
