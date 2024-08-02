<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CustomerAssets\Business\Writter;

use Generated\Shared\Transfer\CustomerAssetsListTransfer;
use Generated\Shared\Transfer\CustomerAssetsTransfer;

interface CustomerAssetsWritterInterface
{
    /**
     * Summary of addCustomerAssets
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     * 
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function addCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer;

    /**
     * Summary of addCustomerAssets
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     * 
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function removeCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer;
    
}