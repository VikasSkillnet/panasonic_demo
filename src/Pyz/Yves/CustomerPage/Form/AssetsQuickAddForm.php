<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Form;

use Spryker\Yves\Kernel\Form\AbstractType;
use SprykerShop\Yves\ShopUi\Form\Type\FormattedIntegerType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @method \Pyz\Yves\CustomerPage\CustomerPageConfig getConfig()
 * @method \Pyz\Yves\CustomerPage\CustomerPageFactory getFactory()
 */
class AssetsQuickAddForm extends AbstractType
{
    /**
     * @var string
     */
    public const FIELD_SKU = 'sku';

    /**
     * @var string
     */
    public const FIELD_ID_CUSTOMER = 'idCustomer';

    /**
     * @var string
     */
    public const FIELD_REDIRECT_ROUTE_NAME = 'redirect-route-name';


    /**
     * @var string
     */
    protected const FORM_NAME = 'assetsQuickAddForm';


    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return '';
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {

    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addIdCustomerField($builder)
            ->addSku($builder)
            ->addRedirectRouteName($builder);

    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addSku(FormBuilderInterface $builder)
    {
        $builder->add(static::FIELD_SKU, HiddenType::class, [
            'required' => true,
            'label' => false,
            'constraints' => [
                $this->createNotBlankConstraint('Sku is required'),
            ],
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addRedirectRouteName(FormBuilderInterface $builder)
    {
        $builder->add(static::FIELD_REDIRECT_ROUTE_NAME, HiddenType::class, [
            'required' => false,
            'label' => false,
        ]);

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     *
     * @return $this
     */
    protected function addIdCustomerField(FormBuilderInterface $builder, )
    {
        $builder->add(static::FIELD_ID_CUSTOMER, HiddenType::class, [
                'required' => true,
            ]);

        return $this;
    }


    /**
     * @param string $message
     *
     * @return \Symfony\Component\Validator\Constraints\NotBlank
     */
    protected function createNotBlankConstraint(string $message): NotBlank
    {
        return new NotBlank([
            'message' => $message,
        ]);
    }

}
