<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Request;

use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;

interface CrefoPayApiRequestInterface
{
    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    public function getRequestOptions(CrefoPayApiRequestTransfer $requestTransfer): array;

    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     * @return string
     */
    public function getHttpMethod(): string;
}
