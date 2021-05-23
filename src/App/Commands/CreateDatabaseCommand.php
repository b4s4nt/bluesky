<?php

namespace Console\App\Commands;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateDatabaseCommand extends Command
{
    protected function configure()
    {
        $this->setName('createdatabase')
            ->setHelp("Console command to create database")
            ->setDescription('createdatabase space databasename')
            ->addArgument('databasename', InputArgument::REQUIRED, 'Give Your Database Name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf('Welcome  ! To Create Database: , %s', $input->getArgument('databasename')));


        // Create Database Method Calling

        $this->createDatabase(
            $input->getArgument('databasename'),
            array(
                'driver' => 'pdo_mysql',
                'host' => '127.0.0.1',
                'user' => 'root',
                'password' => '',
            )
        );
    }

// Create Database Method
    private function createDatabase($name, array $config)
    {
//        /** @var \Doctrine\DBAL\Connection */

        try {
            //Creating Connection using doctrine dbal drivemanager
            $tmpConnection = DriverManager::getConnection($config);
            // Check if the database already exists
            if (in_array($name, $tmpConnection->getSchemaManager()->listDatabases())) {
                return;
            }
            // Create the database
            $tmpConnection->getSchemaManager()->createDatabase($name);
            $tmpConnection->close();
        } catch (Exception $e) {
            var_dump("Exceptional Error At CreateDatabase:" . $e->getMessage());
        }
    }
}