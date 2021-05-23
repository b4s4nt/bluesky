<?php


class CreateTable
{
    public function createTable($tablename, array $connectionParams)
    {

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