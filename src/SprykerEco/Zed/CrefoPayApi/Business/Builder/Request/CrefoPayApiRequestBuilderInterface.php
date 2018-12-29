<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Builder\Request;

use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;

interface CrefoPayApiRequestBuilderInterface
{
    public function buildRequestPayload(CrefoPayApiRequestTransfer $requestTransfer): array;
}