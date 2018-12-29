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
class FinishApiCallFacadeTest extends CrefoPayApiFacadeBaseTest
{
    public function testPerformFinishApiCall():void
    {
        $requestTransfer = $this->createRequestTransfer();
        $responseTransfer = $this->facade->performFinishApiCall($requestTransfer);
        $this->doTest($responseTransfer);
    }

    public function doTest(CrefoPayApiResponseTransfer $responseTransfer): void
    {
    }
}
