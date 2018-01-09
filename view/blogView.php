<!DOCTYPE html>
<html>
<?php  
    include $_SERVER['DOCUMENT_ROOT']."/blogs/models/blogModel.php";
	
    @session_start();
    
    $display = $_SESSION['user']?"inline":"none";
	if(isset($_GET['id'])){
        $result = getBlogsById($_GET['id']); 
		
	}else{

        header("location:http://localhost/blogs/index.php");
    }
?>
<head>
<?php

  include $_SERVER['DOCUMENT_ROOT']."/blogs/view/scripts.html";
  $filePath = explode("/",__FILE__);
?>
    
</head>
<body>
        <?php
        
          include $_SERVER['DOCUMENT_ROOT']."/blogs/view/header.php";
        
        ?>

	<div class="container">
	    <div class="col-md-7" style="margin:30px;background-color: #f3dfdf;padding:20px;border-radius:10px">
		
            <div class="media">
                <div class="media-body">
                <h4 class="media-heading"><?php echo ucwords($result['fullname']) ?></h4>
                <h5 class="media-heading"><?php echo $result['title']?></h5>
                <h6 class="media-heading" style="font-style: italic;">Posted on <?php print_r($result['date_posted'])?></h6>
                <h6 class="media-heading" style="font-style: italic;"><?php print_r("Viewed ".$result['hits']." time(s)")?></h6>
                 <p><?php echo $result['content']?></p>
                    </div>
                        <div class="media-right">
                                <?php
                                     $path = "http://localhost/blogs/images/".$result['image'];
                 
                                     echo "<img src = '{$path}' alt = 'not found' style='height:150px;width:250px' class='media-object'>"
                                 ?>
                        </div>
                        <div class="media-bottom media-right">
                           <a href="http://localhost/blogs/controller/blogController.php?edit=true&blogId=<?php echo $_GET['id']?>" style="display:<?php $result['user_id']==$_SESSION['id']?print('block'):print('none')?>" class="btn btn-danger">Edit</a>
                        </div>
                    </div>
	        </div>
        </div>
</body>
</html>