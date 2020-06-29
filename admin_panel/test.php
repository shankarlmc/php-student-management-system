<?php include'includes/header.php';?>

<?php

include'includes/config.php';

if (isset($_POST['submit'])) {
   //variable dec
  $fname =test_input($_POST['firstname']);
  $lname =test_input($_POST['lastname']);
    $mname =test_input($_POST['middlename']);
    $address=test_input($_POST['paddress']);
    $gender=test_input($_POST['sex']);
    $dob= test_input($_POST['dob']);
    $placeofbirth= test_input($_POST['birthplace']);
    $nationality= test_input($_POST['nationality']);
    $religion= test_input($_POST['religion']);
    $contact= test_input($_POST['contact']);
    $majorsub=test_input($_POST['subject']);
    $role= test_input($_POST['staff_role']);
    $maritalstatus= test_input($_POST['maritalstatus']);
    $filename=$_FILES['file']['name'];
    $filetmp_name =$_FILES['file']['tmp_name'];
    $size=$_FILES['file']['size'];
      // destination of the file on the server
      $destination = 'img/'. $filename;
      $extension = pathinfo($filename, PATHINFO_EXTENSION);
      $email=test_input($_POST['email']);
    $errors= array();

    if(empty($fname)){
         $errors[] = "Firstname Should Not Be Empty !!!!!";
      } 
    if(empty($lname)){
         $errors[] = "Lastname Should Not Be Empty !!!!!";
      }
      if(empty($mname)){
         $errors[] = "Middlename Should Not Be Empty !!!!!";
      }
      if(empty($address)){
         $errors[] = "Address Should Not Be Empty !!!!!";
      }
      if(empty($gender)){
         $errors[] = "Gender Should Not Be Empty !!!!!";
      }
      if(empty($dob)){
         $errors[] = "Date of Birth Should Not Be Empty !!!!!";
      }
      if(empty($placeofbirth)){
         $errors[] = "Birthplace Should Not Be Empty !!!!!";
      }
      if(empty($nationality)){
         $errors[] = "Nationality Should Not Be Empty !!!!!";
      }
      if(empty($religion)){
         $errors[] = "Religion Should Not Be Empty !!!!!";
      }
      if(empty($contact)){
         $errors[] = "Contact Should Not Be Empty !!!!!";
      }
      if(empty($majorsub)){
         $errors[] = "Major subject Should Not Be Empty !!!!!";
      }
      if(empty($role)){
         $errors[] = "staff role Should Not Be Empty !!!!!";
      }
      if(empty($maritalstatus)){
         $errors[] = "Marital status Should Not Be Empty !!!!!";
      }
      if(empty($email)){
         $errors[] = "Email id  Should Not Be Empty !!!!!";
      }
  if(empty($filename)){
         $errors[] = "File Should Not Be Empty !!!!!";
      }
      // get the file extension
    if (!in_array($extension, ['jpg','jpeg','png'])) {
        $errors[] = "You file extension must be .jpg, .jpeg, .png format";
    } 
    if ($_FILES['file']['size'] > 10485760) { // file shouldn't be larger than 100Megabyte
        $errors[] = "File too large!";
    } 
    if(empty($errors)==true) {
        // move the uploaded (temporary) file to the specified dest
    move_uploaded_file($filetmp_name, $destination);
    $result = mysqli_query($conn,"INSERT into staff_details (firstname,lastname,middlename,paddress,sex,dob,birthplace,nationality,religion,contact,subject,staff_role,maritalstatus,file,email,value) VALUES ('$fname','$lname','$mname','$address','$gender','$dob','$placeofbirth','$nationality','$religion','$contact','$majorsub','$role','$maritalstatus','$filename','$email','1')");
    
      echo "Inserted";
 }
    else{
     echo ("<h4><span class='alert alert-danger'>".$errors[0]."</span></h4><br>");
    }
}
  
 function test_input($data) {
    global $conn;
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = mysqli_real_escape_string($conn,$data);
  return $data;
}
mysqli_close($conn);

?>
  
<div class="container-fluid">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
       <h6 class="m-0 font-weight-bold text-primary" style="font-size:18px">List Of Staffs </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Gender</th>
              <th>Age</th>
              <th>Address</th>
              <th>Contact no.</th>
              <th>Subject</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Gender</th>
              <th>Age</th>
              <th>Address</th>
              <th>Contact no.</th>
              <th>Subject</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <?php 
          include"includes/config.php";
            $sql = "SELECT * FROM staff_details where value=1";
            $result = mysqli_query($conn, $sql);
            $staffdetails = mysqli_fetch_all($result, MYSQLI_ASSOC);
           
          
         ?>
         <?php foreach ($staffdetails as $staffdetails): ?>
            <?php  
                $date1 = date_create($staffdetails['dob']);
                $date2 = date_create('now');
                 $age = date_diff($date1,$date2)->y;
                 ?>

          <tbody>
            <tr>
                <td><?php echo $staffdetails['staff_id']; ?></td>
                <td><?php echo $staffdetails['firstname'] . $staffdetails['lastname']; ?></td>
                <td><?php echo $staffdetails['sex']; ?></td>
                <td><?php echo $age; ?></td>
                <td><?php echo $staffdetails['paddress']; ?></td>
                <td><?php echo $staffdetails['contact']; ?></td>
                <td><?php echo $staffdetails['subject']; ?></td>
                <td><a href="setDepartment.php?id=<?php echo $department['dept_id']; ?>"  class="btn btn-primary btn-sm rounded" ><i class="fa fa-info-circle"></i> View</a>&nbsp;&nbsp;<a href="setDepartment.php?delete=true&&id=<?php echo $department['dept_id']; ?>"  class="btn btn-danger btn-sm rounded" >  <i class="fa fa-info-circle"></i> Delete</a></td>
            </tr>
            </tbody>
        <?php endforeach; ?>
        </table>
      </div>
    </div>
  </div>
</div>      
</div>

<div class="container-fluid">
  <div  class="card shadow mb-4" style="padding: 7px;">

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
      <h3 style="text-align: center;" >Add New Staff</h3><hr>
      <div class="form-inline">
        <div class="form-group">
          <label class="col-md-4" for="firstname">Firstname: </label>
          <input type="text" name="firstname" required>
        </div>
        <div class="form-group">
          <label class="col-md-4" for="lastname">Lastname: </label>
          <input type="text" name="lastname" required>
        </div>
        <div class="form-group">
          <label class="col-md-4" for="middlename">Middlename: </label>
          <input type="text" name="middlename">
        </div>
      </div>
      <hr>
      <div class="form-group">
        <label for="address"> Address:  </label>
        <input type="text" name="paddress" placeholder="Permanent address" style=" width:83%; " required>
      </div>
      <hr>
      <div class="form-inline">
        <div class="form-group col-md-6">
          <label for="sex">Gender:  </label>
          <label class="radio-inline"><input type="radio" name="sex" value="Male" > Male </label>
          <label class="radio-inline"><input type="radio"  name="sex" value="Female"> Female </label>
          <label class="radio-inline"><input type="radio"  name="sex" value="Other"> Other </label>
        </div>
        <div class="form-group col-md-6">
          <label for="dob">Date of Birth:  </label>
          <input type="date" name="dob" placeholder="mm/dd/yyyy" style="width: 50%;" required>
        </div>
      </div>
      <hr>
      <div class="form-group">
        <label for="placeofbirth">Place of Birth:  </label>
        <input type="text" name="birthplace" placeholder="Place of birth" style="width: 83%;" required>
      </div>
      <hr>
      <div class="form-inline">
        <div class="form-group col-md-6">
          <label for="nationality">Nationality:  </label>
          <input type="text" name="nationality" placeholder="Nationality" required>
        </div>
        <div class="form-group col-md-6">
          <label for="religion"> Religion:  </label>
          <input type="text" name="religion" placeholder="Religion" required>
        </div>
      </div>
      <hr>
      <div class="form-inline">
        <div class="form-group col-md-6">
          <label for="contact"> Contact No.:  </label>
          <input type="text" name="contact" placeholder="Contact number" required>
        </div>
        <div class="form-group col-md-6">
          <label for="subject"> Major Subject:  </label>
          <input type="text" name="subject" placeholder="Subject" required>
        </div>
      </div>
      <hr>
      <div class="form-inline">
        <div class="form-group col-md-6">
          <label for="staff_role">Role:  </label>
          <select name="staff_role" required>
            <option>------Select Role----------</option>
            <option>Administration</option>
            <option>Teacher</option>
            <option>Student</option>

          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="maritalstatus"> Marital Status:  </label>
          <select name="maritalstatus">
            <option>-----------Select-------</option>
            <option>Single</option>
            <option>Married</option>
          </select>
        </div>
      </div>
      <hr>
      <div class="form-inline">
        <div class="form-group col-md-6">
          <label for="file"> Profile picture:  </label>
          <input type="file" name="file" required>
        </div>
        <div class="form-group col-md-6">
          <label for="email"> Email ID:  </label>
          <input type="email" name="email" placeholder="abc@gmail.com" required>
        </div>
      </div>
      <hr>
      
      <input type="submit" value="Add Staff Details" name="submit" class="btn btn-success btn-lg btn-block">
  
    </form>
    
  </div>
</div>

<?php include'includes/footer.php' ?>