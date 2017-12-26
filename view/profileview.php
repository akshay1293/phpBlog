<!DOCTYPE html>
<html>
<?php
       @session_start();
       include $_SERVER['DOCUMENT_ROOT']."/blogs/models/userModel.php";
       if(isset($_GET['id'])){

        $user = getUserById($_GET['id']);
       }

       $display = $_SESSION['user'] == 'admin'?'inline':'none';

       $filePath = explode("/",__FILE__); 
    ?> 
<head>
<?php

  include $_SERVER['DOCUMENT_ROOT']."/blogs/view/scripts.html";

?>
    <script type="text/javascript">
   
     $(document).ready(function(){

        $("a[id='block-user']").click(function(){
            if(confirm("Are you sure you want to change status of this user?")){

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
    <div class="col-md-5">
        <div class="well" style="background:#f3dfdf;" >
        <div align="center"><img src = "http://localhost/blogs/profile.jpg" alt="profile pic not found" height=150 width=150 class="img-circle"></div>
            <div class="media" style="padding:10px 10px">
                <div class="media-body" align="center">
                    <h4 class="media-heading"><?php echo strtoupper($user['fullname'])?></h4>
                    <span class="glyphicon glyphicon-user"></span>
                    <p style="display:inline"><?php echo ucwords($user['username'])?></p><br>
                    <div style="display:<?php $user['email'] != ''?print('inline-block'):print('none')?>" class="glyphicon glyphicon-envelope"></div>
                    <i><?php echo $user['email']?></i>
                    <div style="display:<?php echo $display?>">
                    <a id="block-user" class="btn btn-danger" style="font-family:monospace;margin:10px;display:<?php $user['id'] == $_SESSION['id']?print('none'):print('block')?>" href="http://localhost/blogs/controller/userController.php?userId=<?php echo $user['id'];?>&togglestatus=true">
                        <?php 
                            $user['status'] == 0?print('Block'):print('unblock')
                        ?>
                    </a>
                    </div>
                </div>
            </div> 
        </div>    
    </div>
</div>
</body>
</html>