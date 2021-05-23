<?php


use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;

class CreateDatabase
{
    private function createDatabase($name, array $config)
    {
//        /** @var \Doctrine\DBAL\Connection */

        try {
            $tmpConnection = DriverManager::getConnection($config);
            // Check if the database already exists
            if (in_array($name, $tmpConnection->getSchemaManager()->listDatabases())) {
                return;
            }
            // Create the database
            $tmpConnection->getSchemaManager()->createDatabase($name);
            $tmpConnection->close();
        } catch (Exception $e) {
        }
    }
}