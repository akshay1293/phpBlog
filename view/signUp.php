<!DOCTYPE html>
<html>
<?php
  @session_start();
?>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/blogs/css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://localhost/blogs/js/formValidation.js"></script>
	<title>Blogs</title>
</head>
<body>
	<div class = "container">
	
			<?php
				if(isset($_GET['error'])){

				echo "<p style='color:tomato;'>".$_GET['error']."</p>";
				}
  
  			?>
	  <div class = "login-container" style="margin: 80px;">
		  <div class="form-group">
			  <form class="login-form" name = "signup" action="http://localhost/blogs/controller/userController.php" method="POST">
				  <input type="text" name="name" class="form-control" value="" placeholder="fullname">
				  <input type="email" name="email" class="form-control" value="" placeholder="Email Id">
          		  <input type="text" name="username" class="form-control" value="" placeholder="username">
				  <input id="password" type="password" name="password" class="form-control" value="" placeholder="password">
				  <input type="password" name="confirmPassword" class="form-control" value="" placeholder="confirm password">
          		  <label style="display:<?php $_SESSION['user'] == 'admin'?print('inline'):print('none')?>"><input type="checkbox" name="role" value="admin">Admin</label>
			  	  <input type="submit" name="signup" value="SUBMIT" class="btn btn-danger"> 
			</form>
		</div>
       

	 </div>
	</div>
</div>


</body>
</html>