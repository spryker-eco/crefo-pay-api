<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\CrefoPayApi;

use Codeception\Actor;
use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig;
use SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceBridge;
use SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class CrefoPayApiZedTester extends Actor
{
    use _generated\CrefoPayApiZedTesterActions;

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiRequestTransfer
     */
    public function createRequestTransfer(): CrefoPayApiRequestTransfer
    {
        return (new CrefoPayApiRequestTransfer());
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig
     */
    public function createConfig(): CrefoPayApiConfig
    {
        return new CrefoPayApiConfig();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface
     */
    public function createUtilEncodingService(): CrefoPayApiToUtilEncodingServiceInterface
    {
        return new CrefoPayApiToUtilEncodingServiceBridge($this->getLocator()->utilEncoding()->service());
    }
}
