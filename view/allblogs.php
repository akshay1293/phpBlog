<html>
<?php
  @session_start();
  include $_SERVER['DOCUMENT_ROOT']."/blogs/models/blogModel.php";
  if(!isset($_SESSION['user'])){

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
            if(confirm("Are you sure you want to change status of this post?")){

                return true;
            }else{

                return false;
            }
        });

        $("a[id='remove-blog']").click(function(){
            if(confirm("Are you sure you want to delete this blog?")){

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
      <div class="col-md-12"><h4 class="text-info">All Blogs</h4></div>
             <table class = 'table' style="font-size:12px">
				<tr class='danger'>
					<th>Title</th>
					<th>Posted By</th>
					<th>Posted On</th>
					<th>Hits</th>
					<th>Action</th>
				</tr>
                <?php 
                
                    if(isset($_GET['page'])){

                        getBlogs(2,$_GET['page']);
                    }else{

                        getBlogs(2);
                    }  
                
                ?>
			</table>
            <ul class="pagination">
                 <li class="<?php !isset($_GET['page'])||$_GET['page'] == 1?print('active'):print('');?>"><a href="http://localhost/blogs/view/allblogs.php?page=1">1</a></li>
                 <li class="<?php $_GET['page'] == 2?print('active'):print('');?>"><a href="http://localhost/blogs/view/allblogs.php?page=2">2</a></li>
                 <li class="<?php $_GET['page'] == 3?print('active'):print('');?>"><a href="http://localhost/blogs/view/allblogs.php?page=3">3</a></li>
                 <li class="<?php $_GET['page'] == 4?print('active'):print('');?>"><a href="http://localhost/blogs/view/allblogs.php?page=4">4</a></li>
                 <li class="<?php $_GET['page'] == 5?print('active'):print('');?>"><a href="http://localhost/blogs/view/allblogs.php?page=5">5</a></li>
            </ul>
            <a href="http://localhost/blogs/index.php" class="btn btn-info">Back</a>
      </div>
  </body>
</html>