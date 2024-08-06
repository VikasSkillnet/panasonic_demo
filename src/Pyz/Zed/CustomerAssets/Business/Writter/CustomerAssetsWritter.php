<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CustomerAssets\Business\Writter;

use Generated\Shared\Transfer\CustomerAssetsTransfer;
use Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsEntityManagerInterface;
use Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsQueryContainerInterface;


class CustomerAssetsWritter implements CustomerAssetsWritterInterface
{

    /**
     * @var \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsEntityManagerInterface
     */
    protected CustomerAssetsEntityManagerInterface $entityManager;

    /**
     * @var \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsQueryContainerInterface
     */
    protected CustomerAssetsQueryContainerInterface $queryContainer;

    /**
     * 
     * @param \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsEntityManagerInterface $queryContainer
     */
    public function __construct(
        CustomerAssetsEntityManagerInterface $entityManager,
        CustomerAssetsQueryContainerInterface $queryContainer,
    ) {
        $this->entityManager = $entityManager;
        $this->queryContainer = $queryContainer;
    }

    /**
     * Summary of addCustomerAssets
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     * 
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function addCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer
    {
        return $this->entityManager->createCustomerAssets($customerAssetsTransfer);
    }

    /**
     * Summary of addCustomerAssets
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     * 
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function removeCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer
    {
        return $this->entityManager->removeCustomerAssets($customerAssetsTransfer);
    }

    /**
     * Summary of addCustomerAssets
     * 
     * @return bool
     */
    public function syncOrderItemToAssets(): bool
    {

        $salesOrderItemEntityCollection = $this->getAllSalesOrderItemEntity();

        foreach ($salesOrderItemEntityCollection as $key => $spySalesOrderItemEntity) {
            $customerAssetsTransfer = new CustomerAssetsTransfer();
            $idCustomerArr = explode('-', $spySalesOrderItemEntity->getOrder()->getCustomerReference());
            $customerAssetsTransfer->setFkCustomer($idCustomerArr[2])
                                    ->setFkSalesOrderItem($spySalesOrderItemEntity->getIdSalesOrderItem())
                                    ->setAppointmentDate($spySalesOrderItemEntity->getAppointmentDate())
                                    ->setFkSku($spySalesOrderItemEntity->getSku());
            
            $customerAssetsTransfer = $this->addCustomerAssets($customerAssetsTransfer);
            if ($customerAssetsTransfer->getIdCustomerAssets()) {
                $isSuccess = $this->entityManager->markItemToAlreadyInAssets($spySalesOrderItemEntity->getIdSalesOrderItem());
                if (!$isSuccess) {
                    return false;
                }
            }   
            else
            {
                return false;
            }
        }

        return true;
    }

    /**
     * 
     * @return \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\Sales\Persistence\SpySalesOrderItem>
     */
    public function getAllSalesOrderItemEntity()
    {
        return $this->queryContainer->queryAllSalesOrderItemEntity();
    }
}