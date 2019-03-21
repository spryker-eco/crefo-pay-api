<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\CrefoPayApi\Business;

use Generated\Shared\Transfer\CrefoPayApiReserveResponseTransfer;
use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;

/**
 * @group Functional
 * @group SprykerEco
 * @group Zed
 * @group CrefoPayApi
 * @group Business
 */
class ReserveApiCallFacadeTest extends CrefoPayApiFacadeBaseTest
{
    protected const RESPONSE_HEADERS = ['X-Payco-HMAC' => '8d1561c83ad00a8bc695b8e69baebb06b5e1c68e'];
    protected const FIXTURE_FILE_NAME = 'reserveResponseBody.json';

    /**
     * @return void
     */
    public function testPerformReserveApiCall(): void
    {
        $requestTransfer = $this->tester->createRequestTransfer();
        $responseTransfer = $this->facade->performReserveApiCall($requestTransfer);
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
        $this->assertIsInt($responseTransfer->getCrefoPayApiLogId());
        $reserveResponseTransfer = $responseTransfer->getReserveResponse();
        $this->assertInstanceOf(
            CrefoPayApiReserveResponseTransfer::class,
            $reserveResponseTransfer
        );

        $this->assertEquals(0, $reserveResponseTransfer->getResultCode());
        $this->assertNotEmpty($reserveResponseTransfer->getSalt());
        $this->assertCount(0, $reserveResponseTransfer->getErrorDetails());
    }
}
