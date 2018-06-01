<?php

   @session_start();
  
   $fileName = $filePath[sizeof($filePath)-1];
?>

<nav class="navbar navbar-default" style="background:#f7f7f7">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="http://localhost/blogs/index.php"><strong>Blogs</strong></a>
                </div>
                <ul class="nav navbar-nav">
                    <li style="display:<?php $_SESSION['user']?print('inline'):print('none')?>" class="<?php $fileName == 'dashboard.php'?print('active'):print('')?>"><a href="http://localhost/blogs/index.php">Dashboard</a></li>
                    <li style="display:<?php $_SESSION['user'] == 'admin'?print('inline'):print('none')?>" class="<?php $fileName == 'userlist.php'?print('active'):print('')?>"><a href="http://localhost/blogs/view/userlist.php">Users</a></li>
                    <li><a href="#">About</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li title="View Profile" style="display:<?php $_SESSION['user']?print('inline'):print('none')?>"><a href="http://localhost/blogs/controller/userController.php?viewprofile=true&userId=<?php echo $_SESSION['id'];?>"><span class="glyphicon glyphicon-user"></span> <?php echo "Welcome ".ucwords($_SESSION['name'])?></a></li>
                    <?php
                       if($fileName == 'userlist.php'){

                            print '<li><a href="http://localhost/blogs/view/signUp.php"><span class="glyphicon glyphicon-pencil"></span> Create User</a></li>';
                       }else if($fileName == 'allblogs.php' || $fileName == 'blogView.php' || $fileName == 'dashboard.php' || $fileName == 'home.php'){


                            print '<li><a href="http://localhost/blogs/controller/blogController.php?create=true"><span class="glyphicon glyphicon-pencil"></span> Create Blog</a></li>';
                       }
                       //echo $linkToDisplay;
                    
                    ?>
                    
                    <li>  
                    <?php
                    
                      if(isset($_SESSION["user"])){

                        echo '<a href="http://localhost/blogs/controller/blogController.php?logout=true"><span class="glyphicon glyphicon-log-out"></span> Logout</a>';
                      }else{

                        echo '<a href="http://localhost/blogs/view/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>';
                      }
                    ?>
                    </li>
                </ul>
            </div>
        </nav>