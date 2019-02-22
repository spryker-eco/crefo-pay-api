<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Shared\CrefoPayApi;

use Spryker\Shared\Kernel\AbstractBundleConfig;

class CrefoPayApiConfig extends AbstractBundleConfig
{
    public const API_FIELD_MAC = 'mac';
    public const RESULT_CODE_OK = 0;
    public const RESULT_CODE_REDIRECT = 1;

    /**
     * @return string
     */
    public function getApiFieldMac(): string
    {
        return static::API_FIELD_MAC;
    }

    /**
     * @return int
     */
    public function getResultCodeOk(): int
    {
        return static::RESULT_CODE_OK;
    }

    /**
     * @return int
     */
    public function getResultCodeRedirect(): int
    {
        return static::RESULT_CODE_REDIRECT;
    }
}
