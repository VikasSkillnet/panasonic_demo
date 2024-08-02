<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CustomerAssets\Business\Writter;
use Generated\Shared\Transfer\CustomerAssetsTransfer;
use Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsEntityManagerInterface;


class CustomerAssetsWritter implements CustomerAssetsWritterInterface
{

    /**
     * @var \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsEntityManagerInterface
     */
    protected CustomerAssetsEntityManagerInterface $entityManager;


    /**
     * 
     * @param \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsEntityManagerInterface $queryContainer
     */
    public function __construct(
        CustomerAssetsEntityManagerInterface $entityManager,
    ) {
        $this->entityManager = $entityManager;
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


}