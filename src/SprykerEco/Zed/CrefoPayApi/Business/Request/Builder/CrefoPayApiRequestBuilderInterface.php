<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Request\Builder;

use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;

interface CrefoPayApiRequestBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    public function buildRequestPayload(CrefoPayApiRequestTransfer $requestTransfer): array;
}
