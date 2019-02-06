<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Shared\CrefoPayApi;

/**
 * Declares global environment configuration keys. Do not use it for other class constants.
 */
interface CrefoPayApiConstants
{
    public const CREATE_TRANSACTION_ACTION_URL = 'CREFO_PAY_API:CREATE_TRANSACTION_ACTION_URL';
    public const RESERVE_ACTION_URL = 'CREFO_PAY_API:RESERVE_ACTION_URL';
    public const CAPTURE_ACTION_URL = 'CREFO_PAY_API:CAPTURE_ACTION_URL';
    public const CANCEL_ACTION_URL = 'CREFO_PAY_API:CANCEL_ACTION_URL';
    public const REFUND_ACTION_URL = 'CREFO_PAY_API:REFUND_ACTION_URL';
    public const FINISH_ACTION_URL = 'CREFO_PAY_API:FINISH_ACTION_URL';

    public const PRIVATE_KEY = 'CREFO_PAY_API:PRIVATE_KEY';
    public const PUBLIC_KEY = 'CREFO_PAY_API:PUBLIC_KEY';

    public const AUTO_CAPTURE = 'CREFO_PAY_API:AUTO_CAPTURE';
}
