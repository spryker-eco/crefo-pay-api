<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Service\CrefoPayApi;

use Spryker\Service\Kernel\AbstractServiceFactory;
use SprykerEco\Service\CrefoPayApi\HashCalculator\MacHashCalculator;
use SprykerEco\Service\CrefoPayApi\HashCalculator\MacHashCalculatorInterface;

/**
 * @method \SprykerEco\Service\CrefoPayApi\CrefoPayApiConfig getConfig()
 */
class CrefoPayApiServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \SprykerEco\Service\CrefoPayApi\HashCalculator\MacHashCalculatorInterface
     */
    public function createMacHashCalculator(): MacHashCalculatorInterface
    {
        return new MacHashCalculator($this->getConfig());
    }
}
