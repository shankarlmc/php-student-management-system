<?php 
    require_once "../manager/includes/config.php";
    $firstname = $lastname = $email = $password = "";
    $firstname_err =$lastname_err = $email_err = $password_err = $repeatpassword_err = "";

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        if(empty(trim($_POST["firstname"]))){
          $firstname_err="Please Enter Your Last Name.";
        } 
        else{
       
            $firstname= trim($_POST["firstname"]);
          }
         if(empty(trim($_POST["email"]))){
            $email_err="Please enter a valid email.";
        }
         else{
        $sql = "SELECT user_id FROM useraccounts WHERE email = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            $param_email = trim($_POST["email"]);
        
            if(mysqli_stmt_execute($stmt)){
               
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This Email is Already taken.";
                } else{ 
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
      
        mysqli_stmt_close($stmt);
    }
    if(empty(trim($_POST["lastname"]))){
        $lastname_err="Please Enter Your Last Name.";
        } 
        else{
       
            $lastname= trim($_POST["lastname"]);
    }
     if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    if(empty(trim($_POST["repeatpassword"]))){
        $repeatpassword_err="Please Confirm Your Password.";
        } 
        else{
       
            $repeatpassword= trim($_POST["repeatpassword"]);
    }
    if(empty($password_err) && ($password != $repeatpassword)){
            $repeatpassword_err = "Password did not match.";
    }
     
    if(empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($password_err)){
        $sql = "INSERT INTO useraccounts (fname, lname, email, password) VALUES (?, ?, ?,?)";
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "ssss", $param_firstname, $param_lastname, $param_email, $param_password);
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            if(mysqli_stmt_execute($stmt)){
                echo "<script>alert('You are registered On our System, But you Need Admin approval for login !!!!')</script>";
                echo "<script>location.href='login.php'</script>";
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
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PNC Admin || Registration New User</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">

  <div class="container">
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-6 col-md-8">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data"> 
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <span class="alert-link text-danger"> <?php echo "$firstname_err"; ?></span>
                    <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name" name="firstname">
                  </div>
                  <div class="col-sm-6">
                    <span class="alert-link text-danger"> <?php echo "$lastname_err"; ?></span>
                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name" name="lastname">
                  </div>
                </div>
                <div class="form-group">
                  <span class="alert-link text-danger"> <?php echo "$email_err"; ?></span>
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <span class="alert-link text-danger"> <?php echo "$password_err"; ?></span>
                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" name="repeatpassword">
                  </div>
                </div>
                <button class="btn btn-primary btn-user btn-block" name="submit">
                  Register Account
                </button>
                <hr>
                <a href="index.php" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.php" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.php">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</div>
  </div>
  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
