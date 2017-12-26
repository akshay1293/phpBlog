<!DOCTYPE html>
<html>
<?php
  @session_start();
  if(isset($_SESSION['user'])){

	  header("location:http://localhost/blogs/index.php");
  }
?>
<head>
<?php

  include $_SERVER['DOCUMENT_ROOT']."/blogs/view/scripts.html";

?>
</head>
<body>

	<div class = "container">
				<?php
				  if(isset($_GET['error'])){

					  echo "<p style='color:tomato;'>".$_GET['error']."</p>";
				  }
				
				?>
		<div class = "login-container" style="margin: 130px;">
	 
				
			<div class="form-group">

				<form class="login-form" action="http://localhost/blogs/controller/userController.php" method="POST">

					<input type="text" name="username" class="form-control" value="" placeholder="username" required>
					<input type="password" name="password" class="form-control" value="" placeholder="password" required>
					<input type="hidden" name="create"  value="<?php isset($_GET['loginandcreate'])?print($_GET['loginandcreate']):print('')?>" placeholder="password" required>
					<input type="submit" name="login" value="LOG IN" class="btn btn-danger">
                	<a href="http://localhost/blogs/controller/blogController.php?signup=true" class="btn btn-danger">Sign Up</a>
				</form>
			</div>
       

	 	</div>
	</div>
</div>

</body>
</html>