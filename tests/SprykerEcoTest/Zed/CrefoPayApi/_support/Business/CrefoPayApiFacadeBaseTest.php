<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\CrefoPayApi\Business;

use Codeception\TestCase\Test;
use SprykerEco\Zed\CrefoPayApi\Business\CrefoPayApiBusinessFactory;
use SprykerEco\Zed\CrefoPayApi\Business\CrefoPayApiFacade;

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
                'getEntityManager',
                'getUtilEncodingService',
                'getCrefoPayApiService',
                'getCrefoPayApiHttpClient',
            ]
        );

        $stub = $builder->getMock();
        $stub->method('getConfig')
            ->willReturn($this->tester->createConfig());
        $stub->method('getEntityManager')
            ->willReturn($this->tester->createEntityManager());
        $stub->method('getUtilEncodingService')
            ->willReturn($this->tester->createUtilEncodingService());
        $stub->method('getCrefoPayApiService')
            ->willReturn($this->tester->createCrefoPayApiService());
        $stub->method('getCrefoPayApiHttpClient')
            ->willReturn($this->tester->createCrefoPayApiHttpClient());

        return $stub;
    }
}
