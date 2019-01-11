<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Validator\Response;

use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;

class CreateTransactionResponseValidator implements CrefoPayApiResponseValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     *
     * @return void
     */
    public function validate(CrefoPayApiResponseTransfer $responseTransfer): void
    {
        $responseTransfer->requireCreateTransactionResponse()
            ->getCreateTransactionResponse()
                ->requireResultCode()
                ->requireSalt();
    }
}
