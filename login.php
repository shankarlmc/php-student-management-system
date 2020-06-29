<div class="container">
  <div class="row">
     <div class="col-md-3"></div>
     <!-- start content --> 
     <?php 
      $page = isset($_GET['page']) ? $_GET['page'] :"";

     if($page == "studentLogin"){ ?>
    <div class="col-md-6">
    <div class="panel panel-default" >
    <div class="panel-body">
        <div class="well well-sm text-center"  style="background-color: rgb(78, 115, 223);background-image: linear-gradient(30deg,#f70202 10%,#2e1897 100%);color:#fff;"><b > login As Student </b> </div>
            <form class="form-horizontal span6" method="POST">
              <span class="alert-link alert-danger"> <?php global $username_err; echo "$username_err"; ?></span>
              <span class="alert-link alert-danger"> <?php global $password_err; echo "$password_err"; ?></span>
                <div class="form-group">
                  <div class="col-md-12">
                    <label class="control-label" for=
                    "username">Username:</label> 
                          <input   id="username" name="username" placeholder="Username" type="text" class="form-control input" >  
                  </div> 
 
                  <div class="col-md-12">
                    <label class="control-label" for=
                    "password_err">Password:</label> 
                     <input name="password" id="password_err" placeholder="Password" type="password" class="form-control input ">
             
                  </div> 
                  </div>
                  <div class="form-group">
                  <div class="col-md-12 text-center"> 
                    <button type="submit" id="studentLogin" name="studentLogin"  style="background-color: rgb(78, 115, 223);background-image: linear-gradient(30deg,#f70202 10%,#2e1897 100%);color:#fff;" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-logged-in "></span> Login</button> 
                    <a href="<?php echo 'index.php?page=studentSignup'; ?>" class="btn btn-warning btn-md" style="background-color: rgb(78, 115, 223);background-image: linear-gradient(30deg,#f70202 10%,#2e1897 100%);color:#fff;">SignUp</a>
                  </div>
                </div>
            </form>
        </div>
        </div>
        </div>
      <?php } else if($page == "staffLogin"){ ?>
        <!-- End content --> 
         <div class="col-md-6">
           <div class="panel panel-default" >
        <div class="panel-body">
        <div class="well well-sm text-center"  style="background-color: rgb(78, 115, 223);background-image: linear-gradient(30deg,#f70202 10%,#2e1897 100%);color:#fff;"><b > login As Staff </b> </div>
            <form class="form-horizontal span6" action="" method="POST">
              <span class="alert-link alert-danger"> <?php global $username_err; echo "$username_err"; ?></span>
              <span class="alert-link alert-danger"> <?php global $password_err; echo "$password_err"; ?></span>
                <div class="form-group">
                  <div class="col-md-12">
                    <label class="control-label" for=
                    "username">Username:</label> 
                          <input   id="username" name="username" placeholder="Username" type="text" class="form-control" >  
                  </div> 
                  <div class="col-md-12">
                    <label class="control-label" for=
                    "password_err">Password:</label> 
                     <input name="password" id="password_err" placeholder="Password" type="password" class="form-control input ">
                  </div> 
                  </div>
                  <div class="form-group">
                  <div class="col-md-12 text-center"> 
                    <button type="submit" id="sidebarLogin" name="teacherLogin"  style="background-color: rgb(78, 115, 223);background-image: linear-gradient(30deg,#f70202 10%,#2e1897 100%);color:#fff;" class="btn btn-primary btn-md "><span class="glyphicon glyphicon-logged-in "></span> Login</button> 
                    <a href="<?php echo 'index.php?page=staffSignup'; ?>" class="btn btn-warning btn-md" style="background-color: rgb(78, 115, 223);background-image: linear-gradient(30deg,#f70202 10%,#2e1897 100%);color:#fff;">SignUp</a>
                  </div>
                </div>
            </form>
        </div>
        </div>
         </div>
       <?php } ?>
</div>
</div>
  