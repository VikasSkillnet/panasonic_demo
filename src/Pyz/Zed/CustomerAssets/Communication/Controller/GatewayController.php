<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CustomerAssets\Communication\Controller;

use Generated\Shared\Transfer\CustomerAssetsListTransfer;
use Generated\Shared\Transfer\CustomerAssetsTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \Pyz\Zed\CustomerAssets\Business\CustomerAssetsFacadeInterface getFacade()
 * @method \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsQueryContainerInterface getQueryContainer()
 * @method \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsRepositoryInterface getRepository()
 * @method \Pyz\Zed\CustomerAssets\Communication\CustomerAssetsCommunicationFactory getFactory()
 */
class GatewayController extends AbstractGatewayController
{
     /**
     * @param \Generated\Shared\Transfer\CustomerAssetsListTransfer $customerAssetsListTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsListTransfer
     */
    public function getCustomerAssetsAction(CustomerAssetsListTransfer $customerAssetsListTransfer): CustomerAssetsListTransfer
    {
        return $this->getFacade()->getCustomerAssets($customerAssetsListTransfer, $customerAssetsListTransfer->getIdCustomer());
    }

     /**
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function addCustomerAssetsAction(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer
    {
        return $this->getFacade()->addCustomerAssets($customerAssetsTransfer);
    }

     /**
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function removeCustomerAssetsAction(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer
    {
        return $this->getFacade()->removeCustomerAssets($customerAssetsTransfer);
    }
}