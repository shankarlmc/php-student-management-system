<?php
session_start();
require_once "../manager/includes/config.php";
function getRealIp() {
   //whether the ip is from share internet
  if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    $user_ip = $_SERVER['HTTP_CLIENT_IP']; // stores IP address of visitor in variable
  }
  //whether ip is from proxy
  elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR']; // stores IP address of visitor in variable
  }
  //whether ip is from remote address
  else{
    $user_ip = $_SERVER['REMOTE_ADDR']; // stores IP address of visitor in variable
  }
  return $user_ip;
}
function writeLog($where) {

  $user_ip = getRealIp(); // Get the IP from superglobal
  $host = gethostbyaddr($user_ip);    // Try to locate the host of the attack
  date_default_timezone_set ("Asia/Kathmandu"); 
    $date = date("d M Y h:i a");
  
  // create a logging message with php heredoc syntax
  $logging = <<<LOG
    <================== Start of Message ==============>\n
        ****** Login ******
    Date of Attempt: {$date}\n
    IP-Adress: {$user_ip} \n
    Host of Attempter: {$host}\n
    Point of Attempt: {$where}\n
    <================== End of Message =================>\n
LOG;    
    // open log file
  if($handle = fopen('../manager/logs/userlog.log', 'a')) {
  
    fputs($handle, $logging);  // write the Data to file
    fclose($handle);           // close the file
    
  } else {  // if first method is not working, for example because of wrong file permissions, email the data
  
    $to = 'pnc.edu.np';  
      $subject = 'LOGIN ATTEMPT';
      $header = 'From: pnc.edu.np';
      mail($to, $subject, $logging, $header);
  }
} 
$email = $password = "";
$email_err = $password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 $user_ip = getRealIp();
        if(empty(trim($_POST["email"]))){
        $email_err = "Please enter Email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
   
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    if(empty($email_err) && empty($password_err)){
        
        $sql = "SELECT user_id,fname,lname,email, password FROM useraccounts WHERE email = ? ";
        
        if($stmt = mysqli_prepare($conn, $sql)){
           
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = $email;
            if(mysqli_stmt_execute($stmt)){
 
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){

                    mysqli_stmt_bind_result($stmt, $id,$firstname, $email, $hashed_password,$file,$userRole);

                    if(mysqli_stmt_fetch($stmt)){
                      
                        if(password_verify($password, $hashed_password)){ 
                            $_SESSION["user_id"] = $id;
                            $_SESSION["user_firstname"] = $firstname;
                            $_SESSION["user_email"] = $email;
                            $_SESSION["user_file"] = $file;
                            $_SESSION["user_role"] = $userRole;
                            if(isset($_SESSION["user_email"])) {
                              if($_SESSION['user_role'] == "admin") {
                                if(!empty($_POST['remember'])){
                                  setcookie("email", $email, time()+(10 * 365 * 24 * 60 * 60));
                                  setcookie("password", $password, time()+(10 * 365 * 24 * 60 * 60));
                                  $_SESSION["email"] = $email; 
                                } else {
                                  if(isset($_COOKIE['email'])) {
                                    setcookie("email","");
                                  }
                                  if(isset($_COOKIE['password'])) {
                                    setcookie("password","");
                                  }
                                }                         
                            // query for insert user log in to data base
                            // mysqli_query($conn,"INSERT INTO userlog(user_id,user_email,user_ip,setValue) values('".$_SESSION['id']."','".$_SESSION['email']."','$user_ip','1')");
                            header("location:../manager/index.php");
                            writeLog("Successfully Logged In!!!!!!!");
                          } else if($_SESSION['user_role'] == "user") {
                              if(!empty($_POST['remember'])){
                                setcookie("email", $email, time()+(10 * 365 * 24 * 60 * 60));
                                setcookie("password", $password, time()+(10 * 365 * 24 * 60 * 60));
                                $_SESSION["email"] = $email; 
                              } else {
                                if(isset($_COOKIE['email'])) {
                                  setcookie("email","");
                                }
                                if(isset($_COOKIE['password'])) {
                                  setcookie("password","");
                                }
                              }                         
                            // query for insert user log in to data base
                            // mysqli_query($conn,"INSERT INTO userlog(user_id,user_email,user_ip,setValue) values('".$_SESSION['id']."','".$_SESSION['email']."','$user_ip','1')");
                            // header("location:../users/index.php");
                            // writeLog("Successfully Logged In!!!!!!!");
                          }
                        }
                        } else{
                            
                            writeLog($password_err = "The password you entered was not valid.");
                           // query for insert the login attempt
                          // mysqli_query($conn,"INSERT INTO userlog(user_id,user_email,user_ip,setValue) values('1111','someone else is trying to login !!!!','$user_ip','1')");
                        }
                    }
                } else{
                   
                    writeLog($email_err = "No account found with that username.");
                    // mysqli_query($conn,"INSERT INTO userlog(user_id,user_email,user_ip,setValue) values('1111','someone else is trying to login !!!!','$user_ip','1')");
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
                // mysqli_query($conn,"INSERT INTO userlog(user_id,user_email,user_ip,setValue) values('1111','someone else is trying to login !!!!','$user_ip','1')");
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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Prithivi Narayan Campus || Admin Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-danger">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-6 col-md-8">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-2">
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-1000 mb-4">Welcome Back !!!</h1>
                  </div>
                  <form class="user" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <div class="form-group">
                      <span class="alert-link alert-danger"> <?php echo "$email_err"; ?></span>
                      <input type="email" class="form-control form-control-user" name="email" value="<?php if(isset($_COOKIE['email'])) { echo $_COOKIE['email'];} ?>" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <span class="alert-link alert-danger"> <?php echo "$password_err"; ?></span>
                      <input type="password" id="password-field" class="form-control form-control-user" name="password" value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password'];} ?>" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" name="remember" <?php if(isset($_COOKIE['email'])) {?> checked <?php } ?> class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-user btn-block" name="submit">
                      Login
                    </button>
                    <hr>
                    <a href="index.php" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.php" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.php">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.php">Create an Account!</a>
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
