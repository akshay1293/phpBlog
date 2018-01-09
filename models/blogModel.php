<?php
@session_start();
require ($_SERVER['DOCUMENT_ROOT'].'/blogs/models/config.php');


function postBlogs($title, $content, $image){

	$connect = getConnection();
	$date_posted = date("y-m-d");
	$safeContent = mysqli_real_escape_string($connect, $content);
	$safeImage = mysqli_real_escape_string($connect, $image);
	$id = $_SESSION['id'];
    $query = "INSERT INTO blogs (user_id,title,content,image,date_posted) VALUES ('$id','$title' ,'$safeContent','$safeImage', '$date_posted')";
    $result = mysqli_query($connect,$query);

    if($result){

    	echo "yes";
    }else{

    	echo mysqli_error($connect);
    }

    mysqli_close($connect);

}

function updateBlogs($title, $content, $image, $id){

	$connect = getConnection();
	$date_posted = date("y-m-d");
	$safeContent = mysqli_real_escape_string($connect, $content);
	$safeImage = mysqli_real_escape_string($connect, $image);
	$query = "UPDATE blogs SET title = '$title', content = '$safeContent', image = '$safeImage', date_posted = '$date_posted' WHERE id = $id";

     $result = mysqli_query($connect, $query);

     if($result){

     	echo "updated";
     }else{

     	echo mysqli_error($connect);
     }

      mysqli_close($connect);

}


function getBlogs($limit = 2000000,$offset = 0){

    $connect = getConnection();
	@session_start();
	if(isset($_SESSION['user'])){
	
		$query = "SELECT blogs.id,user_id,title,date_posted,image,hits,blogs.status,fullname FROM blogs INNER JOIN users on user_id = users.id ORDER BY date_posted DESC LIMIT {$offset}, {$limit}";

	}else{
	
		$query = "SELECT blogs.id,user_id,title,date_posted,image,hits,blogs.status,fullname FROM blogs INNER JOIN users on user_id = users.id WHERE blogs.status = 0 ORDER BY date_posted DESC LIMIT {$offset}, {$limit}";
	}
    $result = mysqli_query($connect,$query);
	$display = @$_SESSION['user'] == 'admin'?'inline':'none'; 
	$imgPath = "http://localhost/blogs/images/";

    if(mysqli_num_rows($result) == 0){

    	echo "nothing found in database";
    }else
    {

    	while($rows = mysqli_fetch_assoc($result)){
            $action = $rows['status'] == 0?'Hide':'Show'; 
			$image = $imgPath.$rows['image'];
			$displayRemove = $rows['user_id'] == $_SESSION['id']?'inline':'none';
			$displayActionButton = $_SESSION['user']?"table-cell":"none";
    		echo "<tr>

    		          <td>
					 
					    <img src='{$image}' alt = '{$image}' class = 'img-thumbnail'  style='margin-right:10px;width:50px'>
    		            <a href='http://localhost/blogs/controller/blogController.php?view=true&blogId={$rows['id']}' style='text-decoration:none;color:black'>".ucwords($rows['title'])."</a>

    		         </td>
					  <td>
					
					   <a href='http://localhost/blogs/controller/userController.php?viewprofile=true&userId={$rows['user_id']}' style='text-decoration:none;color:black'>".ucwords($rows['fullname'])."</a>

    		         </td>
    		         <td>"
                        
                        .$rows['date_posted'].

					 "</td>
					 <td>"
						.$rows['hits'].
					 "</td>
    		         <td style='display:{$displayActionButton}'>

    		          <a id='change-status' href='http://localhost/blogs/controller/blogController.php?blogId={$rows['id']}&togglestatus=true' style='width:80px;font-family:monospace' class='btn btn-danger'>{$action}</a>
                      <a title='Delete Blog' href='http://localhost/blogs/controller/blogController.php?delete=true&blogId={$rows['id']}' id='remove-blog' style='text-decoration:none;margin-left:15px;display:{$displayRemove}'><span class='glyphicon glyphicon-trash' style='font-size:18px;top:6px'></span></a>
    		         </td>

    		    </tr>";

    	 }

    	}
 mysqli_close($connect);

    }



    function getBlogsById($id){

       	$connect = getConnection();
       	$query = "SELECT blogs.id,title,content,date_posted,image,hits,fullname,user_id FROM blogs INNER JOIN users on user_id = users.id WHERE blogs.id='$id'";
        $result = mysqli_query($connect,$query);
        
        $data = mysqli_fetch_array($result);
        mysqli_close($connect);
        return $data;

	}

	function getBlogsByUserId($id){

		$connect = getConnection();
		$query = "SELECT blogs.id,title,content,date_posted,image,blogs.status,users.id AS userId,hits,fullname FROM blogs INNER JOIN users on user_id = users.id WHERE users.id='$id'";
	 	$result = mysqli_query($connect,$query);
		$data;
		$imgPath = "http://localhost/blogs/images/";
		while($rows = mysqli_fetch_array($result)){
			
			$image = $imgPath.$rows['image'];
			$status = $rows['status'] == 0?"Active":"Inactive";
			$color = $status == "Active"?"green":"tomato";
			$data = $data."<tr>
			
								<td>
								 
									<img src='{$image}' alt = '{$image}' class = 'img-thumbnail'  style='margin-right:10px;width:50px'>
									<a href='http://localhost/blogs/controller/blogController.php?view=true&blogId={$rows['id']}' style='text-decoration:none;color:black'>".ucwords($rows['title'])."</a>
			
								 </td>
								  <td>
								
								   <a href='http://localhost/blogs/controller/userController.php?viewprofile=true&userId={$rows['userId']}' style='text-decoration:none;color:black'>".ucwords($rows['fullname'])."</a>
			
								 </td>
								 <td>"
									
									.$rows['date_posted'].
			
								 "</td>
								 <td>"
									.$rows['hits'].
								 "</td>
								 <td style='color:{$color}'>
								   <p style='width:80px'>".$status."</p>
								 </td>
								 <td>
								 	<a href='http://localhost/blogs/controller/blogController.php?delete=true&blogId={$rows['id']}' id='remove-blog' style='text-decoration:none;margin-left:15px;'><span class='glyphicon glyphicon-trash' style='font-size:18px;top:6px'></span></a>
								 </td>
			
							</tr>";
			
		}
		mysqli_close($connect);
	 	return $data;

	}
	
	function updateCounter($id){

		$connect = getConnection();
		$query = "UPDATE blogs SET hits = hits + 1 WHERE id='$id'";
		$result = mysqli_query($connect,$query);

		if($result){

			echo "updated counter";
		}else{

			echo mysqli_error($connect);
		}
	}

   function deleteBlogById($id){

          $connect = getConnection();
          $query = "DELETE FROM blogs WHERE id=$id";
          $result = mysqli_query($connect,$query);
          mysqli_close($connect);
          if($result){

          	return true;
          }else{

          	return false;
          }

   }

   function makeBlogInactive($id){

	$connect = getConnection();
    $query = "UPDATE blogs SET status = NOT status WHERE id='$id'";
    $result = mysqli_query($connect,$query);

    if($result){

        echo "updated";
    }else{

        echo mysqli_error($connect);
         
    }
   }



?>