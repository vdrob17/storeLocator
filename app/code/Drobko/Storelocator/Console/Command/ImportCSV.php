<?php

namespace Drobko\Storelocator\Console\Command;

use Drobko\Storelocator\Api\StoreLocatorRepositoryInterface;
use Drobko\Storelocator\Model\ResourceModel\StoreLocator\CollectionFactory;
use Drobko\Storelocator\Model\StoreLocatorFactory;
use Magento\Directory\Model\ResourceModel\Region\CollectionFactory as RegionCollectionFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SomeCommand
 */
class ImportCSV extends Command
{
    private $storeLocatorFactory;
    private $storeLocatorRepository;
    private $collectionFactory;
    private $regionCollectionFactory;
    const NAME = 'csv';

    /**
     * @inheritDoc
     */
    public function __construct(
        string $name = null,
        StoreLocatorRepositoryInterface $storeLocatorRepository,
        StoreLocatorFactory $storeLocatorFactory,
        CollectionFactory $collectionFactory,
        RegionCollectionFactory $regionCollectionFactory
    )
    {
        $this->storeLocatorRepository = $storeLocatorRepository;
        $this->storeLocatorFactory = $storeLocatorFactory;
        $this->collectionFactory = $collectionFactory;
        $this->regionCollectionFactory = $regionCollectionFactory;
        parent::__construct($name);
    }

    protected function configure()
    {
        $options = [
            new InputOption(
                self::NAME,
                null,
                InputOption::VALUE_REQUIRED,
                'Import'
            )
        ];
        $this->setDescription('This command import your stores from .csv file ');
        $this->setDefinition($options);

        parent::configure();
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return null|int
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($csv = $input->getOption(self::NAME)) {
            $output->writeln('<info>Import from `' . $csv . '`</info>');
            $fp = fopen(BP . '/' . $csv, 'r+');
            $header = fgetcsv($fp);
            while ($row = fgetcsv($fp)) {
                $arr = [];
                foreach ($header as $i => $col) {
                    $arr[$col] = $row[$i];
                }
                $model = $this->storeLocatorFactory->create();
                if (ctype_digit($arr['state']) && $arr['state']!=null) {
                    $regionName = $this->regionCollectionFactory->create();
                    $regionName = $regionName
                        ->addRegionCodeFilter($arr['state'])
                        ->getFirstItem()
                        ->toArray();
                    $arr['state'] = $regionName['default_name'];
                }
                $model->setData($arr);
                $this->storeLocatorRepository->save($model);
            }
        }
        $output->writeln('<info>Success Import.</info>');
    }
}
