<?php


namespace Console\App\Commands;


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
            ->setDescription('hello world with name of argument')
            ->addArgument('username', InputArgument::REQUIRED, 'Give Your Database Name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Insert Data
        $this->insertData(
            'basanta',
            $input->getArgument('username'),
            array(
                'dbname' => 'basanta',
                'user' => 'root',
                'password' => '',
                'host' => 'localhost',
                'driver' => 'pdo_mysql',
            )
        );
    }

    private function insertData(string $tablename, string $value, array $connectionParams)
    {
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
        var_dump("Inserting Data Into Database:");
        $conn->insert($tablename, array('name' => $value, 'email' => 'basantakandel10@gmail.com'));
    }


}