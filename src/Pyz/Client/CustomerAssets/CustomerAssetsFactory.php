<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Client\CustomerAssets;

use Pyz\Client\CustomerAssets\Zed\CustomerAssetsStub;
use Spryker\Client\Kernel\AbstractFactory;

/**
 * @method \Pyz\Client\CustomerAssets\CustomerAssetsConfig getConfig()
 */
class CustomerAssetsFactory extends AbstractFactory
{
    /**
     * @return \Pyz\Client\CustomerAssets\Zed\CustomerAssetsStubInterface
     */
    public function createZedSalesStub()
    {
        return new CustomerAssetsStub(
            $this->getProvidedDependency(CustomerAssetsDependencyProvider::SERVICE_ZED),
        );
    }
}
