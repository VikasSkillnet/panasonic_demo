<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CustomerAssets\Business\Model\Reader;

use Generated\Shared\Transfer\CustomerAssetsListTransfer;
use Orm\Zed\CustomerAssets\Persistence\Base\PyzCustomerAssetsQuery;
use Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsQueryContainerInterface;



class PaginatedCustomerOrderReader implements CustomerAssetsInterface
{

    /**
     * @var \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsQueryContainerInterface
     */
    protected CustomerAssetsQueryContainerInterface $queryContainer;

    /**
     * 
     * @param \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsQueryContainerInterface $queryContainer
     */
    public function __construct(
        CustomerAssetsQueryContainerInterface $queryContainer
    ) {
        $this->queryContainer = $queryContainer;
    }



    /**
     * @param \Generated\Shared\Transfer\CustomerAssetsListTransfer $customerAssetsListTransfer
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsListTransfer
     */
    public function getCustomerAssetsPaginated(CustomerAssetsListTransfer $customerAssetsListTransfer, $idCustomer): CustomerAssetsListTransfer
    {
        $customerAssetsQuery = $this->queryContainer->queryCustomerAssets($idCustomer);

        $customerAssetsList = $this->getOrderCollection($customerAssetsListTransfer, $customerAssetsQuery);

        return $customerAssetsListTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerAssetsListTransfer $customerAssetsListTransfer
     * @param \Orm\Zed\CustomerAssets\Persistence\PyzCustomerAssetsQuery $customerAssetsQuery
     *
     * @return \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\CustomerAssets\Persistence\PyzCustomerAssets>
     */
    protected function getOrderCollection(CustomerAssetsListTransfer $customerAssetsListTransfer, PyzCustomerAssetsQuery $customerAssetsQuery)
    {
        if ($customerAssetsListTransfer->getPagination() !== null) {
            return $this->paginateCustomerAssetsCollection($customerAssetsListTransfer, $customerAssetsQuery);
        }

        return $customerAssetsQuery->find();
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerAssetsListTransfer $customerAssetsListTransfer
     * @param \Orm\Zed\CustomerAssets\Persistence\PyzCustomerAssetsQuery $customerAssetsQuery
     *
     * @return \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\CustomerAssets\Persistence\PyzCustomerAssets>
     */
    protected function paginateCustomerAssetsCollection(CustomerAssetsListTransfer $customerAssetsListTransfer, PyzCustomerAssetsQuery $customerAssetsQuery)
    {
        $paginationTransfer = $customerAssetsListTransfer->getPagination();

        $page = $paginationTransfer->requirePage()->getPage();
        $maxPerPage = $paginationTransfer->requireMaxPerPage()->getMaxPerPage();

        $paginationModel = $customerAssetsQuery->paginate($page, $maxPerPage);

        $paginationTransfer->setNbResults($paginationModel->getNbResults());
        $paginationTransfer->setFirstIndex($paginationModel->getFirstIndex());
        $paginationTransfer->setLastIndex($paginationModel->getLastIndex());
        $paginationTransfer->setFirstPage($paginationModel->getFirstPage());
        $paginationTransfer->setLastPage($paginationModel->getLastPage());
        $paginationTransfer->setNextPage($paginationModel->getNextPage());
        $paginationTransfer->setPreviousPage($paginationModel->getPreviousPage());

        $customerAssetsListTransfer->setPagination($paginationTransfer);

        /** @var \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\CustomerAssets\Persistence\PyzCustomerAssets> $collection */
        $collection = $paginationModel->getResults();

        return $collection;
    }
}