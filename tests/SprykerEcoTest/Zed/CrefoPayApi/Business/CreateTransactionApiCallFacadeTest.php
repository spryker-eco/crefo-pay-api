<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\CrefoPayApi\Business;

use Generated\Shared\Transfer\CrefoPayApiCreateTransactionResponseTransfer;
use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;

/**
 * @group Functional
 * @group SprykerEco
 * @group Zed
 * @group CrefoPayApi
 * @group Business
 */
class CreateTransactionApiCallFacadeTest extends CrefoPayApiFacadeBaseTest
{
    protected const RESPONSE_HEADERS = ['X-Payco-HMAC' => '7553980d2800a462f78e706ac0542e8806c5f93f'];
    protected const FIXTURE_FILE_NAME = 'createTransactionResponseBody.json';

    /**
     * @return void
     */
    public function testPerformCreateTransactionApiCall(): void
    {
        $requestTransfer = $this->tester->createRequestTransfer();
        $responseTransfer = $this->facade->performCreateTransactionApiCall($requestTransfer);
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
        $createTransactionResponseTransfer = $responseTransfer->getCreateTransactionResponse();
        $this->assertInstanceOf(
            CrefoPayApiCreateTransactionResponseTransfer::class,
            $createTransactionResponseTransfer
        );

        $this->assertEquals(0, $createTransactionResponseTransfer->getResultCode());
        $this->assertNotEmpty($createTransactionResponseTransfer->getSalt());
        $this->assertGreaterThan(0, count($createTransactionResponseTransfer->getAllowedPaymentMethods()));
        $this->assertCount(0, $createTransactionResponseTransfer->getErrorDetails());
    }
}
