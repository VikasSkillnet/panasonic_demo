<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CustomerAssets\Persistence;

use Generated\Shared\Transfer\CustomerAssetsTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;



/**
 * @method \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsPersistenceFactory getFactory()
 */
class CustomerAssetsEntityManager extends AbstractEntityManager implements CustomerAssetsEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function createCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer
    {
        $customerAssetsEntity = $this->getFactory()->createCustomerAssetsEntity();
        $customerAssetsEntity->fromArray($customerAssetsTransfer->toArray());
        $customerAssetsEntity->save();

        return $customerAssetsTransfer->fromArray($customerAssetsEntity->toArray(), true);
    }


    /**
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function removeCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer
    {
        $customerAssetsQuery = $this->getFactory()->createCustomerAssetsQuery();
        $customerAssetsEntity = $customerAssetsQuery->findOneByIdCustomerAssets($customerAssetsTransfer->getIdCustomerAssets());
        try {
            $customerAssetsEntity->delete();
        } catch (\Throwable $th) {
            return (new CustomerAssetsTransfer())->setIsDeleted(false);
        }

        return (new CustomerAssetsTransfer())->setIsDeleted(true);
    }
}
