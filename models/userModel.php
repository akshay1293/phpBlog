<?php
@session_start();
require ($_SERVER['DOCUMENT_ROOT'].'/blogs/models/config.php');

function isUsernameExists($n){

   $connect = getConnection();
    $query = "SELECT * FROM users WHERE username = '$n'";
    $result = mysqli_query($connect, $query);

  
   if($result){
    $num = mysqli_num_rows($result);

    if($num != 0){

        return true;
    }else{

        return false;
    }
   }else{

    echo mysqli_error($connect);
   }

}

function postUsers($name, $username, $password, $role,$email){

     $connect = getConnection();
     $query = "INSERT INTO users (fullname,username,password,email,role) VALUES('$name','$username','$password','$email','$role')";
     $result = mysqli_query($connect, $query);

     if($result){

        echo "inserted";
        return true;
     }else{

        echo mysqli_error($connect);
        return false;
     }

}

function getUserById($id){

   $connect = getConnection();
   $query = "SELECT * FROM users WHERE id='$id'";
   $result = mysqli_query($connect,$query);

   if($result){
     $rows = mysqli_fetch_assoc($result);
   }else{

    echo mysqli_error($connect);
   }

   return $rows;
  
}

function getUsers(){
    
       $connect = getConnection();
    $query = "SELECT * FROM users WHERE id != {$_SESSION['id']}";
       $result = mysqli_query($connect,$query);
       $users;
       if($result){
         while($rows = mysqli_fetch_assoc($result)){
            $action = $rows['status']?'Unblock':'Block';
            //$enableButton = $row['id'] == $_SESSION['id']?"none":"click"; 
            $users = $users."<tr>
            
                                  <td>
                                 
                                    <a style='text-decoration:none;color:black' href='http://localhost/blogs/controller/userController.php?viewprofile=true&userId={$rows['id']}'>".ucwords($rows['fullname'])."</a>
            
                                 </td>
                                  <td>"
                                
                                  .$rows['username'].
            
                                 "</td>
                                 <td>"
                                    
                                    .$rows['email'].
            
                                 "</td>
                                 <td>
            
                                  <a id='change-status' href='http://localhost/blogs/controller/userController.php?userId={$rows['id']}&togglestatus=true' style='width:100px;font-family: monospace;' class='btn btn-danger'>{$action}</a>
            
            
                                 </td>
            
                            </tr>";
         }
       }else{
    
        echo mysqli_error($connect);
       }
    
       return $users;
      
    }

function login($username,$password){

    $connect = getConnection();
    $query = "SELECT id,role,fullname,username,status FROM users WHERE username='$username' AND password ='$password'";
    $result = mysqli_query($connect,$query);

    if($result){

        $num = mysqli_num_rows($result);
        if($num > 0){

            $value = mysqli_fetch_assoc($result);
            if($value['status'] == 0){

                $_SESSION['id'] = $value['id'];
                $_SESSION['name'] = $value['fullname'];
                return $value['role'];
            }else{

                return "blocked";
            }
        }else{

            return false;
        }

    }else{
        echo mysqli_error($connect);
        return false;
    }
}

function makeUserInactive($id){

    $connect = getConnection();
    $query = "UPDATE users SET status = NOT status WHERE id='$id'";
    $result = mysqli_query($connect,$query);

    if($result){

        echo "updated";
    }else{

        echo mysqli_error($connect);
         
    }
}


?>