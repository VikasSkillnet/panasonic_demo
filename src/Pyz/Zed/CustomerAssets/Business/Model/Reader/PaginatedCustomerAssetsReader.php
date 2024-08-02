<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CustomerAssets\Business\Model\Reader;

use ArrayObject;
use Generated\Shared\Transfer\CustomerAssetsListTransfer;
use Generated\Shared\Transfer\CustomerAssetsTransfer;
use Generated\Shared\Transfer\OrderItemFilterTransfer;
use Generated\Shared\Transfer\OrderItemTransfer;
use Orm\Zed\CustomerAssets\Persistence\Base\PyzCustomerAssetsQuery;
use Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsQueryContainerInterface;
use Spryker\Zed\Product\Business\ProductFacade;
use Spryker\Zed\Sales\Business\SalesFacade;

class PaginatedCustomerAssetsReader implements CustomerAssetsInterface
{

    /**
     * @var \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsQueryContainerInterface
     */
    protected CustomerAssetsQueryContainerInterface $queryContainer;

    /**
     * @var \Spryker\Zed\Sales\Business\SalesFacadeInterface
     */
    protected SalesFacade $salesFacade;

    /**
     * @var \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    protected ProductFacade $productFacde;

    /**
     * 
     * @param \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsQueryContainerInterface $queryContainer
     */
    public function __construct(
        CustomerAssetsQueryContainerInterface $queryContainer,
        SalesFacade $salesFacade,
        ProductFacade $productFacde,
    ) {
        $this->queryContainer = $queryContainer;
        $this->salesFacade = $salesFacade;
        $this->productFacde = $productFacde;
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

        $customerAssets = new ArrayObject();
        foreach ($customerAssetsList as $key => $customerAssetEntity) {
            $customerAssetsTransfer = new CustomerAssetsTransfer();
            $customerAssetsTransfer->fromArray($customerAssetEntity->toArray());
            $productConcrete = $this->productFacde->getProductConcrete($customerAssetsTransfer->getFkSku());
            if ($customerAssetsTransfer->getFkSalesOrderItem()) {
                $orderItemCollection = $this->salesFacade->getOrderItems((new OrderItemFilterTransfer())->setSalesOrderItemIds([$customerAssetsTransfer->getFkSalesOrderItem()]));
                $customerAssetsTransfer->setOrderItem($orderItemCollection->getItems()[0]);
            }

            $customerAssetsTransfer->setProduct($productConcrete);
            $imageSet = $productConcrete->getImageSets();
            if (!empty($imageSet)) {
                $images = $imageSet[0]->getProductImages();
                if (!empty($images)) {
                    $imageUrl = $images[0]->getExternalUrlSmall();
                }
            }
            $customerAssetsTransfer->setImageUrl($imageUrl);

            $customerAssets->append($customerAssetsTransfer);
        }

        $customerAssetsListTransfer->setCustomerAssets($customerAssets);

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