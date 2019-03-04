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
    public const CREATE_TRANSACTION_API_ENDPOINT = 'CREFO_PAY_API:CREATE_TRANSACTION_API_ENDPOINT';
    public const RESERVE_API_ENDPOINT = 'CREFO_PAY_API:RESERVE_API_ENDPOINT';
    public const CAPTURE_API_ENDPOINT = 'CREFO_PAY_API:CAPTURE_API_ENDPOINT';
    public const CANCEL_API_ENDPOINT = 'CREFO_PAY_API:CANCEL_ACTION_URL';
    public const REFUND_API_ENDPOINT = 'CREFO_PAY_API:REFUND_ACTION_URL';
    public const FINISH_API_ENDPOINT = 'CREFO_PAY_API:FINISH_ACTION_URL';

    public const PRIVATE_KEY = 'CREFO_PAY_API:PRIVATE_KEY';
    public const PUBLIC_KEY = 'CREFO_PAY_API:PUBLIC_KEY';

    public const AUTO_CAPTURE = 'CREFO_PAY_API:AUTO_CAPTURE';
}
