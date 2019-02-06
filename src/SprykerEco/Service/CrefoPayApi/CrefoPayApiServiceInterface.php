<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Service\CrefoPayApi;

interface CrefoPayApiServiceInterface
{
    /**
     * Specification:
     *  - Generates an HMAC-SHA1 key based on input data using the private key.
     *
     * @api
     *
     * @param array $data
     *
     * @return string
     */
    public function calculateMac(array $data): string;

    /**
     * Specification:
     *  - Validates HMAC-SHA1 key.
     *
     * @api
     *
     * @param array $data
     * @param string $mac
     *
     * @return bool
     */
    public function validateMac(array $data, string $mac): bool;
}
