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
class CaptureApiCallFacadeTest extends CrefoPayApiFacadeBaseTest
{
    /**
     * @return void
     */
    public function testPerformCaptureApiCall(): void
    {
        $requestTransfer = $this->tester->createRequestTransfer();
        $responseTransfer = $this->facade->performCaptureApiCall($requestTransfer);
        $this->doTest($responseTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     *
     * @return void
     */
    public function doTest(CrefoPayApiResponseTransfer $responseTransfer): void
    {
    }
}
