<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\CrefoPayApi\Business;

use Generated\Shared\Transfer\CrefoPayApiRefundResponseTransfer;
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
    /**
     * @var array
     */
    protected const RESPONSE_HEADERS = ['X-Payco-HMAC' => 'e3de34925fde2e18735fdf99863ed7d38c933ae5'];

    /**
     * @var string
     */
    protected const FIXTURE_FILE_NAME = 'refundResponseBody.json';

    /**
     * @return void
     */
    public function testPerformRefundApiCall(): void
    {
        $requestTransfer = $this->tester->createRequestTransfer();
        $responseTransfer = $this->facade->performRefundApiCall($requestTransfer);
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
        $refundResponseTransfer = $responseTransfer->getRefundResponse();
        $this->assertInstanceOf(
            CrefoPayApiRefundResponseTransfer::class,
            $refundResponseTransfer,
        );

        $this->assertEquals(0, $refundResponseTransfer->getResultCode());
        $this->assertNotEmpty($refundResponseTransfer->getSalt());
        $this->assertCount(0, $refundResponseTransfer->getErrorDetails());
    }
}
