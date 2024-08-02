<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Plugin\Router;

use Spryker\Yves\Router\Route\RouteCollection;
use SprykerShop\Yves\CustomerPage\Plugin\Router\CustomerPageRouteProviderPlugin as SprykerCustomerPageRouteProviderPlugin;

class CustomerPageRouteProviderPlugin extends SprykerCustomerPageRouteProviderPlugin
{
  

    /**
     * @var string
     */
    public const ROUTE_NAME_CUSTOMER_MY_ASSETS = 'customer/myassets';

    /**
     * @var string
     */
    public const ROUTE_NAME_CUSTOMER_ASSETS_REMOVE = 'customer/remove/assets';

    /**
     * Specification:
     * - Adds Routes to the RouteCollection.
     *
     * @api
     *
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection
    {
        $routeCollection = parent::addRoutes($routeCollection);

        $routeCollection = $this->addCustomerAssetsRoute($routeCollection);
        $routeCollection = $this->addCustomerAssetsRemoveRoute($routeCollection);

        return $routeCollection;
    }

    
    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addCustomerAssetsRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/customer/myassets', 'CustomerPage', 'CustomerAssets', 'indexAction');
        $routeCollection->add(static::ROUTE_NAME_CUSTOMER_MY_ASSETS, $route);

        return $routeCollection;
    }
    
    /**
     * @param \Spryker\Yves\Router\Route\RouteCollection $routeCollection
     *
     * @return \Spryker\Yves\Router\Route\RouteCollection
     */
    protected function addCustomerAssetsRemoveRoute(RouteCollection $routeCollection): RouteCollection
    {
        $route = $this->buildRoute('/customer/remove/assets', 'CustomerPage', 'CustomerAssets', 'removeAssetsAction');
        $routeCollection->add(static::ROUTE_NAME_CUSTOMER_ASSETS_REMOVE, $route);

        return $routeCollection;
    }
 
}
