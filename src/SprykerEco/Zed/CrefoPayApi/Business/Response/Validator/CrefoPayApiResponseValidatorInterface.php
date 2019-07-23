<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Response\Validator;

use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface;

interface CrefoPayApiResponseValidatorInterface
{
    /**
     * @param \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponseInterface $response
     * @param array|null $responseData
     *
     * @return bool
     */
    public function validateResponse(
        CrefoPayApiGuzzleResponseInterface $response,
        ?array $responseData
    ): bool;
}
