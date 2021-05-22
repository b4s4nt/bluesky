<?php


namespace Console\App\Commands;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateTableCommand extends Command
{
    protected function configure()
    {
        $this->setName('createtable')
            ->setHelp("Console command to create table on given database name")
            ->setDescription('createtable with table name as argument')
            ->addArgument('tablename', InputArgument::REQUIRED, 'Give Your Table Name');



    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
//        // Create Table
        $this->createTable(
            'basanta',
            array(
                'dbname' => 'basanta',
                'user' => 'root',
                'password' => '',
                'host' => '127.0.0.1',
                'driver' => 'pdo_mysql',
            )
        );

    }

    public function createTable($tablename, array $connectionParams)
    {
//        // Creating connection
//        $connectionParams = array(
//            'dbname' => 'symfony',
//            'user' => 'root',
//            'password' => '',
//            'host' => 'localhost',
//            'driver' => 'pdo_mysql',
//
//        );

        /* Connect to the database */
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
        $schema = $conn->getSchemaManager();

        if (!$schema->tablesExist($tablename)) {
            $usersTable = new \Doctrine\DBAL\Schema\Table($tablename);
            // var_dump($schema);

            /* Add some columns to the table */
            $usersTable->addColumn("id", "integer", array("unsigned" => true));
            $usersTable->addColumn("name", "string", array("length" => 64));
            $usersTable->addColumn("email", "string", array("length" => 256));
            $usersTable->addColumn("website", "string", array("length" => 256));
            $schema->createTable($usersTable);
            //$schema->createTable($usersTable); // save to DB
            /* Add a primary key */
            $usersTable->setPrimaryKey(array("id"));
            /* Set the Schema output platform, as we are using MySQL
              a Mysql schema will be generated. */
            //  $platform = $conn->getDatabasePlatform();
            /* The 'queries' variable will now hold the
             an array of sql statements.*/
            //  $queries = $schema->toSql($platform);
        }
    }
}