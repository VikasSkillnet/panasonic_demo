<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CustomerAssets\Business\Model\Reader;

use Generated\Shared\Transfer\CustomerAssetsListTransfer;

interface CustomerAssetsInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerAssetsListTransfer $customerAssetsListTransfer
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsListTransfer
     */
    public function getCustomerAssetsPaginated(CustomerAssetsListTransfer $customerAssetsListTransfer, $idCustomer): CustomerAssetsListTransfer;
}