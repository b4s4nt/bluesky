<?php


namespace Console\App\Commands;


use Doctrine\DBAL\Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InsertDataCommand extends Command
{
    protected function configure()
    {
        $this->setName('insert')
            ->setHelp("Console command to Insert Data Into Database")
            ->setDescription('Insert Your Info with Spcae as: tablename databasename firstname lastname email website')
            ->addArgument('tablename', InputArgument::REQUIRED, 'Give Your TableName')
            ->addArgument('databasename', InputArgument::REQUIRED, 'Give Your DatabaseName')
            ->addArgument(
                'info',
                InputArgument::IS_ARRAY,
                'Insert Your Info With Space :FirstName Lastname Email Website'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tablename = $input->getArgument('tablename');
        $databasename = $input->getArgument('databasename');
        $info = $input->getArgument('info');
        // Insert Data
        $this->insertData(
            $tablename,
            $info,
            array(
                'dbname' => $databasename,
                'user' => 'root',
                'password' => '',
                'host' => 'localhost',
                'driver' => 'pdo_mysql',
            )
        );
    }

    private function insertData(string $tablename, array $info, array $connectionParams)
    {
        try {
            $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
            var_dump("Inserting Data Into Database:");
            var_dump($info[0]);
            $name = $info[0] . $info[1];
            $conn->insert($tablename, array('name' => $info[0] . $info[1], 'email' => $info[2], 'website' => $info[3]));
        } catch (Exception $e) {
            var_dump("Exceptional Error At CreateDatabase:" . $e->getMessage());
        }
    }


}