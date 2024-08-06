<?php
namespace Pyz\Zed\CustomerAssets\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Pyz\Zed\CustomerAssets\Business\CustomerAssetsFacadeInterface getFacade()
 * @method \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsQueryContainerInterface getQueryContainer()
 * @method \Pyz\Zed\CustomerAssets\Persistence\CustomerAssetsRepositoryInterface getRepository()
 * @method \Pyz\Zed\CustomerAssets\Communication\CustomerAssetsCommunicationFactory getFactory()
 */
class SyncOrderItemToAssetsConsoleCommand extends Console
{
    const COMMAND_NAME = 'assets:sync';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName(static::COMMAND_NAME);
        $this->setDescription('Sync order item to assets .');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $isSuccessfull = $this->getFacade()->syncOrderItemToAssets();
        if (!$isSuccessfull) {
            return static::CODE_ERROR;
        }

        return static::CODE_SUCCESS;
    }

}