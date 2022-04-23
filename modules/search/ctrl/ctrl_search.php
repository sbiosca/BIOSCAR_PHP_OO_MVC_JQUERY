<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/BIOSCAR_PHP_OO_MVC_JQUERY/';
include_once($path . 'modules/search/model/DAO_search.php');

switch($_GET['op']) {
    case "load_type";
        $dao_search = new DAO_search();
        $type = $dao_search -> list_type();
        echo json_encode($type);
        break;
    case "load_model";
        $dao_search = new DAO_search();
        if(empty($_POST['type'])){
            $model = $dao_search->list_model();
        }else{
            $model = $dao_search->list_type_model($_POST['type']);
        }
        echo json_encode($model);
        break;
    case "autocomplete";
        $dao_search = new DAO_search();
        if (!empty($_POST['type']) && empty($_POST['model'])){
            $auto = $dao_search->list_auto_type($_POST['complete'], $_POST['type']);
        }else if(!empty($_POST['type']) && !empty($_POST['model'])){
            $auto = $dao_search->list_auto_type_model($_POST['complete'], $_POST['type'], $_POST['model']);
        }else if(empty($_POST['type']) && !empty($_POST['model'])){
            $auto = $dao_search->list_auto_model($_POST['model'], $_POST['complete']);
        }else {
            $auto = $dao_search->list_autocomplete($_POST['complete']);
        }
        echo json_encode($auto);
        break;
    case "search";
        $dao_search = new DAO_search();
        $search = $dao_search -> list_search($_GET['search']);
        echo json_encode($search);
        break;
}

?>