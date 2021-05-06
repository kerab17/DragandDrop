<?php

class Connection {
    static public function ConnectionBD() {
        $Conn = new PDO("mysql:host=db-sendox-mysql.celscoforlow.us-east-2.rds.amazonaws.com;dbname=AirDatabase", "admin_sendoxdev", "S3nd0xd3v");
        $Conn->exec("set names utf8");
        return $Conn;
    }

}
