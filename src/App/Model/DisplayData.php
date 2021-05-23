<?php


class DisplayData
{
    private function getDatafrmDatabase(string $tablename, array $connectionParams)
    {
        var_dump("Retrieving  Data Into Database...");
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

        //$sql = "SELECT * FROM basanta WHERE name = ?";
        $sql = "SELECT * FROM ".$tablename;
        $stmt = $conn->query($sql);
        echo "\n Name \t\t Email \t\t\t\t Website \n\n";
        while (($row = $stmt->fetchAssociative()) !== false) {
            // var_dump($row['name']);
            echo  $row['name']."\t".$row['email']. "\t\t". $row['website']." \n";
        }
    }
}