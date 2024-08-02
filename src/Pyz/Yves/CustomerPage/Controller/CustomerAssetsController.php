<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CustomerPage\Controller;

use Generated\Shared\Transfer\CustomerAssetsListTransfer;
use Generated\Shared\Transfer\CustomerAssetsTransfer;
use Pyz\Yves\CustomerPage\Form\AssetsQuickAddForm;
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
     * @var string
     */
    protected const PARAM_ID_CUSTOMER_ASSETS = 'id-customer-assets';


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
            $customerAssetsListTransfer = new CustomerAssetsListTransfer();
            $customerAssetsListTransfer->setIdCustomer($currentCustomer->getIdCustomer());

            $customerAssetsListTransfer = $this->getFactory()->createCustomerAssetsreader()->getCustomerAssetsList($request, $customerAssetsListTransfer);
            $assetsQuickAddForm = $this->getFactory()->createCustomerFormFactory()->getAssetsQuickAddForm()->handleRequest($request);

            if ($assetsQuickAddForm->isSubmitted() && $assetsQuickAddForm->isValid()) {
                $assetsData = $assetsQuickAddForm->getData();
                $customerAssetsTransfer = new CustomerAssetsTransfer();
                $customerAssetsTransfer->setFkCustomer((int) $assetsData[AssetsQuickAddForm::FIELD_ID_CUSTOMER]);
                $customerAssetsTransfer->setFkSku($assetsData[AssetsQuickAddForm::FIELD_SKU]);

                $customerAssetsTransfer = $this->getFactory()->getCustomerAssetsClient()->addCustomerAssets($customerAssetsTransfer);
                $this->addSuccessMessage('Assets Added Successfully.. !');
                return $this->redirectResponseInternal(CustomerPageRouteProviderPlugin::ROUTE_NAME_CUSTOMER_MY_ASSETS);

            }

        } else {
            return $this->redirectResponseInternal(CustomerPageRouteProviderPlugin::ROUTE_LOGIN);
        }


        return [
            'customerAssetsListTransfer' => $customerAssetsListTransfer,
            'pagination' => $customerAssetsListTransfer->getPagination(),
            'idCustomer' => $customerAssetsListTransfer->getIdCustomer(),
            'assetsQuickAddForm' => $assetsQuickAddForm->createView(),
        ];
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAssetsAction(Request $request)
    {
        $idCustomerAssets = $request->query->getInt(static::PARAM_ID_CUSTOMER_ASSETS);

        $customerAssetsTransfer = (new CustomerAssetsTransfer())->setIdCustomerAssets($idCustomerAssets);

        $responesCustomerAssets = $this->getFactory()->getCustomerAssetsClient()->removeCustomerAssets($customerAssetsTransfer);

        if ($responesCustomerAssets->getIsDeleted()) {
            $this->addSuccessMessage('Assets Deleted Successfully... !');
        } else {
            $this->addErrorMessage('Spmething went wrong... !');
        }

        return $this->redirectResponseInternal(CustomerPageRouteProviderPlugin::ROUTE_NAME_CUSTOMER_MY_ASSETS);

    }
}
