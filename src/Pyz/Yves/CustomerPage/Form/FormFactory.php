<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Form;


use SprykerShop\Yves\CustomerPage\Form\FormFactory as SprykerFormFactory;
use Symfony\Component\Form\FormInterface;

/**
 * @method \Pyz\Yves\CustomerPage\CustomerPageConfig getConfig()
 */
class FormFactory extends SprykerFormFactory
{

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getAssetsQuickAddForm(): FormInterface
    {
        return $this->getFormFactory()->create(AssetsQuickAddForm::class);
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getAssetsCancelForm(): FormInterface
    {
        return $this->getFormFactory()->create(AssetsCancelForm::class);
    }
}
