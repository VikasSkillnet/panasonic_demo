<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CustomerPage;

use Pyz\Client\CustomerAssets\CustomerAssetsClientInterface;
use Pyz\Yves\CustomerPage\Form\FormFactory;
use Pyz\Yves\CustomerPage\Reader\CustomerAssetsReaderInterface;
use Spryker\Client\ProductStorage\ProductStorageClientInterface;
use Spryker\Client\Session\SessionClientInterface;
use SprykerShop\Yves\CustomerPage\CustomerPageFactory as SprykerCustomerPageFactory;
use Pyz\Yves\CustomerPage\Reader\CustomerAssetsReader;

class CustomerPageFactory extends SprykerCustomerPageFactory
{
    /**
     * @return \Spryker\Client\Session\SessionClientInterface
     */
    public function getSessionClient(): SessionClientInterface
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::CLIENT_SESSION);
    }

    /**
     * @return \Pyz\Client\CustomerAssets\CustomerAssetsClientInterface
     */
    public function getCustomerAssetsClient(): CustomerAssetsClientInterface
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::CLIENT_CUSTOMER_ASSETS);
    }

    /**
     * @return \Spryker\Client\ProductStorage\ProductStorageClientInterface
     */
    public function getProductStorageClient(): ProductStorageClientInterface
    {
        return $this->getProvidedDependency(CustomerPageDependencyProvider::CLIENT_PRODUCT_STORAGE);
    }

      /**
     * @return \Pyz\Yves\CustomerPage\Reader\CustomerAssetsReaderInterface
     */
    public function createCustomerAssetsreader(): CustomerAssetsReaderInterface
    {
        return new CustomerAssetsReader(
            $this->getCustomerAssetsClient(),
            $this->getConfig(),
        );
    }

       /**
     * @return \Pyz\Yves\CustomerPage\Form\FormFactory
     */
    public function createCustomerFormFactory()
    {
        return new FormFactory();
    }
}
