<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Service\CrefoPayApi;

use Spryker\Service\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\CrefoPayApi\CrefoPayApiConstants;

class CrefoPayApiConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getPrivateKey(): string
    {
        return $this->get(CrefoPayApiConstants::PRIVATE_KEY);
    }
}
