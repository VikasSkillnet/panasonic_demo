<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Client\CustomerAssets;

use Generated\Shared\Transfer\CustomerAssetsListTransfer;
use Generated\Shared\Transfer\CustomerAssetsTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Pyz\Client\CustomerAssets\CustomerAssetsFactory getFactory()
 * @method \Pyz\Client\CustomerAssets\CustomerAssetsConfig getConfig()
 */
class CustomerAssetsClient extends AbstractClient implements CustomerAssetsClientInterface
{
    /**
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerAssetsListTransfer $customerAssetsListTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsListTransfer
     */
    public function getPaginatedCustomerAssets(CustomerAssetsListTransfer $customerAssetsListTransfer): CustomerAssetsListTransfer
    {
        return $this->getFactory()->createZedSalesStub()->getPaginatedCustomerAssets($customerAssetsListTransfer);
    }

    /**
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function addCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer
    {
        return $this->getFactory()->createZedSalesStub()->addCustomerAssets($customerAssetsTransfer);
    }

    /**
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function removeCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer
    {
        return $this->getFactory()->createZedSalesStub()->removeCustomerAssets($customerAssetsTransfer);
    }
}