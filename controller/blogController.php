<?php

include $_SERVER['DOCUMENT_ROOT'].'/blogs/models/blogModel.php';
session_start();


if(isset($_POST['submit'])){
	$targetDir = $_SERVER['DOCUMENT_ROOT']."/blogs/images/".basename($_FILES['image']['name']);
    $title = $_POST['title'];
	$content = $_POST['content'];
	$image = $_FILES['image']['name'];
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $_FILES['image']['tmp_name']);

    if($mime == "image/jpeg" && $_FILES['image']['size'] <= 1000000){
    	 move_uploaded_file($_FILES['image']['tmp_name'], $targetDir);
    	postBlogs($title,$content,$_FILES['image']['name']);
    	header("location:http://localhost/blogs/index.php");
   
        }
        else
        	{
				$error = "error in posting blog, please try again later or check the image format";
    			header("location:http://localhost/blogs/view/createBlog.php?error={$error}");
   			 }	
}

if(isset($_POST['edit'])){

	$targetDir = $_SERVER['DOCUMENT_ROOT']."/blogs/images/".basename($_FILES['image']['name']);
    $title = $_POST['title'];
	$content = $_POST['content'];
	$image = $_FILES['image']['name'];
	$id = $_POST['id'];
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $_FILES['image']['tmp_name']);

    if($mime == "image/jpeg" && $_FILES['image']['size'] <= 1000000){

    	 move_uploaded_file($_FILES['image']['tmp_name'], $targetDir);
    	 updateBlogs($title,$content,$_FILES['image']['name'],$id);
    	 header("location:http://localhost/blogs/view/blogView.php?id={$id}");
   
        }
        else
        	{

    			header("location:http://localhost/blogs/view/createBlog.php?error=true");
   			 }	

}

if(isset($_GET['viewBlogs'])){

    header("location:http://localhost/demoblog/view/blogTable.php");

}
if(isset($_GET['togglestatus'])){
	
	   makeBlogInactive($_GET['blogId']);
	   header("location:http://localhost/blogs/index.php");
	
	}
 
if(isset($_GET['logout'])){

	session_destroy();
	header("location:http://localhost/blogs/index.php"); 
}

if(isset($_GET['signup'])){

	header("location:http://localhost/blogs/view/signUp.php");
}

if(isset($_GET['allblogs'])){

	header("location:http://localhost/blogs/view/allblogs.php");
}

if(isset($_GET['page'])){

	getBlogs(2,$_GET['page']);
	header("location:http://localhost/blogs/view/allblogs.php?page={$_GET['page']}");
}

if(isset($_GET['view'])){
    updateCounter($_GET['blogId']);
	header("location:http://localhost/blogs/view/blogView.php?id={$_GET['blogId']}");
}

if(isset($_GET['create'])){

	header("location:http://localhost/blogs/view/createBlog.php");
}

if(isset($_GET['edit'])){

	header("location:http://localhost/blogs/view/createBlog.php?blogId={$_GET['blogId']}");
}

if(isset($_GET['delete'])){
	  
		deleteBlogById($_GET['blogId']);
		header("location:http://localhost/blogs/view/dashboard.php");
	}
?>