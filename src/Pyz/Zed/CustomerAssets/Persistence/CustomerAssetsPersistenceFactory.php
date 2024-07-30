<?php

/**
 * Copyright © 2016-present Pyz Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CustomerAssets\Persistence;

use Orm\Zed\CustomerAssets\Persistence\PyzCustomerAssetsQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;



/**
 * @method \Pyz\Zed\CustomerAssets\CustomerAssetsConfig getConfig()
 * @method \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsQueryContainerInterface getQueryContainer()
 * @method \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsRepositoryInterface getRepository()
 */
class CustomerAssetsPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\CustomerAssets\Persistence\PyzCustomerAssetsQuery
     */
    public function createCustomerAssetsQuery()
    {
        return PyzCustomerAssetsQuery::create();
    }

}