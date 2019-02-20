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

    /**
     * @return string
     */
    public function getApiFieldMac(): string
    {
        return static::API_FIELD_MAC;
    }
}
