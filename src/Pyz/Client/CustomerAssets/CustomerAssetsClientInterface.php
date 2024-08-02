<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Client\CustomerAssets;

use Generated\Shared\Transfer\CustomerAssetsListTransfer;
use Generated\Shared\Transfer\CustomerAssetsTransfer;

interface CustomerAssetsClientInterface
{
    /**
     * Specification:
     * - Makes Zed request.
     * - Returns the customer assets for the given customer and filters.
     * - CustomerAssetsTransfer::$filters can contain offset-based pagination and ordering parameters.
     * - CustomerAssetsTransfer::$pagination can be used to apply page-based pagination strategy to the queried orders.
     * - Hydrates the resulting orders with related data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerAssetsListTransfer $customerAssetsListTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsListTransfer
     */
    public function getPaginatedCustomerAssets(CustomerAssetsListTransfer $customerAssetsListTransfer): CustomerAssetsListTransfer;

    /**
     * Specification:
     * - Makes Zed request.
     * - Create Customer assets
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function addCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer;

    /**
     * Specification:
     * - Makes Zed request.
     * - Remove Customer assets
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function removeCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer;
}