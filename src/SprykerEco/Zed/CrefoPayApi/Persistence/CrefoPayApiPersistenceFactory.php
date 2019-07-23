<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Persistence;

use Orm\Zed\CrefoPayApi\Persistence\SpyPaymentCrefoPayApiLogQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;
use SprykerEco\Zed\CrefoPayApi\Persistence\Mapper\CrefoPayApiPersistenceMapper;

/**
 * @method \SprykerEco\Zed\CrefoPayApi\CrefoPayApiConfig getConfig()
 * @method \SprykerEco\Zed\CrefoPayApi\Persistence\CrefoPayApiEntityManagerInterface getEntityManager()
 *
 * @SuppressWarnings(PHPMD.FactoryMethodReturnInterfaceRule)
 */
class CrefoPayApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CrefoPayApi\Persistence\SpyPaymentCrefoPayApiLogQuery
     */
    public function createPaymentCrefoPayApiLogQuery(): SpyPaymentCrefoPayApiLogQuery
    {
        return SpyPaymentCrefoPayApiLogQuery::create();
    }

    /**
     * @return \SprykerEco\Zed\CrefoPayApi\Persistence\Mapper\CrefoPayApiPersistenceMapper
     */
    public function createCrefoPayApiPersistenceMapper()
    {
        return new CrefoPayApiPersistenceMapper();
    }
}
