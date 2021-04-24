<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'mainpage';

if(isset($_GET['read_search']))
{
    $page = 'read';
}

include('models/model.php');

$dane = new ModelDanych;

switch($page){

    case 'mainpage':
    case 'delete':
    case 'update':
    case 'read':
    case 'create':
        $tresc = $dane->pobierz($page);
        if(isset($_POST['change'])){
            if($tresc == "ON"){
                $dane->zapisz("OFF");
                $tresc = "OFF";
            }
            else{
                $dane->zapisz("ON");
                $tresc = "ON";
            }
            
        }

        include "views/$page.php";        

        
        break;
    default:
    include "views/wrongsite.html";
    break;
}


?>

