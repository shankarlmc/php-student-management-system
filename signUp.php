<?php 
include"admin_panel/includes/config.php";
$username = $email = $password = "";
$username_err = $email_err = $password_err = "";
if(isset($_POST["studentSignup"])) {
  $uniqueId = random_int(1000, 9999999999);
  $username = $_POST['username'];
   $email = $_POST['email'];
   $password = $_POST['password'];
  //check whether username is already taken or not
  if(empty(trim($_POST["username"]))){
      $username_err = "Please enter a Username.";
  } else {
      $sql = "SELECT username FROM student_acc WHERE username='$username'";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result)>0) {
          $username_err = "This Username is already taken.";
      } else {
        $username = trim($_POST["username"]);
      }
  }  
  //check whether email is already taken or not
  if(empty(trim($_POST["email"]))){
      $email_err="Please enter a valid Email.";
  } else {
      $sql = "SELECT email FROM student_acc WHERE email='$email'";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result)>0) {
          $email_err = "This Email is already taken.";
      } else {
        $email = trim($_POST["email"]);
      }
  }
  //set password
  if(empty(trim($_POST["password"]))){
      $password_err = "Please enter a password.";     
  } elseif(strlen(trim($_POST["password"])) < 6){
      $password_err = "Password must have atleast 6 characters.";
  } else{
      $password = trim($_POST["password"]);
  }
  if(empty($username_err) && empty($email_err) && empty($password_err)){
        
        $sql = "INSERT INTO student_acc (username, email, password,value) VALUES (?,?,?,?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            
            mysqli_stmt_bind_param($stmt, "sssd", $param_username,$param_email ,$param_password,$param_value);
            
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            $param_value =1;
            if(mysqli_stmt_execute($stmt)){
              $result = mysqli_query($conn,"INSERT INTO `student_details`(`student_id`, `email`, `semester`, `firstname`, `lastname`, `middlename`, `paddress`, `sex`, `dob`, `birthplace`, `nationality`, `religion`, `contact`, `acc_type`, `maritalstatus`, `course_id`, `guardian_name`, `academic_year`, `value`) VALUES ('$uniqueId','$email','','','','','','','','','','','','','','','','','')");
                echo '<script>alert("You Are Registered As Student. You Will Need Administration Approval For Login !!!!!")</script>';
                echo "<script>location.href='index.php?page=studentLogin'</script>";
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
    }
if(isset($_POST["teacherSignup"])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  //check whether username is already taken or not
  if(empty(trim($_POST["username"]))){
    $username_err = "Please enter a Username.";
  } else {
    $sql = "SELECT username FROM teacher_acc WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0) {
        $username_err = "This Username is already taken.";
    } else {
      $username = trim($_POST["username"]);
    }
  }  
  //check whether email is already taken or not
  if(empty(trim($_POST["email"]))){
    $email_err="Please enter a valid Email.";
  } else {
    $sql = "SELECT email FROM teacher_acc WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0) {
        $email_err = "This Email is already taken.";
    } else {
      $email = trim($_POST["email"]);
    }
  }
  //set password
  if(empty(trim($_POST["password"]))){
    $password_err = "Please enter a password.";     
  } elseif(strlen(trim($_POST["password"])) < 6){
    $password_err = "Password must have atleast 6 characters.";
  } else{
    $password = trim($_POST["password"]);
  }
  if(empty($username_err) && empty($email_err) && empty($password_err)){
      
      $sql = "INSERT INTO teacher_acc (username, email, password,value) VALUES (?,?,?,?)";
       
      if($stmt = mysqli_prepare($conn, $sql)){
          
          mysqli_stmt_bind_param($stmt, "sssd", $param_username,$param_email ,$param_password,$param_value);
          
          $param_username = $username;
          $param_email = $email;
          $param_password = password_hash($password, PASSWORD_DEFAULT); 
          $param_value =1;
          if(mysqli_stmt_execute($stmt)){
              echo '<script>alert("You Are Registered As Teacher. You Will Need Administration Approval For Login !!!!!")</script>';
              echo "<script>location.href='index.php?page=teacherLogin'</script>";
          } else{
              echo "Something went wrong. Please try again later.";
          }
      }
      mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
}
function input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      
  return $data;
}

 ?>
<div class="container">
  <div class="row">
     <div class="col-md-3"></div>
     <!-- signup as student  --> 
     <?php 
      $page = isset($_GET['page']) ? $_GET['page'] :"";

     if($page == "studentSignup"){ ?>
    <div class="col-md-6">
    <div class="panel panel-default" >
    <div class="panel-body">
        <div class="well well-sm text-center" style="background-color: rgb(78, 115, 223);background-image: linear-gradient(30deg,#f70202 10%,#2e1897 100%);color:#fff;"><b > Signup As Student </b> </div>
            <form class="form-horizontal span6" action="" method="POST">
              <span class="alert-link alert-danger"> <?php global $username_err; echo "$username_err"; ?></span>
              <span class="alert-link alert-danger"> <?php global $email_err; echo "$email_err"; ?></span>
              <span class="alert-link alert-danger"> <?php global $password_err; echo "$password_err"; ?></span>
                <div class="form-group">
                  <div class="col-md-12">
                    <label class="control-label" for="username">Username:</label> 
                    <input   id="username" name="username" placeholder="Username" type="text" class="form-control input" >  
                  </div> 
                  <div class="col-md-12">
                    <label class="control-label" for="email">Email:</label> 
                    <input   id="email" name="email" placeholder="Email" type="email" class="form-control input" >  
                  </div>
                  <div class="col-md-12">
                    <label class="control-label" for=
                    "password_err">Password:</label> 
                     <input name="password" id="password_err" placeholder="Password" type="password" class="form-control input ">
             
                  </div> 
                  </div>
                  <div class="form-group">
                  <div class="col-md-12 text-center"> 
                    <button type="submit" id="sidebarLogin" name="studentSignup"  style="background-color: rgb(78, 115, 223);background-image: linear-gradient(30deg,#f70202 10%,#2e1897 100%);color:#fff;" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-logged-in "></span> Signup</button>&nbsp;&nbsp;
                    <a href="<?php echo 'index.php?page=studentLogin'; ?>" class="glyphicon glyphicon-logged-in " style="color: #55147a">Already Registered ?</a>
                  </div>
                </div>
            </form>
        </div>
        </div>
        </div>
        <!-- end signup as student -->
      <?php } else if($page == "staffSignup"){ ?>
        <!-- signup as staff --> 
         <div class="col-md-6">
           <div class="panel panel-default" >
        <div class="panel-body">
        <div class="well well-sm text-center" style="background-color: rgb(78, 115, 223);background-image: linear-gradient(30deg,#f70202 10%,#2e1897 100%);color:#fff;"><b > Signup As Staff </b> </div>
            <form class="form-horizontal span6" action="" method="POST">
              <span class="alert-link alert-danger"> <?php global $username_err; echo "$username_err"; ?></span>
              <span class="alert-link alert-danger"> <?php global $email_err; echo "$email_err"; ?></span>
              <span class="alert-link alert-danger"> <?php global $password_err; echo "$password_err"; ?></span>
                <div class="form-group">
                  <div class="col-md-12">
                    <label class="control-label" for="username">Username:</label> 
                    <input   id="username" name="username" placeholder="Username" type="text" class="form-control input" >  
                  </div> 
                  <div class="col-md-12">
                    <label class="control-label" for="email">Email:</label> 
                    <input id="email" name="email" placeholder="Username" type="email" class="form-control input" >  
                  </div>
                  <div class="col-md-12">
                    <label class="control-label" for=
                    "password_err">Password:</label> 
                     <input name="password" id="password_err" placeholder="Password" type="password" class="form-control input ">
             
                  </div> 
                  </div>
                  <div class="form-group">
                  <div class="col-md-12 text-center"> 
                    <button type="submit" id="sidebarLogin" name="teacherSignup" style="background-color: rgb(78, 115, 223);background-image: linear-gradient(30deg,#f70202 10%,#2e1897 100%);color:#fff;" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-logged-in "></span> Signup</button>&nbsp;&nbsp;
                    <a href="<?php echo 'index.php?page=staffLogin'; ?>" class="glyphicon glyphicon-logged-in " style="color: #55147a">Already Registered ?</a>
                  </div>
                </div>
            </form>
        </div>
        </div>
         </div>
       <?php } ?>
    <!--  end signup as staff  -->
</div>
<!-- end row -->
</div>
<!--   end container -->
