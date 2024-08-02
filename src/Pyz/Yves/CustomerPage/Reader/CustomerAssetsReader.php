<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\CustomerPage\Reader;

use Generated\Shared\Transfer\CustomerAssetsListTransfer;
use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\OrderListFormatTransfer;
use Generated\Shared\Transfer\OrderListTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Pyz\Client\CustomerAssets\CustomerAssetsClientInterface;
use Pyz\Yves\CustomerPage\Reader\CustomerAssetsReaderInterface;
use SprykerShop\Yves\CustomerPage\CustomerPageConfig;
use SprykerShop\Yves\CustomerPage\Dependency\Client\CustomerPageToCustomerClientInterface;
use SprykerShop\Yves\CustomerPage\Dependency\Client\CustomerPageToSalesClientInterface;
use Symfony\Component\HttpFoundation\Request;

class CustomerAssetsReader implements CustomerAssetsReaderInterface
{
    /**
     * @var string
     */
    protected const PARAM_PAGE = 'page';

    /**
     * @var string
     */
    protected const PARAM_PER_PAGE = 'perPage';

    /**
     * @var int
     */
    protected const DEFAULT_PAGE = 1;

    /**
     * @var \Pyz\Client\CustomerAssets\CustomerAssetsClientInterface
     */
    protected $customerAssetsClient;


    /**
     * @var \Pyz\Yves\CustomerPage\CustomerPageConfig
     */
    protected $customerPageConfig;

    /**
     * @param \Pyz\Client\CustomerAssets\CustomerAssetsClientInterface $customerAssetsClient
     * @param \Pyz\Yves\CustomerPage\CustomerPageConfig $customerPageConfig
     */
    public function __construct(
        CustomerAssetsClientInterface $customerAssetsClient,
        CustomerPageConfig $customerPageConfig
    ) {
        $this->customerAssetsClient = $customerAssetsClient;
        $this->customerPageConfig = $customerPageConfig;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Generated\Shared\Transfer\CustomerAssetsListTransfer $customerAssetsListTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsListTransfer
     */
    public function getCustomerAssetsList(Request $request, CustomerAssetsListTransfer $customerAssetsListTransfer): CustomerAssetsListTransfer
    {
        $customerAssetsListTransfer = $this->expandCustomerAssetsTransfer($request, $customerAssetsListTransfer);

        return $this->customerAssetsClient->getPaginatedCustomerAssets($customerAssetsListTransfer);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Generated\Shared\Transfer\CustomerAssetsListTransfer $customerAssetsListTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerAssetsListTransfer
     */
    protected function expandCustomerAssetsTransfer(Request $request, CustomerAssetsListTransfer $customerAssetsListTransfer): CustomerAssetsListTransfer
    {
        $customerAssetsListTransfer->setPagination(
            $this->createPaginationTransfer($request),
        );

        // if (!$orderListTransfer->getFilter()) {
        //     $orderListTransfer->setFilter($this->createFilterTransfer());
        // }

        // if (!$orderListTransfer->getFormat()) {
        //     $orderListTransfer->setFormat(new OrderListFormatTransfer());
        // }

        return $customerAssetsListTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\FilterTransfer
     */
    protected function createFilterTransfer(): FilterTransfer
    {
        $filterTransfer = new FilterTransfer();
        $filterTransfer->setOrderBy($this->customerPageConfig->getDefaultOrderHistorySortField());
        $filterTransfer->setOrderDirection($this->customerPageConfig->getDefaultOrderHistorySortDirection());

        return $filterTransfer;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\PaginationTransfer
     */
    protected function createPaginationTransfer(Request $request): PaginationTransfer
    {
        $paginationTransfer = new PaginationTransfer();

        $paginationTransfer->setPage(
            $request->query->getInt(static::PARAM_PAGE, static::DEFAULT_PAGE),
        );
        $paginationTransfer->setMaxPerPage(
            $request->query->getInt(static::PARAM_PER_PAGE, $this->customerPageConfig->getDefaultCustomerAssetsPerPage()),
        );

        return $paginationTransfer;
    }
}
