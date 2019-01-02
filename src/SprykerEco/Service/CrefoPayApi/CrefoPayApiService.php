<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Service\CrefoPayApi;

use Spryker\Service\Kernel\AbstractService;

/**
 * @method \SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceFactory getFactory()
 */
class CrefoPayApiService extends AbstractService implements CrefoPayApiServiceInterface
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function calculateMac(array $data): string
    {
        return $this->getFactory()
            ->createMacHashCalculator()
            ->calculateMac($data);
    }
}
