<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Response\Validator;

use SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceInterface;
use SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface;

class CrefoPayApiResponseValidator implements CrefoPayApiResponseValidatorInterface
{
    /**
     * @var \SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceInterface
     */
    protected $service;

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig
     */
    protected $config;

    /**
     * @param \SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceInterface $service
     * @param \SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig $config
     */
    public function __construct(
        CrefoPayApiServiceInterface $service,
        CrefoPayApiConfig $config
    ) {
        $this->service = $service;
        $this->config = $config;
    }

    /**
     * @param \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface $response
     * @param array|null $responseData
     *
     * @return bool
     */
    public function validateResponse(
        CrefoPayApiGuzzleResponseInterface $response,
        ?array $responseData
    ): bool {
        return $responseData !== null
            && $this->isResultCodeSuccess($responseData)
            && $this->validateMac($response);
    }

    /**
     * @param array $responseData
     *
     * @return bool
     */
    protected function isResultCodeSuccess(array $responseData): bool
    {
        $resultCode = $responseData[$this->config->getApiResponseFieldResultCode()] ?? null;

        return isset($resultCode) && ($resultCode === 0 || $resultCode === 1);
    }

    /**
     * @param \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface $response
     *
     * @return bool
     */
    protected function validateMac(CrefoPayApiGuzzleResponseInterface $response): bool
    {
        $mac = $response->getHeader($this->config->getApiHeaderMac());
        if ($mac === null) {
            return false;
        }

        return $this->service
            ->validateMac([$response->getResponseBody()], $mac);
    }
}
