<?php

class DB_Connector {

// parametri per la connessione al database
    private $host = "localhost";
    private $user = "root";
    private $pass = "cr0wd.caf3_2014";
    private $active = false;
    private $dbname = "crowdcafe";

    public function connect() {
        if (!$this->active) {
            $this->active = true;
            $con = mysql_connect($this->host, $this->user, $this->pass);
            if ($con) {
                $selection = mysql_select_db($this->dbname, $con) or die(mysql_error());
                return $con;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function disconnect() {
        if ($this->active) {
            if (mysql_close()) {
                $this->active = false;
                return true;
            } else {
                return false;
            }
        }
    }

    public function query($sql) {
        if ($this->active) {
            $sql = mysql_query($sql) or die(mysql_error());
            return $sql;
        } else {
            return false;
        }
    }

}

?>
