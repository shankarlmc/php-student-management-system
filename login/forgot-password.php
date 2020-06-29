<?php  
session_start();
$errors = [];

// connect to database
include"../manager/includes/config.php";
if (isset($_POST['reset-password'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  // ensure that the user exists on our system
  $query = "SELECT email FROM admin WHERE email='$email' and setVal='1'";
  $results = mysqli_query($conn, $query);

  if (empty($email)) {
    array_push($errors, "Your email is required");
  }else if(mysqli_num_rows($results) <= 0) {
    array_push($errors, "Sorry, no user exists on our system with that email");
  }
  // generate a unique random token of length 100
  $token = bin2hex(random_bytes(50));
  if (count($errors) == 0) {
    // store token in the password-reset database table against the user's email
    $sql = "INSERT INTO password_resets (email, token) VALUES ('$email', '$token')";
    $results = mysqli_query($conn, $sql);

    // Send email to user with the token in a link they can click on
    $to = $email;
    $emailFrom = 'pnc.edu.np';
    $subject = "Reset your password on pnc.edu.np";
    $msg = "Hi there, click on this link: https://pnc.edu.np/admin_panel/new_password.php?token=$token  to reset your password on our site";
    $msg = wordwrap($msg,200);
    $header = "From: $emailFrom";
    $header .= "Reply-To: ".$emailFrom."\r\n";
    $header .= "Content-type:text/html; charset=UTF-8\r\n";
    @mail($to, $subject, $msg, $header);
    header('location: pending.php?email=' . $email);
  }
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

    <title>Admin_panel || Forget Password </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-info">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-6 col-md-8">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                                    </div>
                                    
                                    <form class="user" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                                        <?php  if (count($errors) > 0) : ?>
                                  <div class="msg" style="margin: 5px auto;border-radius: 5px;border: 1px solid red;background: pink;text-align: left;color: brown;padding: 10px;">
                                    <?php foreach ($errors as $error) : ?>
                                      <span><?php echo $error ?></span>
                                    <?php endforeach ?>
                                  </div>
                                <?php  endif ?>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" autocomplete="off">
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" name="reset-password">Reset Password</button>
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