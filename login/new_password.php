<?php 
session_start();
$new_pass = $new_pass_c = "";
$password_err = $confirm_password_err = "";
// connect to database
include"../manager/includes/config.php";
// ENTER A NEW PASSWORD
if($_SERVER['REQUEST_METHOD'] == "POST"){
      $token = $_POST['token'];

    if(empty(trim($_POST["new_pass"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["new_pass"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $new_pass = trim($_POST["new_pass"]);
    }
    if(empty(trim($_POST["new_pass_c"]))){
        $confirm_password_err = "Please confirm password."; 
    } else{
        $new_pass_c = trim($_POST["new_pass_c"]);
        if(empty($password_err) && ($new_pass != $new_pass_c)){
            $confirm_password_err = "Password did not match.";
        }
    }
    if(empty($password_err) && empty($confirm_password_err)){
    // select email address of user from the password_reset table 
    $sql = "SELECT email FROM password_resets WHERE token='$token' LIMIT 1";
    $data = mysqli_query($conn, $sql);
    $email = mysqli_fetch_assoc($data)['email'];
    if ($email) {
      $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
      $sql = "UPDATE admin SET password='$new_pass' WHERE email='$email'";
      $results = mysqli_query($conn, $sql);

      echo "<script>alert('Password Changed Successfully')</script>";
      header('location: login.php');
    }
    mysqli_close($conn);
  }

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

    <title>Admin_panel || New Password Set Up</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Please Enter Your New Password</h1>
                                    </div>
                                    <form class="user" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                                        <?php 
                                              include "../admin_panel/includes/config.php";
                                            if (isset($_GET['token'])) {
                                                $token = $_GET['token'];
                                            } else {
                                                $token = 1;
                                            }
                                            $sql = "SELECT * FROM password_resets where token = '$token' LIMIT 1";
                                            $result = mysqli_query($conn, $sql);
                                            // fetch all posts from database
                                            // return them as an associative array called $posts
                                            $resets = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                            ?>
                                            <?php foreach ($resets as $reset): ?>
                                                <input type="hidden" name="token" value="<?php echo $reset['token']; ?>">
                                            <?php endforeach ?>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="new_pass" placeholder="Enter Your New Password.." value="<?php echo "$new_pass"; ?>">
                                             <span class="alert-link alert-danger"><?php echo "$password_err"; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="new_pass_c" aria-describedby="emailHelp" placeholder="Confirm Your Password...." value="<?php echo "$new_pass_c"; ?>">
                                            <span class="alert-link alert-danger"><?php echo "$confirm_password_err"; ?></span>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" name="new_password">Submit</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
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