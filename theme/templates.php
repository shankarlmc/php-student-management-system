<?php
$username = $password = "";
$username_err = $password_err = "";
if(isset($_POST['studentLogin'])){

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter Username.";
    } else{
        $username = trim($_POST["username"]);
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    if(empty($email_err) && empty($password_err)){
        
        $sql = "SELECT student_id,unique_id,username,email, password FROM student_acc WHERE username = ? ";
        
        if($stmt = mysqli_prepare($conn, $sql)){
           
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if(mysqli_stmt_execute($stmt)){
 
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){

                    mysqli_stmt_bind_result($stmt, $id,$uniqueId,$username,$email, $hashed_password);

                    if(mysqli_stmt_fetch($stmt)){
                      
                        if(password_verify($password, $hashed_password)){ 
                          session_start();
                            $_SESSION["user_id"] = $id;
                            $_SESSION["user_unique_id"] = $uniqueId;
                            $_SESSION["user_email"] = $email;
                            $_SESSION["username"] = $username;
                            $_SESSION["message"] = "You are Logged In as Student";
                             echo "<script>location.href='student_page/index.php'</script>";
                        } else{
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                   
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
                
            }
        }
        
        mysqli_stmt_close($stmt);
    }
    
    
    mysqli_close($conn);
}
if(isset($_POST['teacherLogin'])){

 // $username = $_POST['username'];
 //  $password = $_POST['password'];

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter Username.";
    } else{
        $username = trim($_POST["username"]);
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    if(empty($email_err) && empty($password_err)){
        
        $sql = "SELECT staff_id,username,email, password FROM teacher_acc WHERE username = ? ";
        
        if($stmt = mysqli_prepare($conn, $sql)){
           
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if(mysqli_stmt_execute($stmt)){
 
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){

                    mysqli_stmt_bind_result($stmt, $id,$username,$email, $hashed_password);

                    if(mysqli_stmt_fetch($stmt)){
                      
                        if(password_verify($password, $hashed_password)){ 
                          session_start();
                            $_SESSION["staff_unique_id"] = $id;
                            $_SESSION["staff_email"] = $email;
                            $_SESSION["staff_name"] = $username;
                            $_SESSION["loginMessage"] = "You are Logged In as Teacher";
                             echo "<script>location.href='admin_panel/index.php'</script>";
                        } else{
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                   
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
                
            }
        }
        
        mysqli_stmt_close($stmt);
    }
    
    
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title><?php echo $title; ?> Php management system</title>

     <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="font/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/costum.css" rel="stylesheet">

 <style type="text/css">

.p {

  color: white;
   margin-bottom: 0;
  margin-top: 0;
  /*padding: 0;*/
  /*float: right;*/
  list-style: none;
}

.p > a { 
  color: white;
  /*text-align: center;*/
  margin-bottom: 0;
  margin: 0;
  padding: 0;
  text-decoration:none;
  background-color:  #0000FF;
}
.p > a:hover ,
.p > a:focus {
   color: black; 
   text-decoration:none;
   background-color: #2d52f2;
}


 
/**/

.menu  li {
  left: 0px;
  width: 150px;
  padding: 0 3px 0 3px;
  text-align: center;
 
}
</style>

 
</head>

<body style="background-color:#e0e4e5" >
 
 <div class="navbar navbar-magbanua  container" role="navigation" style="margin-top:-65px">
    
      <div class="container">
        <div class="navbar-header"> 
            <div class="navbar-menu p" >Shankar</div>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".bigMenu">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button> 
        </div>
 
        <div class="collapse navbar-collapse bigMenu"  > 
          <ul class="nav navbar-nav menu" style="margin-left:-4%;"    > 

          <!-- <ul class="nav navbar-nav" >  -->
            <li class="dropdown dropdown-toggle <?php echo ($_GET['page']=='') ? "active" : false;?> ">
              <a href="<?php echo 'index.php'; ?>">Home</a>
            </li>
            <li class="dropdown-toggle <?php echo ($_GET['page']=='department') ? "active" : false;?>" >
              <a href="<?php echo 'index.php?page=department'; ?>">Department</a>
            </li>
            
            <li class="dropdown-toggle <?php echo ($_GET['page']=='blogs') ? "active" : false;?>" >
              <a href="<?php echo 'index.php?page=blogs'; ?>">News & Notice</a>
            </li>
 
             <li class="dropdown-toggle <?php echo ($_GET['page']=='contact') ? "active" : false;?>">
              <a href="<?php echo 'index.php?page=contact';  ?>">Contact Us</a>
            </li> 
           <li class="dropdown-toggle <?php echo ($_GET['page']=='about') ? "active" : false;?> ">
             <a href="<?php echo 'index.php?page=about';  ?>"> 
               About Us
             </a>
          </li>
          <li class="dropdown-toggle <?php echo ($_GET['page']=='intro') ? "active" : false;?> ">
             <a href="<?php echo 'index.php?page=intro';  ?>"> 
               Dashboard
             </a>
          </li>
        
          </ul>           
        </div> 
        <!--/.navbar-collapse --> 
    </div> 
   <!-- /.nav-collapse --> 
  </div> 
 <!-- /.container -->
  
<div class="container "> 
   <!-- start content --> 
   
  
  
        <div class="row"> 
          <div id="page-wrapper">

            <div class="row" style="min-height: 400px;">
           <div class="col-lg-3">
          
                  <?php 
                  require_once "sidebar.php";
                
                    ?>
             </div>
              <div class="col-lg-9">
                <div class="panel panel-default">
                  <div class="panel-heading" style="background-color: rgb(78, 115, 223);background-image: linear-gradient(30deg,#f70202 10%,#2e1897 100%);color:#fff;">
                  <b><?php   
                  echo  $title . (isset($_GET['category']) ?  '  |  ' .$_GET['category'] : '' )?> </b> 
                  </div>
                  <div class="panel-body">
                 
                    <?php require_once $content; ?>
           
                     
                  </div>
                
              </div>
          </div> 
        </div>
        
       </div>
            <footer class="panel-footer" style="background-color: rgb(78, 115, 223);background-image: linear-gradient(30deg,#f70202 10%,#2e1897 100%);color:#fff;" >
              <p align="center" >&copy;SHANKAR LAMICHHANE || PHP MANAGEMENT SYSTEM</p>
           </footer>
      </div>
  </div>  
<!-- end of page  -->
 
<!-- jQuery -->
<script src="jquery/jquery.min.js"></script> 

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>
</html>