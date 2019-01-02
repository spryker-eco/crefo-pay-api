<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Service\CrefoPayApi\HashCalculator;

interface MacHashCalculatorInterface
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function calculateMac(array $data): string;
}
