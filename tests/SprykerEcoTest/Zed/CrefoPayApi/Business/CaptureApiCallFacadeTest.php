<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\CrefoPayApi\Business;

use Generated\Shared\Transfer\CrefoPayApiCaptureResponseTransfer;
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
     * @var array<string, string>
     */
    protected const RESPONSE_HEADERS = ['X-Payco-HMAC' => '615389a9a284bb6974826bea38c351e0a296dad5'];

    /**
     * @var string
     */
    protected const FIXTURE_FILE_NAME = 'captureResponseBody.json';

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
        $this->assertTrue($responseTransfer->getIsSuccess());
        $this->assertNotEmpty($responseTransfer->getCrefoPayApiLogId());
        $captureResponseTransfer = $responseTransfer->getCaptureResponse();
        $this->assertInstanceOf(
            CrefoPayApiCaptureResponseTransfer::class,
            $captureResponseTransfer,
        );

        $this->assertEquals(0, $captureResponseTransfer->getResultCode());
        $this->assertNotEmpty($captureResponseTransfer->getSalt());
        $this->assertCount(0, $captureResponseTransfer->getErrorDetails());
        $this->assertEquals('PAID', $captureResponseTransfer->getStatus());
    }
}
