<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Widget;


use Generated\Shared\Transfer\CustomerAssetsTransfer;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \Pyz\Yves\CustomerPage\CustomerPageFactory getFactory()
 */
class AssetsRemoveButtonWidget extends AbstractWidget
{
    protected const PARAMETER_FORM = 'form';
    protected const PARAMETER_ASSETS = 'assets';

    /**
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $customerAssetsTransfer
     */
    public function __construct(CustomerAssetsTransfer $customerAssetsTransfer)
    {
        $this->addOrderParameter($customerAssetsTransfer);
        $this->addFormParameter();
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'AssetsRemoveButtonWidget';
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@CustomerPage/views/assets-remove-button/assets-remove-button.twig';
    }


    /**
     * @param \Generated\Shared\Transfer\CustomerAssetsTransfer $orderTransfer
     *
     * @return void
     */
    protected function addOrderParameter(CustomerAssetsTransfer $orderTransfer): void
    {
        $this->addParameter(static::PARAMETER_ASSETS, $orderTransfer);
    }

    /**
     * @return void
     */
    protected function addFormParameter(): void
    {
        $this->addParameter(static::PARAMETER_FORM, $this->getFactory()->createCustomerFormFactory()->getAssetsCancelForm());
    }

}
