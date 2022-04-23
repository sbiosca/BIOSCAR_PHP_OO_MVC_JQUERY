<?php
if(isset($_GET['modules'])) {
    include_once ($_GET['modules'].'.php');
}
else {
    include_once('index.php');
    include_once('modules/home/view/home.html');
}

?>