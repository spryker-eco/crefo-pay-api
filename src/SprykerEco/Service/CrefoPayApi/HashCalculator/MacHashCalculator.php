<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Service\CrefoPayApi\HashCalculator;

use SprykerEco\Service\CrefoPayApi\CrefoPayApiConfig;

class MacHashCalculator implements MacHashCalculatorInterface
{
    /**
     * @var string
     */
    protected const HASHING_ALGORITHM = 'sha1';

    /**
     * @var array
     */
    protected const CHARS_TO_REPLACE = [' ', "\t", "\s", "\r", "\n"];

    /**
     * @var \SprykerEco\Service\CrefoPayApi\CrefoPayApiConfig
     */
    protected $config;

    /**
     * @param \SprykerEco\Service\CrefoPayApi\CrefoPayApiConfig $config
     */
    public function __construct(CrefoPayApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param array $data
     *
     * @return string
     */
    public function calculateMac(array $data): string
    {
        $macString = $this->createMacString($data);

        return $this->hashValue($macString);
    }

    /**
     * @param array $responseData
     * @param string $mac
     *
     * @return bool
     */
    public function validateMac(array $responseData, string $mac): bool
    {
        return $this->calculateMac($responseData) === $mac;
    }

    /**
     * @param array $data
     *
     * @return string
     */
    protected function createMacString(array $data): string
    {
        ksort($data);

        return $this->removeDelimiters(implode('', $data));
    }

    /**
     * @param string $value
     *
     * @return string
     */
    protected function hashValue(string $value): string
    {
        return hash_hmac(static::HASHING_ALGORITHM, $value, $this->getPrivateKey());
    }

    /**
     * @param string $macString
     *
     * @return string
     */
    protected function removeDelimiters(string $macString): string
    {
        return str_replace(static::CHARS_TO_REPLACE, '', $macString);
    }

    /**
     * @return string
     */
    protected function getPrivateKey(): string
    {
        return $this->config->getPrivateKey();
    }
}
