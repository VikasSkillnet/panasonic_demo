<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CustomerAssets\Persistence;

use Generated\Shared\Transfer\FilterTransfer;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;
use Spryker\Zed\Propel\PropelFilterCriteria;

/**
 * @method \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsPersistenceFactory getFactory()
 */
class CustomerAssetsQueryContainer extends AbstractQueryContainer implements CustomerAssetsQueryContainerInterface
{

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idCustomer
     * @param \Propel\Runtime\ActiveQuery\Criteria|null $criteria
     *
     * @return \Orm\Zed\CustomerAssets\Persistence\PyzCustomerAssetsQuery
     */
    public function querySalesOrdersByCustomerId($idCustomer, ?Criteria $criteria = null)
    {
        $query = $this->getFactory()->createCustomerAssetsQuery();

        $query->filterByFkCustomer($idCustomer);

        if ($criteria !== null) {
            $query->mergeWith($criteria);
        }

        return $query;
    }


    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idCustomer
     * @param \Generated\Shared\Transfer\FilterTransfer|null $filterTransfer
     *
     * @return \Orm\Zed\CustomerAssets\Persistence\PyzCustomerAssetsQuery
     */
    public function queryCustomerAssets($idCustomer, ?FilterTransfer $filterTransfer = null)
    {
        $criteria = new Criteria();
        $criteria = (new PropelFilterCriteria((new FilterTransfer())->setOrderBy('created_at')->setOrderDirection('DESC')))
            ->toCriteria();

        return $this->querySalesOrdersByCustomerId($idCustomer, $criteria);
    }

    /**
     * 
     * @return \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\Sales\Persistence\SpySalesOrderItem>
     */
    public function queryAllSalesOrderItemEntity()
    {
        return $this->getFactory()->createSpySalesOrderItemQuery()
                ->joinWithOrder()
                ->filterByIsAlradyAddedInAssets(false)->find();
    }

}
