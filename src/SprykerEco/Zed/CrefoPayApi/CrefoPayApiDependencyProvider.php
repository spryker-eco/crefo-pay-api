<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use SprykerEco\Zed\CrefoPayApi\Dependency\External\Guzzle\CrefoPayApiGuzzleHttpClientAdapter;
use SprykerEco\Zed\CrefoPayApi\Dependency\Service\CrefoPayApiToUtilEncodingServiceBridge;

/**
 * @method \SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig getConfig()
 */
class CrefoPayApiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @var string
     */
    public const SERVICE_CREFO_PAY_API = 'SERVICE_CREFO_PAY_API';

    /**
     * @var string
     */
    public const CREFO_PAY_API_HTTP_CLIENT = 'CREFO_PAY_API_HTTP_CLIENT';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addUtilEncodingService($container);
        $container = $this->addCrefoPayApiService($container);
        $container = $this->addCrefoPayApiHttpClient($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilEncodingService(Container $container): Container
    {
        $container->set(static::SERVICE_UTIL_ENCODING, function (Container $container) {
            return new CrefoPayApiToUtilEncodingServiceBridge($container->getLocator()->utilEncoding()->service());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCrefoPayApiService(Container $container): Container
    {
        $container->set(static::SERVICE_CREFO_PAY_API, function (Container $container) {
            return $container->getLocator()->crefoPayApi()->service();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCrefoPayApiHttpClient(Container $container): Container
    {
        $container->set(static::CREFO_PAY_API_HTTP_CLIENT, function () {
            return new CrefoPayApiGuzzleHttpClientAdapter();
        });

        return $container;
    }
}
