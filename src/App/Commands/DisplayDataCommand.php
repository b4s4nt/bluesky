<?php


namespace Console\App\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DisplayDataCommand extends Command

{
    protected function configure()
    {
        $this->setName('getdata')
            ->setHelp("Console command to get data from database")
            ->setDescription('getdata with name of database and table ')
            ->addArgument('tablename', InputArgument::REQUIRED, 'Give Your Table Name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('Welcome ! to create table, %s', $input->getArgument('tablename')));
        // Create Database
        $this->getDatafrmDatabase(
            'basanta',
            array(
                'dbname' => 'basanta',
                'user' => 'root',
                'password' => '',
                'host' => 'localhost',
                'driver' => 'pdo_mysql'
            )
        );

//        $output->writeln("Displaying data from database completed: ");

       
    }

    private function getDatafrmDatabase(string $tablename, array $connectionParams)
    {
        var_dump("Retrieving  Data Into Database...");
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

        //$sql = "SELECT * FROM basanta WHERE name = ?";
        $sql = "SELECT * FROM basanta";
        $stmt = $conn->query($sql);
        while (($row = $stmt->fetchAssociative()) !== false) {
            var_dump($row);
            echo $row['name'];
        }
    }
}