<?php

$path = $_SERVER['DOCUMENT_ROOT'] . '/BIOSCAR_PHP_OO_MVC_JQUERY/';
include_once($path . 'modules/home/model/DAO_home.php');
@session_start();
//$_SESSION["tiempo"];
if (isset($_SESSION["tiempo"])) {  
    $_SESSION["tiempo"] = time();//Devuelve la hora actual
    //echo "aaaaaaaaaaaaaaaaaaaa";
}


switch($_GET['op']) {
    case "list";
        include_once("modules/home/view/home.html");
        break;
    case "carrousel_brand";
        try{
            $dao_home = new DAO_home();
            $home = $dao_home -> list_brands($_POST['loaded'],$_POST['items']);
            
        }catch (Exception $e){
            echo json_encode("error");
            exit;
        }
        if(!$home){
            echo json_encode("error");
            exit;
        }else{
            $homepage = array();
            foreach ($home as $row) {
                array_push($homepage, $row);
            }
            echo json_encode($homepage);
            exit;
        }
        break;
    case "categ";
        try{
            $dao_home = new DAO_home();
            $home = $dao_home -> list_categ();
        }catch (Exception $e){
            echo json_encode("error");
            exit;
        }
        if(!$home){
            echo json_encode("error");
            exit;
        }else{
            $homepage = array();
            foreach ($home as $row) {
                array_push($homepage, $row);
            }
            echo json_encode($homepage);
            exit;
        }
        break;
    case "type";
        try{
            $dao_home = new DAO_home();
            $home = $dao_home -> list_type();
        }catch (Exception $e){
            echo json_encode("error");
            exit;
        }
        if(!$home){
            echo json_encode("error");
            exit;
        }else{
            $homepage = array();
            foreach ($home as $row) {
                array_push($homepage, $row);
            }
            echo json_encode($homepage);
            exit;
        }
        break;
    case "load_all";
        $dao_home = new DAO_home();
        $load = $dao_home -> load_more();
        echo json_encode($load);
        break;
}