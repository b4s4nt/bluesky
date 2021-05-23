<?php

namespace Console\App\Commands;

use Doctrine\DBAL\Exception;
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
            ->setDescription('getdata  tablename space databasename ')
            ->addArgument('tablename', InputArgument::REQUIRED, 'Give Your Table Name')
            ->addArgument('databasename', InputArgument::REQUIRED, 'Give Your Database Name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tablename = $input->getArgument('tablename');
        $databasename = $input->getArgument('databasename');
        $output->writeln(sprintf('Welcome ! to getdata from table, %s', $input->getArgument('tablename')));
        $output->writeln(sprintf('Welcome  ! To Display Table : , %s', $input->getArgument('tablename')));


        // Create Database Calling Method
        $this->getDatafrmDatabase(
            $tablename,
            array(
                'dbname' => $databasename,
                'user' => 'root',
                'password' => '',
                'host' => 'localhost',
                'driver' => 'pdo_mysql'
            )
        );
    }


    // Get Data method
    private function getDatafrmDatabase(string $tablename, array $connectionParams)
    {
        var_dump("Retrieving  Data Into Database...");
        try {
            // Getting connection from database
            $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

            // MYSQL query
            //$sql = "SELECT * FROM basanta WHERE name = ?";
            $sql = "SELECT * FROM " . $tablename;
            //Eexecute Query
            $stmt = $conn->query($sql);
            echo "\n Name \t\t Email \t\t\t\t Website \n\n";
            while (($row = $stmt->fetchAssociative()) !== false) {
                // var_dump($row['name']);
                echo $row['name'] . "\t" . $row['email'] . "\t\t" . $row['website'] . " \n";
            }
        } catch (Exception $e) {
            var_dump("Exceptional Error At CreateDatabase:" . $e->getMessage());
        }
    }
}