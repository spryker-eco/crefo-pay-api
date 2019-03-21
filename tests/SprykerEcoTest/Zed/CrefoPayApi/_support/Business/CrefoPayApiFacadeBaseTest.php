<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\CrefoPayApi\Business;

use Codeception\TestCase\Test;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use SprykerEco\Zed\CrefoPayApi\Business\CrefoPayApiBusinessFactory;
use SprykerEco\Zed\CrefoPayApi\Business\CrefoPayApiFacade;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\CrefoPayApiGuzzleHttpClientAdapter;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\CrefoPayApiGuzzleHttpClientAdapterInterface;

class CrefoPayApiFacadeBaseTest extends Test
{
    protected const SUCCESS_RESPONSE_STATUS = 200;
    protected const FIXTURES_FOLDER_NAME = 'Fixtures';
    protected const RESPONSE_HEADERS = [];
    protected const FIXTURE_FILE_NAME = '';

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
            ->willReturn($this->createCrefoPayApiGuzzleHttpClientAdapterMock());

        return $stub;
    }

    /**
     * @throws \Exception
     *
     * @return \SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\CrefoPayApiGuzzleHttpClientAdapterInterface|object
     */
    protected function createCrefoPayApiGuzzleHttpClientAdapterMock(): CrefoPayApiGuzzleHttpClientAdapterInterface
    {
        return $this->make(
            CrefoPayApiGuzzleHttpClientAdapter::class,
            ['guzzleHttpClient' => $this->createGuzzleHttpClientMock()]
        );
    }

    /**
     * @throws \Exception
     *
     * @return \GuzzleHttp\ClientInterface|object
     */
    protected function createGuzzleHttpClientMock(): ClientInterface
    {
        return $this->makeEmpty(
            Client::class,
            ['__call' => $this->createResponseMock()]
        );
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function createResponseMock(): ResponseInterface
    {
        return new Response(
            static::SUCCESS_RESPONSE_STATUS,
            $this->getResponseHeaders(),
            $this->getResponseBody()
        );
    }

    /**
     * @return string[]
     */
    protected function getResponseHeaders(): array
    {
        return static::RESPONSE_HEADERS;
    }

    /**
     * @return string
     */
    protected function getResponseBody(): string
    {
        $fileName = $this->getFixtureDirectory() . DIRECTORY_SEPARATOR . static::FIXTURE_FILE_NAME;
        if (file_exists($fileName) && is_readable($fileName)) {
            return file_get_contents($fileName);
        }

        return '';
    }

    /**
     * @return string
     */
    protected function getFixtureDirectory()
    {
        return __DIR__ . DIRECTORY_SEPARATOR . static::FIXTURES_FOLDER_NAME;
    }
}
