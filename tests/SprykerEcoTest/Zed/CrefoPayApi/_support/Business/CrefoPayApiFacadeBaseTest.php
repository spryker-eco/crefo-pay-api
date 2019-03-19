<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\CrefoPayApi\Business;

use Codeception\TestCase\Test;
use SprykerEco\Zed\CrefoPayApi\Business\CrefoPayApiBusinessFactory;
use SprykerEco\Zed\CrefoPayApi\Business\CrefoPayApiFacade;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\CrefoPayApiGuzzleHttpClientAdapter;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\CrefoPayApiGuzzleHttpClientAdapterInterface;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\Response\CrefoPayApiGuzzleResponse;

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
            ->setFactory($this->createFactoryMock());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Zed\CrefoPayApi\Business\CrefoPayApiBusinessFactory
     */
    protected function createFactoryMock(): CrefoPayApiBusinessFactory
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

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\CrefoPayApiGuzzleHttpClientAdapterInterface
     */
    protected function createCrefoPayApiGuzzleHttpClientAdapterMock(): CrefoPayApiGuzzleHttpClientAdapterInterface
    {
        $response = new CrefoPayApiGuzzleResponse(
            $response->getBody(),
            $response->getHeaders()
        );

        $builder = $this->getMockBuilder(CrefoPayApiGuzzleHttpClientAdapter::class);
        $builder->setMethods(['post']);
        $stub = $builder->getMock();
        $stub->method('post')
            ->willReturn($this->tester->createConfig());

        return $stub;
    }
}
