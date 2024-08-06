<?php

namespace Pyz\Zed\CustomerAssets\Business;

use Generated\Shared\Transfer\CustomerAssetsListTransfer;
use Generated\Shared\Transfer\CustomerAssetsTransfer;

interface CustomerAssetsFacadeInterface
{
    /**
     * Specification:
     *  - Returns a list of of assets for the given customer id and (optional) filters.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerAssetsListTransfer $customerAssetsListTransfer
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsListTransfer
     */
    public function getCustomerAssets(CustomerAssetsListTransfer $customerAssetsListTransfer, $idCustomer): CustomerAssetsListTransfer;

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function addCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer;

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function removeCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer;

    /**
     * Summary of addCustomerAssets
     * 
     * @return bool
     */
    public function syncOrderItemToAssets(): bool;

}