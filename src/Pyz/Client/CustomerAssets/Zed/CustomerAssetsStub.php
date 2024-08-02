<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Client\CustomerAssets\Zed;

use Generated\Shared\Transfer\CustomerAssetsListTransfer;
use Generated\Shared\Transfer\CustomerAssetsTransfer;
use Spryker\Client\ZedRequest\ZedRequestClient;

class CustomerAssetsStub implements CustomerAssetsStubInterface
{
    /**
     * @var \Spryker\Client\ZedRequest\ZedRequestClient
     */
    protected $zedStub;

    /**
     * @param \Spryker\Client\ZedRequest\ZedRequestClient $zedStub
     */
    public function __construct(ZedRequestClient $zedStub)
    {
        $this->zedStub = $zedStub;
    }


    /**
     * @param \Generated\Shared\Transfer\CustomerAssetsListTransfer $customerAssetsListTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsListTransfer
     */
    public function getPaginatedCustomerAssets(CustomerAssetsListTransfer $customerAssetsListTransfer): CustomerAssetsListTransfer
    {
        /** @var \Generated\Shared\Transfer\CustomerAssetsListTransfer $customerAssetsListTransfer */
        $customerAssetsListTransfer = $this->zedStub->call('/customer-assets/gateway/get-customer-assets', $customerAssetsListTransfer);

        return $customerAssetsListTransfer;
    }


    /**
     *
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function addCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer
    {
        /** @var \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer */
        $customerAssetsTransfer = $this->zedStub->call('/customer-assets/gateway/add-customer-assets', $customerAssetsTransfer);

        return $customerAssetsTransfer;
    }

    /**
     *` 
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function removeCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer
    {
        /** @var \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer */
        $customerAssetsTransfer = $this->zedStub->call('/customer-assets/gateway/remove-customer-assets', $customerAssetsTransfer);

        return $customerAssetsTransfer;

    }
}