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
    public const API_RESPONSE_FIELD_RESULT_CODE = 'resultCode';
    public const API_ERROR_TYPE_EXTERNAL = 'EXTERNAL';
    public const API_ERROR_TYPE_INTERNAL = 'INTERNAL';
}
