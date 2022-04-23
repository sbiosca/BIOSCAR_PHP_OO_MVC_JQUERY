<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/BIOSCAR_PHP_OO_MVC_JQUERY/';
include_once($path . 'modules/shop/model/DAO_shop.php');
include_once ($path . 'views/inc/jwt.php');
@session_start();

if (isset($_SESSION["tiempo"])) {  
    $_SESSION["tiempo"] = time(); //Devuelve la fecha actual
}
switch($_GET['op']) {
    case "list_shop";
        include_once("modules/shop/view/shop.html");
        break;
    case "list_cars";
        $dao_shop = new DAO_shop();
        $shop = $dao_shop -> list_all_cars($_GET['items'],$_GET['total']);
        echo json_encode($shop);
        break;
    case "list_one_car";
        $dao_shop = new DAO_shop();
        $shop = $dao_shop -> list_one_car_like($_GET['id']);

        if ($shop) {
            echo json_encode($shop);
        }else {
            $shop = $dao_shop -> list_one_car($_GET['id']);
            echo json_encode($shop);
        }
        
        break;
    case "filters";
        $dao_shop = new DAO_shop();
        $filter = $dao_shop->filters();
        echo json_encode($filter);
        break;
    case "load_filters";
        $dao_shop = new DAO_shop();
        $filter = $dao_shop->load_filters($_GET['search']);
        echo json_encode($filter);
        break;
    case "count";
        $dao_shop = new DAO_shop();
        $dao_shop->load_count($_GET['id']);
        break;
    case "count_filters";
        $dao_shop = new DAO_shop();
        $count_filters = $dao_shop->count_filters($_GET['search']);
        echo json_encode($count_filters);
        break;
    case "count_pagination";
        $dao_shop = new DAO_shop();
        $count_pagination = $dao_shop->count_pagination();
        echo json_encode($count_pagination);
        break;
    case "more_related";
        $dao_shop = new DAO_shop();
        $more_cars = $dao_shop->more_cars($_GET['categ'],$_GET['type'],$_GET['car']);
        echo json_encode($more_cars);
        break;
    case "read_likes";
        $secret = 'maytheforcebewithyou';
        $token = $_GET['user'];

        $JWT = new JWT;
        $json = $JWT->decode($token, $secret);
        $json = json_decode($json, TRUE);

        $dao_shop = new DAO_shop();
        $like = $dao_shop->read_likes($json['name'],$_GET['id']);
        echo json_encode($like);
        break;
    case "load_likes";
        $secret = 'maytheforcebewithyou';
        $token = $_GET['user'];

        $JWT = new JWT;
        $json = $JWT->decode($token, $secret);
        $json = json_decode($json, TRUE);

        $dao_shop = new DAO_shop();
        $like = $dao_shop->count_likes($json['name'],$_GET['id']);
       
        if ($like) {
            $dao_shop = new DAO_shop();
            $like = $dao_shop->dislike_car($json['name'],$_GET['id']);
            echo json_encode("DISLIKE");
        }else {
            $dao_shop = new DAO_shop();
            $like = $dao_shop->like_car($json['name'],$_GET['id']);
            echo json_encode("LIKE");
        }

        

        //echo json_encode($like);
        break;
}
?>