<html>
 
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

             <table class = 'table' style="font-size:12px">
				<tr class='danger'>
					<th>Title</th>
					<th>Posted By</th>
					<th>Posted On</th>
					<th>Hits</th>
                </tr>
                <?php
                  include $_SERVER['DOCUMENT_ROOT']."/blogs/models/blogModel.php";

                  getBlogs();
                ?>
            </table>
      </div>
  </body>
</html>