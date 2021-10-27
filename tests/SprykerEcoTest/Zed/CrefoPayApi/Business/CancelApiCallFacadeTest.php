<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\CrefoPayApi\Business;

use Generated\Shared\Transfer\CrefoPayApiCancelResponseTransfer;
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
    /**
     * @var array
     */
    protected const RESPONSE_HEADERS = ['X-Payco-HMAC' => 'dcce0cc98e82b0ba0587256b7205a2cc1fb7990a'];

    /**
     * @var string
     */
    protected const FIXTURE_FILE_NAME = 'cancelResponseBody.json';

    /**
     * @return void
     */
    public function testPerformCancelApiCall(): void
    {
        $requestTransfer = $this->tester->createRequestTransfer();
        $responseTransfer = $this->facade->performCancelApiCall($requestTransfer);
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
        $cancelResponseTransfer = $responseTransfer->getCancelResponse();
        $this->assertInstanceOf(
            CrefoPayApiCancelResponseTransfer::class,
            $cancelResponseTransfer
        );

        $this->assertEquals(0, $cancelResponseTransfer->getResultCode());
        $this->assertNotEmpty($cancelResponseTransfer->getSalt());
        $this->assertCount(0, $cancelResponseTransfer->getErrorDetails());
    }
}
