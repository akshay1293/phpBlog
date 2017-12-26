<html>
<?php 
   @session_start(); 
   include $_SERVER['DOCUMENT_ROOT']."/blogs/models/blogModel.php";
   if(!isset($_SESSION['user'])){

      header("location:http://localhost/blogs/view/login.php");
   }
   if(isset($_GET['blogId'])){

        $blog = getBlogsById($_GET['blogId']);
   }
?>
<head>
    
<?php

  include $_SERVER['DOCUMENT_ROOT']."/blogs/view/scripts.html";

?>
</head>

<body>
        <?php

             include $_SERVER['DOCUMENT_ROOT']."/blogs/view/header.php";

        ?>
   <div class = "container">
                <?php
				  if(isset($_GET['error'])){

					  echo "<p style='color:tomato;'>".$_GET['error']."</p>";
				  }
				
				?>
    <div class = "login-container" style="margin:30px;">
        <div class = "form-group">
            <form class = "login-form" action = "http://localhost/blogs/controller/blogController.php" method = "POST" enctype="multipart/form-data">
                <input type = "text" name = "title" class = "form-control" value="<?php $_GET['blogId']?print($blog['title']):print('');?>" placeholder = "Enter title for the blog"/>
                <textarea placeholder = "Type your content here...(max 1000 characters)" name = "content" rows="10" maxlength="1000" class = "form-control"  required><?php $_GET['blogId']?print($blog['content']):print('');?></textarea>
                <input type = "file" name = "image" class = "form-control">
                <input type = "hidden" name = "id" value="<?php $_GET['blogId']?print($blog['id']):print('');?>">
                <input type = "submit" name="<?php $_GET['blogId']?print('edit'):print('submit');?>" value = "SUBMIT" class = "btn btn-danger"/>    
            </form>
            <img src="<?php echo "http://localhost/blogs/images/".$blog['image']?>" style="height:150px;display:<?php $_GET['blogId']?print('block'):print('none')?>" class="img-thumbnail">
        </div>
    </div>
   </div>
</body>

</html>