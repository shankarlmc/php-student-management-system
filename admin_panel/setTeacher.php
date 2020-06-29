
<?php include'includes/header.php'?>

<?php 
if(isset($_GET['delete']))
{
  $id = $_GET['id'];
  $result =mysqli_query($conn,"DELETE from staff_details where id= $id");
  echo "";
}
include"includes/config.php";
if(isset($_POST['submit'])){
$firstname = test_input($_POST['firstname']);
$lastname = test_input($_POST['lastname']);
$middlename = test_input($_POST['middlename']);
$paddress = test_input($_POST['paddress']);
$sex = test_input($_POST['gender']);
$dob = test_input($_POST['dob']);
$birthplace = test_input($_POST['birthplace']);
$nationality = test_input($_POST['nationality']);
$religion = test_input($_POST['religion']);
$contact = test_input($_POST['contact']);
$staff_role = test_input($_POST['staff_role']);
$maritalstatus = test_input($_POST['maritalstatus']);
$email = test_input($_POST['email']);
$subject = test_input($_POST['subject']);
  $filename = $_FILES['file']['name'];
    $errors= array();
    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['file']['tmp_name'];
    $size = $_FILES['file']['size'];
    // destination of the file on the server
    $destination = 'img/' . $filename;

    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    if(empty($firstname) || empty($lastname) || empty($paddress) || empty($dob) || empty($nationality) || empty($religion) || empty($contact) || empty($staff_role) || empty($email)){
         $errors[] = "The * field Should Not Be Empty !!!!!";
      }
    
      // get the file extension
    if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
        $errors[] = "You file extension must be .jpg, .jpeg or .png";
    } 
    if ($_FILES['file']['size'] > 10485760) { // file shouldn't be larger than 1000Megabyte
        $errors[] = "File too large!";
    } 
    if(empty($errors)==true) {
        // move the uploaded (temporary) file to the specified destination
        move_uploaded_file($file, $destination);
        $hashed_password = password_hash($firstname, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `staff_details`(`firstname`, `lastname`, `middlename`, `paddress`, `sex`, `dob`, `birthplace`, `nationality`, `religion`, `contact`, `staff_role`, `maritalstatus`, `subject`,`file`, `email`, `value`) VALUES ('$firstname', '$lastname', '$middlename', '$paddress', '$sex', '$dob', '$birthplace', '$nationality', '$religion', '$contact', '$staff_role', '$maritalstatus','$subject', '$filename', '$email',1)";
           if (mysqli_query($conn, $sql)) {
                echo "<br><h4><span class='alert alert-success' role='alert'>Staff Details Added successfully !!!!</span></h4><br>";
        } else{
            echo "Error" .$sql. "<br>" . mysqli_error($conn);
          }
        mysqli_close($conn);
    } else{
        echo ("<span class='alert alert-danger' role='alert'><h3>".$errors[0]."</h3></span><br>");
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
 ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row ">
    <div class="col-md-12">
      <div class="card shadow mb-4">
           <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="font-size:18px">List Of The Staffs <a href="#add_new_staff" class="btn btn-primary btn-sm rounded">  <i class="fa fa-plus-circle fw-fa"></i> New</a></h6>
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
                          <th>Contact No.</th>
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
                          <th>Contact No.</th>
                          <th>Subject</th>
                          <th>Action</th>
                    </tr>
                  </tfoot>
                  <?php 
                  include"includes/config.php";
                      $sql = "SELECT * FROM `staff_details`";
                      $result = mysqli_query($conn, $sql);
                      $staffs = mysqli_fetch_all($result, MYSQLI_ASSOC);

                     
                   ?>
                   <?php foreach ($staffs as $staff): ?>
                      <?php  
                      $date1 = date_create($staff['dob']);
                      $date2 = date_create('now');
                       $age = date_diff($date1,$date2)->y;
                       ?>
                       <tbody>
                      <tr>
                          <td><?php echo $staff['staff_id']; ?></td>
                          <td><?php echo $staff['lastname']; ?>,&nbsp;<?php echo $staff['firstname']; ?></td>
                          <td><?php echo $staff['sex']; ?></td>
                           <td><?php echo $age; ?></td>
                          <td><?php echo $staff['paddress']; ?></td>
                          <td><?php echo $staff['contact']; ?></td>
                         
                          <td><?php echo $staff['subject']; ?></td>
                          <td>&nbsp;&nbsp;<a href="viewdetails.php?id=<?php echo $staff['s_id']; ?>"  class="btn btn-primary btn-sm rounded" ><i class="fa fa-info-circle"></i> View</a>&nbsp;&nbsp;<a href="setTeacher.php?delete&&id=<?php echo $staff['s_id']; ?>"  class="btn btn-danger btn-sm rounded" >  <i class="fa fa-info-circle"></i> Delete</a></td>
                      </tr>
                      </tbody>
                       <?php endforeach; ?>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12" >
          <!-- Textarea  -->
       <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="form-horizontal well" method="post" >
  <div class="table-responsive">
     <div class="col-md-12 justify-content-between mb-4" id="add_new_staff"><h1 class="h1 mb-0 text-gray-1000">Add New Staff</h1></div> 
    
    <table class="table">
            <tr>
        <td><label>Firstname<span style="color:red">&nbsp;*</span></label></td>
        <td>
          <input required="true"  class="form-control input-md" id="firstname" name="firstname" placeholder="First Name" type="text">
        </td>
        <td><label>Lastname<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="2">
          <input required="true"  class="form-control input-md" id="lastname" name="lastname" placeholder="Last Name" type="text" >
        </td> 
        <td>
          <input class="form-control input-md" id="middlename" name="middlename" placeholder="Middle Name"  maxlength="10" type="text">
        </td>
      </tr>
      <tr>
        <td><label>Address<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="5"  >
        <input required="true"  class="form-control input-md" id="paddress" name="paddress" placeholder="Permanent Address" type="text">
        </td> 
      </tr>
      <tr>
        <td ><label>Sex<span style="color:red">&nbsp;*</span></label></td> 
        <td colspan="2">
          <label>
            <input checked id="optionsRadios1" name="gender" type="radio" value="Male"> Male
            <input id="optionsRadios2" name="gender" type="radio" value="Female"> Female
             <input id="optionsRadios3" name="gender" type="radio" value="Others"> Others
          </label>
        </td>
        <td ><label>Date of birth<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="2"> 
        <div class="input-group" >
                  <input  required="true" name="dob"  id="dob"  type="date" class="form-control input-md"  placeholder="mm/dd/yyyy"  data-inputmask="'alias': 'mm/dd/yyyy'" data-mask>
           </div>             
        </td>
         
      </tr>
      <tr><td><label>Place of Birth</label></td>
        <td colspan="5">
        <input class="form-control input-md" id="birthplace" name="birthplace" placeholder="Place of Birth " type="text">
         </td>
      </tr>
      <tr>
        <td><label>Nationality<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="2"><input class="form-control input-md" id="nationality" name="nationality" placeholder="Nationality " type="text">
              </td>
        <td><label>Religion<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="2"><input  class="form-control input-md" id="religion" name="religion" placeholder="Religion " type="text">
        </td>
        
      </tr>
      <tr>
      <td><label>Contact No.<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="2"><input class="form-control input-md" id="contact" name="contact" placeholder="Contact Number " type="text">
        </td>
        <td><label>Major Subject<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="2"><input class="form-control input-md" id="subject" name="subject" placeholder="Subject ..." type="text">
              </td>
        
      </tr>
      <tr>
      <td><label>Role<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="2">
          <select class="form-control input-sm" name="staff_role">
               <option selected class="text-white">----------Select Role--------</option>
              <option value="Administration">Administration</option>
              <option value="Teacher">Teacher</option>
              <option value="Student">Student</option>
            </select> 


        </td>
        
       
        <td><label>Marital Status</label></td>
        <td colspan="2">
          <select class="form-control input-sm" name="maritalstatus">
            <option selected class="text-white">-----------------Select----------------</option>
             <option value="Single">Single</option>
             <option value="Married">Married</option> 
          </select>
        </td>
      </tr>
      <tr>
        <td><label>Profile Picture<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="2">
          <input class="custume-file" id="biodata" name="file"  type="file">
        </td>
        <td><label>Email ID<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="2"><input  class="form-control input-md" id="Email" name="email" placeholder="abc@gmail.com" type="email"></td>
      </tr>
    </table><hr>
     <input class="btn btn-success btn-lg btn-block" name="submit" type="submit" value="Add Staff Details">
  </div><br>
</form>


      </div>
  </div>
</div>

  
    <?php include"includes/footer.php"; ?>