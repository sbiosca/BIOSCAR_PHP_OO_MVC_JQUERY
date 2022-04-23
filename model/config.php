<?php
class connect {
      public static function conn_bioscar() {
        $databaseHost = 'localhost';
        $databaseName = 'bioscar';
        $databaseUsername = 'root';
        $databasePassword = '';

        $mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
        return $mysqli;
    }
}
?>
