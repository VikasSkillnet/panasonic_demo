<?php

namespace Pyz\Zed\CustomerAssets\Business;

use Pyz\Zed\CustomerAssets\Business\Model\Reader\CustomerAssetsInterface;
use Pyz\Zed\CustomerAssets\Business\Model\Reader\PaginatedCustomerAssetsReader;
use Pyz\Zed\CustomerAssets\Business\Writter\CustomerAssetsWritter;
use Pyz\Zed\CustomerAssets\Business\Writter\CustomerAssetsWritterInterface;
use Pyz\Zed\CustomerAssets\CustomerAssetsDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\CustomerAssets\CustomerAssetsConfig getConfig()
 * @method \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsRepositoryInterface getRepository()
 * @method \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsQueryContainerInterface getQueryContainer()
 * @method \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsEntityManagerInterface getEntityManager()
 */
class CustomerAssetsBusinessFactory extends AbstractBusinessFactory
{

    /**
     * 
     * @return \Pyz\Zed\CustomerAssets\Business\Model\Reader\PaginatedCustomerAssetsReader

     */
    public function createCustomerAssetsReader(): CustomerAssetsInterface
    {
        return new PaginatedCustomerAssetsReader(
            $this->getQueryContainer(),
            $this->getSalesfacade(),
            $this->getProductFacade(),
        );
    }

    /**
     * 
     * @return \Pyz\Zed\CustomerAssets\Business\Writter\CustomerAssetsWritterInterface
     */
    public function createCustomerAssetsWritter(): CustomerAssetsWritterInterface
    {
        return new CustomerAssetsWritter(
            $this->getEntityManager()
        );
    }

    /**
     * 
     * @return \Spryker\Zed\Product\Business\ProductFacadeInterface
     */
    public function getProductFacade()
    {
        return $this->getProvidedDependency(CustomerAssetsDependencyProvider::FACADE_PRODUCT);
    }

    /**
     * 
     * @return \Spryker\Zed\Sales\Business\SalesFacadeInterface
     */
    public function getSalesfacade()
    {
        return $this->getProvidedDependency(CustomerAssetsDependencyProvider::FACADE_SALES);
    }

}