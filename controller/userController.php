<?php
@session_start();
include $_SERVER['DOCUMENT_ROOT']."/blogs/models/userModel.php";

if(isset($_POST['signup'])){
    
    $fullname = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $confirmPassword = $_POST['confirmPassword'];

    if(isset($_POST['role'])){

        $role = $_POST['role'];
    }else{

        $role = 'non-admin';
    }

        if($password != $confirmPassword){
    
            $error = "passwords do not match";
    
            header("location:http://localhost/blogs/view/signUp.php?error={$error}");

                }else if(isEmpty($fullname, $username, $password,$confirmPassword,$email)){
    
                    $error = "please fill all the fields";
    
                    header("location:http://localhost/blogs/view/signUp.php?error={$error}");

                        }else if(isUsernameExists($username)) {
    
                            $error = "username already exists";
    
                            header("location:http://localhost/blogs/view/signUp.php?error={$error}");

                                }else if(postUsers($fullname, $username, $password,$role,$email)){

                                        header("location:http://localhost/blogs/view/userlist.php");
   
                                    }else{
   
                                    }
}
  


if(isset($_POST['login'])){
    
        $username = $_POST['username'];
        $password = $_POST['password'];
        $isLoggedIn = login($username, $password);
        $create = $_POST['create'];
        $error;
            if($isLoggedIn == "admin" || $isLoggedIn == "non-admin"){
            
                $_SESSION['user'] = $isLoggedIn;
                if($create){
                    header("location:http://localhost/blogs/controller/blogController.php?create=true");
                }else{
                    header("location:http://localhost/blogs/index.php");
                }
               
             
            }else if($isLoggedIn == "blocked"){

                $error = "You are blocked by admin!"; 
                header("location:http://localhost/blogs/view/login.php?error={$error}");           
            }else if($isLoggedIn ==  false){

                $error = "please enter correct username and password";
                header("location:http://localhost/blogs/view/login.php?error={$error}");
            }
    }

if(isset($_GET['togglestatus'])){

   makeUserInactive($_GET['userId']);
   header("location:http://localhost/blogs/view/userlist.php");

}

if(isset($_GET['viewprofile'])){

    header("location:http://localhost/blogs/view/profileview.php?id={$_GET['userId']}");
}

function isEmpty($name, $username, $password,$confirmPassword,$email){

    if(empty($name)){

        return true;
    }else if(empty($email)){

        return true;

    }else if(empty($username)){

        return true;
    }else if(empty($password)){

        return true;
    }else if(empty($confirmPassword)){

        return true;
    }else{

        return false;
    }

}

?>