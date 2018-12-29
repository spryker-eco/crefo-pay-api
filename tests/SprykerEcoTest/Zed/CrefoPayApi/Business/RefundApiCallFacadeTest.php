<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\CrefoPayApi\Business;

use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;

/**
 * @group Functional
 * @group SprykerEco
 * @group Zed
 * @group CrefoPayApi
 * @group Business
 */
class RefundApiCallFacadeTest extends CrefoPayApiFacadeBaseTest
{
    public function testPerformRefundApiCall():void
    {
        $requestTransfer = $this->createRequestTransfer();
        $responseTransfer = $this->facade->performRefundApiCall($requestTransfer);
        $this->doTest($responseTransfer);
    }

    public function doTest(CrefoPayApiResponseTransfer $responseTransfer): void
    {
    }
}
