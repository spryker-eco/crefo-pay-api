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
class CancelApiCallFacadeTest extends CrefoPayApiFacadeBaseTest
{
    public function testPerformCancelApiCall():void
    {
        $requestTransfer = $this->createRequestTransfer();
        $responseTransfer = $this->facade->performCancelApiCall($requestTransfer);
        $this->doTest($responseTransfer);
    }

    public function doTest(CrefoPayApiResponseTransfer $responseTransfer): void
    {
    }
}
