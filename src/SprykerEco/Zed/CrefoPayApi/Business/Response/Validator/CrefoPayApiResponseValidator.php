<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Response\Validator;

use SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceInterface;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface;

class CrefoPayApiResponseValidator implements CrefoPayApiResponseValidatorInterface
{
    protected const API_HEADER_MAC = 'X-Payco-HMAC';
    protected const API_RESPONSE_FIELD_RESULT_CODE = 'resultCode';
    protected const RESULT_CODE_OK = 0;
    protected const RESULT_CODE_REDIRECT = 1;

    /**
     * @var \SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceInterface
     */
    protected $service;

    /**
     * @param \SprykerEco\Service\CrefoPayApi\CrefoPayApiServiceInterface $service
     */
    public function __construct(CrefoPayApiServiceInterface $service)
    {
        $this->service = $service;
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
        $resultCode = $responseData[static::API_RESPONSE_FIELD_RESULT_CODE] ?? null;
        $successResultCodes = [
            static::RESULT_CODE_OK,
            static::RESULT_CODE_REDIRECT,
        ];

        return in_array($resultCode, $successResultCodes);
    }

    /**
     * @param \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface $response
     *
     * @return bool
     */
    protected function validateMac(CrefoPayApiGuzzleResponseInterface $response): bool
    {
        $mac = $response->getHeader(static::API_HEADER_MAC);
        if ($mac === null) {
            return false;
        }

        return $this->service
            ->validateMac([$response->getResponseBody()], $mac);
    }
}
