<?php


namespace Console\App\Commands;


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
        $output->writeln(sprintf('Welcome !, %s', $input->getArgument('databasename'), 'To CreateDatabase'));
        // Create Database
        $this->createDatabase(
            $input->getArgument('databasename'),
            array(
                'driver' => 'pdo_mysql',
                'host' => '127.0.0.1',
                'user' => 'root',
                'password' => '',
            )
        );
      //  return Command::SUCCESS;
    }

    private function createDatabase(string $name, array $config)
    {
//        /** @var \Doctrine\DBAL\Connection */

        $tmpConnection = \Doctrine\DBAL\DriverManager::getConnection($config);

        // Check if the database already exists
        if (in_array($name, $tmpConnection->getSchemaManager()->listDatabases())) {
            return;
        }
        // Create the database
        $tmpConnection->getSchemaManager()->createDatabase($name);
        $tmpConnection->close();
    }
}