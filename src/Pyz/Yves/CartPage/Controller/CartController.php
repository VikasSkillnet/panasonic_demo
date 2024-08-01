<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Yves\CartPage\Controller;

use Generated\Shared\Transfer\ItemTransfer;
use SprykerShop\Yves\CartPage\Controller\CartController as SprykerCartController;
use SprykerShop\Yves\CartPage\Plugin\Router\CartPageRouteProviderPlugin;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Yves\CartPage\CartPageFactory getFactory()
 */
class CartController extends SprykerCartController
{
    /**
     * @var string
     */
    protected const PARAM_REFERER = 'referer';

    /**
     * @param array<string, mixed> $selectedAttributes
     * @param bool $withItems
     *
     * @return array<string, mixed>
     */
    protected function executeIndexAction(array $selectedAttributes = [], bool $withItems = true): array
    {
        $viewData = parent::executeIndexAction($selectedAttributes, $withItems);
        $cartItems = $viewData['cartItems'];

        $viewData['products'] = $this->getFactory()
            ->createCartItemsProductsProvider()
            ->getItemsProducts($cartItems, $this->getLocale());

        return $viewData;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $sku
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addAction(Request $request, $sku): RedirectResponse
    {
        // parent::addAction($request, $sku);

         $form = $this->getFactory()->createCartPageFormFactory()->getAddToCartForm()->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            $this->addErrorMessage(static::MESSAGE_FORM_CSRF_VALIDATION_ERROR);

            return $this->redirectResponseInternal(CartPageRouteProviderPlugin::ROUTE_NAME_CART);
        }

        $quantity = $request->get('quantity', 1);
        $appointmentDate = $request->get('appointmentDate');

        if (!$this->canAddCartItem()) {
            $this->addErrorMessage(static::MESSAGE_PERMISSION_FAILED);

            return $this->redirectResponseInternal(CartPageRouteProviderPlugin::ROUTE_NAME_CART);
        }

        $itemTransfer = new ItemTransfer();
        $itemTransfer
            ->setSku($sku)
            ->setAppointmentDate($appointmentDate)
            ->setQuantity($quantity);

        $this->addProductOptions($request->get('product-option', []), $itemTransfer);

        $itemTransfer = $this->executePreAddToCartPlugins($itemTransfer, $request->request->all());

        $this->getFactory()
            ->getCartClient()
            ->addItem($itemTransfer, $request->request->all());

        $this->getFactory()
            ->getZedRequestClient()
            ->addResponseMessagesToMessenger();

        // return $this->redirectResponseInternal(CartPageRouteProviderPlugin::ROUTE_NAME_CART);


        return $this->redirectToReferer($request);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function redirectToReferer(Request $request): RedirectResponse
    {
        return $request->headers->has(static::PARAM_REFERER) ?
            $this->redirectResponseExternal($request->headers->get(static::PARAM_REFERER))
            : $this->redirectResponseInternal(CartPageRouteProviderPlugin::ROUTE_NAME_CART);
    }
}
