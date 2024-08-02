<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Client\CustomerAssets\Zed;

use Generated\Shared\Transfer\CustomerAssetsListTransfer;
use Generated\Shared\Transfer\CustomerAssetsTransfer;

interface CustomerAssetsStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerAssetsListTransfer $customerAssetsListTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsListTransfer
     */
    public function getPaginatedCustomerAssets(CustomerAssetsListTransfer $customerAssetsListTransfer): CustomerAssetsListTransfer;

    /**
     *
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function addCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer;

    /**
     *
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function removeCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer;

}