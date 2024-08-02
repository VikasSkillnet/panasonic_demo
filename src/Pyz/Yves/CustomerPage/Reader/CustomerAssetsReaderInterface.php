<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Reader;

use Generated\Shared\Transfer\CustomerAssetsListTransfer;
use Symfony\Component\HttpFoundation\Request;

interface CustomerAssetsReaderInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Generated\Shared\Transfer\CustomerAssetsListTransfer $customerAssetsListTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsListTransfer
     */
    public function getCustomerAssetsList(Request $request, CustomerAssetsListTransfer $customerAssetsListTransfer): CustomerAssetsListTransfer;
}
