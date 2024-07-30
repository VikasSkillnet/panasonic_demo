<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CustomerPage\Controller;

use Pyz\Yves\CustomerPage\Plugin\Router\CustomerPageRouteProviderPlugin;
use SprykerShop\Yves\CustomerPage\Controller\AbstractCustomerController;
use SprykerShop\Yves\CustomerPage\Controller\RegisterController as SprykerRegisterController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Yves\CustomerPage\CustomerPageFactory getFactory()
 */
class CustomerAssetsController extends AbstractCustomerController
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Spryker\Yves\Kernel\View\View|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request)
    {
        $response = $this->executeIndexAction($request);

        if (!is_array($response)) {
            return $response;
        }

        return $this->view($response, [], '@CustomerPage/views/customer-assets/customer-assets.twig');
    }


    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array
     */
    protected function executeIndexAction(Request $request)
    {
        $currentCustomer = $this->getLoggedInCustomerTransfer();
        if ($currentCustomer) {

        } else {
            return $this->redirectResponseInternal(CustomerPageRouteProviderPlugin::ROUTE_NAME_CUSTOMER_OVERVIEW);
        }


        return [];
    }
}
