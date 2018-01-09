<!DOCTYPE html>
<html>
<?php
       @session_start();
       include $_SERVER['DOCUMENT_ROOT']."/blogs/models/userModel.php";
       if($_SESSION['user'] != 'admin'){

          header("location:http://localhost/blogs/index.php");
       }
       $filePath = explode("/",__FILE__);
    ?> 
<head>
<?php

  include $_SERVER['DOCUMENT_ROOT']."/blogs/view/scripts.html";

?>
    <script type="text/javascript">
   
     $(document).ready(function(){

        $("a[id='change-status']").click(function(){
            if(confirm("Are you sure you want to change status of the user?")){

                return true;
            }else{

                return false;
            }
        });
  

    });
    </script>
</head>
<body>
        <?php
        
          include $_SERVER['DOCUMENT_ROOT']."/blogs/view/header.php";
        
        ?>
 <div class="container">
 <div class="col-md-12"><h4 class="text-info">All Users</h4></div>
             <table class = 'table' style="font-size:12px">
				<tr class='danger'>
					<th>Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
                <?php echo getUsers();?>
			</table>

      </div>
</body>
</html>