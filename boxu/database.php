<?php
class Database
{


    public static function connect()
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $dbName = "box";
        try {

            $db = new PDO('mysql:host=' . $host . ';dbname=' . $dbName . ';charset=utf8', $user, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $db;
        } catch (Exception $e) {

            echo ('error in database:' . $e->getMessage());
        }
    }

    public static function statusUpdate($stmt)
    {
        try {
            $db = self::connect();
            $status = $db->exec($stmt);
            return $status;
        } catch (Exception $e) {
            echo ('error in the stmt:' . $e->getMessage());
            $db = null;
        }
    }

    public static function selectAll($stmt)
    {
        try {
            $db = self::connect();
            $result = $db->query($stmt);
            return $result;
        } catch (Exception $e) {
            echo ('error inside selection:' . $e->getMessage());
            $db = null;
        }
    }
}
