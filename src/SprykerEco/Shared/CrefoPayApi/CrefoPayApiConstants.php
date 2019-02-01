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
    public const CREATE_TRANSACTION_ACTION_URL = 'CREFOPAYAPI:CREATE_TRANSACTION_ACTION_URL';
    public const RESERVE_ACTION_URL = 'CREFOPAYAPI:RESERVE_ACTION_URL';
    public const CAPTURE_ACTION_URL = 'CREFOPAYAPI:CAPTURE_ACTION_URL';
    public const CANCEL_ACTION_URL = 'CREFOPAYAPI:CANCEL_ACTION_URL';
    public const REFUND_ACTION_URL = 'CREFOPAYAPI:REFUND_ACTION_URL';
    public const FINISH_ACTION_URL = 'CREFOPAYAPI:FINISH_ACTION_URL';

    public const PRIVATE_KEY = 'CREFOPAYAPI:PRIVATE_KEY';
    public const PUBLIC_KEY = 'CREFOPAYAPI:PUBLIC_KEY';

    public const AUTO_CAPTURE = 'CREFOPAYAPI:AUTO_CAPTURE';
}
