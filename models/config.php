<?php


  function getConnection()

  {
  	
		  $connect = mysqli_connect("localhost","root","hrhk","demoblog") or die("unable to connect to database");
		  
  			return $connect;

		}

?>