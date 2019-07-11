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
    /**
     * Specification:
     *  - Url for createTransaction API requests.
     *
     * @api
     */
    public const CREATE_TRANSACTION_API_ENDPOINT = 'CREFO_PAY_API:CREATE_TRANSACTION_API_ENDPOINT';

    /**
     * Specification:
     *  - Url for reserve API requests.
     *
     * @api
     */
    public const RESERVE_API_ENDPOINT = 'CREFO_PAY_API:RESERVE_API_ENDPOINT';

    /**
     * Specification:
     *  - Url for capture API requests.
     *
     * @api
     */
    public const CAPTURE_API_ENDPOINT = 'CREFO_PAY_API:CAPTURE_API_ENDPOINT';

    /**
     * Specification:
     *  - Url for cancel API requests.
     *
     * @api
     */
    public const CANCEL_API_ENDPOINT = 'CREFO_PAY_API:CANCEL_API_ENDPOINT';

    /**
     * Specification:
     *  - Url for refund API requests.
     *
     * @api
     */
    public const REFUND_API_ENDPOINT = 'CREFO_PAY_API:REFUND_API_ENDPOINT';

    /**
     * Specification:
     *  - Url for finish API requests.
     *
     * @api
     */
    public const FINISH_API_ENDPOINT = 'CREFO_PAY_API:FINISH_API_ENDPOINT';

    /**
     * Specification:
     *  - Private key provided by CrefoPay string value. Used for MAC calculation.
     *
     * @api
     */
    public const PRIVATE_KEY = 'CREFO_PAY_API:PRIVATE_KEY';

    /**
     * Specification:
     *  - Public key provided by CrefoPay string value. Used for sign requests.
     *
     * @api
     */
    public const PUBLIC_KEY = 'CREFO_PAY_API:PUBLIC_KEY';
}
