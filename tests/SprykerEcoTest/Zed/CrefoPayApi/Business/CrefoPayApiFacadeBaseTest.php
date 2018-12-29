<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\CrefoPayApi\Business;

use Codeception\TestCase\Test;
use SprykerEco\Zed\CrefoPayApi\Business\CrefoPayApiBusinessFactory;
use SprykerEco\Zed\CrefoPayApi\Business\CrefoPayApiFacade;
use SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig;
use SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceBridge;
use SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface;

class CrefoPayApiFacadeBaseTest extends Test
{

    /**
     * @var \SprykerEcoTest\Zed\CrefoPayApi\CrefoPayApiZedTester
     */
    protected $tester;

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Business\CrefoPayApiFacadeInterface
     */
    protected $facade;
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->facade = (new CrefoPayApiFacade())
            ->setFactory($this->createFactory());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Zed\CrefoPayApi\Business\CrefoPayApiBusinessFactory
     */
    protected function createFactory(): CrefoPayApiBusinessFactory
    {
        $builder = $this->getMockBuilder(CrefoPayApiBusinessFactory::class);
        $builder->setMethods(
            [
                'getConfig',
                'getUtilEncodingService',
            ]
        );

        $stub = $builder->getMock();
        $stub->method('getConfig')
            ->willReturn($this->createConfig());
        $stub->method('getUtilEncodingService')
            ->willReturn($this->createUtilEncodingService());

        return $stub;
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig
     */
    protected function createConfig(): CrefoPayApiConfig
    {
        return new CrefoPayApiConfig();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceInterface
     */
    protected function createUtilEncodingService(): CrefoPayApiToUtilEncodingServiceInterface
    {
        return new CrefoPayApiToUtilEncodingServiceBridge($this->tester->getLocator()->utilEncoding()->service());
    }
}
