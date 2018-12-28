<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Converter;

use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;
use Psr\Http\Message\ResponseInterface;

class RefundConverter implements CrefoPayApiConverterInterface
{
    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface
     */
    protected $encodingService;

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Generated\Shared\Transfer\CrefoPayApiResponseTransfer
     */
    public function convertToResponseTransfer(ResponseInterface $response): CrefoPayApiResponseTransfer
    {
        $responseBody = $this->encodingService->decodeJson($response->getBody(), true);
        $responseTransfer = new CrefoPayApiResponseTransfer();

        return $responseTransfer;
    }
}
