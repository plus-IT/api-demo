<?php 
    $classPath='./classes';
    function isAjaxRequest(){
        return (isset($_REQUEST["ajax"]) && $_REQUEST["ajax"]==='true' );
    }
    if(isAjaxRequest()){
        require_once($classPath."/Api.php");
        require_once($classPath.'/ajaxHandler.php');
        echo (ajaxHandler::handle());
        return;
    }


?>

<!DOCTYPE html>
<html lang="de">
        <?php require_once("./head.php"); ?>
   <body>
        <?php 
           if(isset($_REQUEST["id"]) && $_REQUEST["id"]!=''){
                require_once("./seminarDetails.php");
            }else{
                require_once("./listPage.php");
            }
        ?>
   </body>
</html>
