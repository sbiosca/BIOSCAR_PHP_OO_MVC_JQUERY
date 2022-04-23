<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/BIOSCAR_PHP_OO_MVC_JQUERY/';
include_once($path . 'model/config.php');

class DAO_home {
    function list_brands($loaded, $items) {
        $sql = "SELECT * FROM brand LIMIT $loaded, $items";
        $connection = connect::conn_bioscar();
        $home = mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $home;
    }

    function list_categ() {
        $sql = "SELECT * FROM category";
        $connection = connect::conn_bioscar();
        $home = mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $home;
    }

    function list_type() {
        $sql = "SELECT * FROM type";
        $connection = connect::conn_bioscar();
        $home = mysqli_query($connection, $sql);
        mysqli_close($connection);
        return $home;
    }

    function load_more() {
        $sql = "SELECT COUNT(*) AS count FROM brand";
        $connection = connect::conn_bioscar();
        $home = mysqli_query($connection, $sql);
        mysqli_close($connection);
        $homepage = array();
            foreach ($home as $row) {
                array_push($homepage, $row);
            }
        return $homepage;

    }
}

?>