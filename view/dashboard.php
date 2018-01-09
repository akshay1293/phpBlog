<html>
<?php
  @session_start();
  include $_SERVER['DOCUMENT_ROOT']."/blogs/models/blogModel.php";
  if(!isset($_SESSION['user'])){

    header("location:http://localhost/blogs/index.php");
  }

?>
  <head>
  <?php
  
    include $_SERVER['DOCUMENT_ROOT']."/blogs/view/scripts.html";
    $filePath = explode("/",__FILE__);
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
          <div class="col-md-12"><h4 class="text-info">Recent Blogs</h4></div>
             <table class = 'table' style="font-size:12px">
				<tr class='danger'>
					<th>Title</th>
					<th>Posted By</th>
					<th>Posted On</th>
					<th>Hits</th>
                    <th><?php $_SESSION['user'] == 'admin'?print('Action'):print('Status')?></th>
                    <th style="display:<?php $_SESSION['user'] == 'admin'?print('none'):print('table-cell')?>"></th>
				</tr>
                <?php 
                if($_SESSION['user'] == 'admin'){

                    getBlogs(5);
                }else if($_SESSION['user'] == 'non-admin'){

                    echo getBlogsByUserId($_SESSION['id']);
                }
                   
                
                ?>
			</table>
         <div align="right" class="col-md-12"><a style="display:<?php $_SESSION['user'] == 'admin'?print('inline'):print('none')?>" href="http://localhost/blogs/controller/blogController.php?allblogs=true" class="btn btn-info">View All >></a></div>
      </div>
  </body>
</html>