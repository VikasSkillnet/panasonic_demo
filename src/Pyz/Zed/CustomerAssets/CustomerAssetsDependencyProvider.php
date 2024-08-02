<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CustomerAssets;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CustomerAssetsDependencyProvider extends AbstractBundleDependencyProvider
{

    /**
     * @var string
     */
    public const FACADE_PRODUCT = 'FACADE_PRODUCT';

    /**
     * @var string
     */
    public const FACADE_SALES = 'FACADE_SALES';


    /**
     * @param \Spryker\Zed\Kernel\Container $container
     * 
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addProductFacade($container);
        $container = $this->addSalesfacade($container);

        return $container;
    }


    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductFacade($container)
    {
        $container->set(static::FACADE_PRODUCT, function ($container) {
            return $container->getLocator()->product()->facade();
        });

        return $container;
    }
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSalesfacade($container)
    {
        $container->set(static::FACADE_SALES, function ($container) {
            return $container->getLocator()->sales()->facade();
        });

        return $container;
    }

}
