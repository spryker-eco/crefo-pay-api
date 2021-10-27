<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\CrefoPayApi\Business;

use Generated\Shared\Transfer\CrefoPayApiFinishResponseTransfer;
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
    /**
     * @var array
     */
    protected const RESPONSE_HEADERS = ['X-Payco-HMAC' => 'abc7158aa79611969a151bba81c289f1c3b81fef'];

    /**
     * @var string
     */
    protected const FIXTURE_FILE_NAME = 'finishResponseBody.json';

    /**
     * @return void
     */
    public function testPerformFinishApiCall(): void
    {
        $requestTransfer = $this->tester->createRequestTransfer();
        $responseTransfer = $this->facade->performFinishApiCall($requestTransfer);
        $this->doTest($responseTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiResponseTransfer $responseTransfer
     *
     * @return void
     */
    public function doTest(CrefoPayApiResponseTransfer $responseTransfer): void
    {
        $this->assertTrue($responseTransfer->getIsSuccess());
        $this->assertNotEmpty($responseTransfer->getCrefoPayApiLogId());
        $finishResponseTransfer = $responseTransfer->getFinishResponse();
        $this->assertInstanceOf(
            CrefoPayApiFinishResponseTransfer::class,
            $finishResponseTransfer
        );

        $this->assertEquals(0, $finishResponseTransfer->getResultCode());
        $this->assertNotEmpty($finishResponseTransfer->getSalt());
        $this->assertCount(0, $finishResponseTransfer->getErrorDetails());
    }
}
