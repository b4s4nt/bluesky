<?php


class InsertData
{
    private function insertData( $tablename, array $info, array $connectionParams)
    {
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
        var_dump("Inserting Data Into Database:");
        var_dump($info[0]);
        $name = $info[0] . $info[1];
        $conn->insert($tablename, array('name' => $info[0] . $info[1], 'email' => $info[2], 'website' => $info[3]));
    }
}