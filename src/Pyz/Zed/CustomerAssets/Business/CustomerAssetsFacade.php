<?php

namespace Pyz\Zed\CustomerAssets\Business;

use Generated\Shared\Transfer\CustomerAssetsListTransfer;
use Generated\Shared\Transfer\CustomerAssetsTransfer;
use Pyz\Zed\CustomerAssets\Business\CustomerAssetsFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractFacade;


/**
 * @method \Pyz\Zed\CustomerAssets\Business\CustomerAssetsBusinessFactory getFactory()
 * @method \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsRepositoryInterface getRepository()
 */
class CustomerAssetsFacade extends AbstractFacade implements CustomerAssetsFacadeInterface
{

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerAssetsListTransfer $customerAssetsListTransfer
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsListTransfer
     */
    public function getCustomerAssets(CustomerAssetsListTransfer $customerAssetsListTransfer, $idCustomer): CustomerAssetsListTransfer
    {
        return $this->getFactory()->createCustomerAssetsReader()->getCustomerAssetsPaginated($customerAssetsListTransfer, $idCustomer);
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function addCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer
    {
        return $this->getFactory()->createCustomerAssetsWritter()->addCustomerAssets($customerAssetsTransfer);
    }

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsTransfer
     */
    public function removeCustomerAssets(CustomerAssetsTransfer $customerAssetsTransfer): CustomerAssetsTransfer
    {
        return $this->getFactory()->createCustomerAssetsWritter()->removeCustomerAssets($customerAssetsTransfer);
    }

    /**
     * Summary of addCustomerAssets
     * 
     * @return bool
     */
    public function syncOrderItemToAssets(): bool
    {
        return $this->getFactory()->createCustomerAssetsWritter()->syncOrderItemToAssets();
    }
}