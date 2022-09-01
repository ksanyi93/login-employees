<?php

ini_set('display_errors', 1);

spl_autoload_register(function($file){
    require "$file.php";
});

use classes\Employees;

if( isset($_POST["delete"]) ){
    (new Employees)->delete($_POST["delete"]);
}else{
    (new Employees)->get($_GET['from']??0);
}