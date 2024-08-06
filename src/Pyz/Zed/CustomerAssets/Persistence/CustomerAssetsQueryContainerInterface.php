<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CustomerAssets\Persistence;

use Generated\Shared\Transfer\FilterTransfer;

use Spryker\Zed\Kernel\Persistence\QueryContainer\QueryContainerInterface;

interface CustomerAssetsQueryContainerInterface extends QueryContainerInterface
{

    /**
     * Specification:
     * - TODO: Add method specification.
     *
     * @api
     *
     * @param int $idCustomer
     * @param \Generated\Shared\Transfer\FilterTransfer|null $filterTransfer
     *
     * @return \Orm\Zed\CustomerAssets\Persistence\PyzCustomerAssetsQuery
     */
    public function queryCustomerAssets($idCustomer, ?FilterTransfer $filterTransfer = null);

     /**
     * 
     * @return \Propel\Runtime\Collection\ObjectCollection<\Orm\Zed\Sales\Persistence\SpySalesOrderItem>
     */
    public function queryAllSalesOrderItemEntity();


}
