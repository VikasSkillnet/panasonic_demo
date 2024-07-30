<?php

namespace Pyz\Zed\CustomerAssets\Business;
use Pyz\Zed\CustomerAssets\Business\Model\Reader\CustomerAssetsInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Pyz\Zed\CustomerAssets\Business\Model\Reader\PaginatedCustomerOrderReader;

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
     * @return \Pyz\Zed\CustomerAssets\Business\Model\Reader\CustomerAssetsInterface
     */
    public function createCustomerAssetsReader(): CustomerAssetsInterface
    {
        return new PaginatedCustomerOrderReader(
            $this->getQueryContainer()
        );
    }

}