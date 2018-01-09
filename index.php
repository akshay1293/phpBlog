<?php
  
  @session_start();

  if(!isset($_SESSION['user'])){
    
    include $_SERVER['DOCUMENT_ROOT']."/blogs/view/home.php";
    
}else{

    include $_SERVER['DOCUMENT_ROOT']."/blogs/view/dashboard.php"; 
}

  
?>