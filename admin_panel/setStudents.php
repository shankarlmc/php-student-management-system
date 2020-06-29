<?php include'includes/header.php';
if(isset($_GET['delete']))
{
  $id = $_GET['id'];
  $result =mysqli_query($conn,"UPDATE staff_details set  where id= $id");
  echo "";
}
include"includes/config.php";
if(isset($_POST['submit'])){
  $id = random_int(1000, 9999999999);
  $academic_year = test_input($_POST['academic_year']);
  $email = test_input($_POST['email']);
  $semester = test_input($_POST['semester']);
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
  $course = test_input($_POST['course']);
  $gname = test_input($_POST['gname']);
  $maritalstatus = test_input($_POST['maritalstatus']);
  $hashed_password = password_hash($firstname, PASSWORD_DEFAULT);
      if(empty($firstname) || empty($lastname) || empty($paddress) || empty($dob) || empty($nationality) || empty($religion) || empty($contact) || empty($course) || empty($email)){
           $errors[] = "The * field Should Not Be Empty !!!!!";
        }
      if(empty($errors)==true) {
          $sql = "INSERT INTO `student_details`(`student_id`, `email`,`semester`, `firstname`, `lastname`, `middlename`, `paddress`, `sex`, `dob`, `birthplace`, `nationality`, `religion`, `contact`, `maritalstatus`, `course_id`, `guardian_name`, `academic_year`) VALUES ('$id','$email','$semester','$firstname', '$lastname', '$middlename', '$paddress', '$sex', '$dob', '$birthplace', '$nationality', '$religion', '$contact','$maritalstatus', '$course','$gname', '$academic_year')";
          echo "$sql";
             if (mysqli_query($conn, $sql)) {
                 echo "<br><h4><span class='alert alert-success' role='alert'>Student Is Added successfully !!!!</span></h4><br>";
                   //student is also able to login
                  $studentAuth = mysqli_query($conn,"INSERT INTO student_acc (unique_id, username, email, password,value) VALUES('$id','$firstname','$email','$hashed_password','1')");
          } else{
              echo "Error" .$sql. "<br>" . mysqli_error($conn);
            }
          mysqli_close($conn);
      } else{
          echo ("<span class='text-danger' role='alert' align='center'><h3>".$errors[0]."</h3></span><br>");
      }
}
if(isset($_POST['update'])){
  $uniqueId =$_POST['uniqueId'];
  $id = test_input($_POST['id']);
  $academic_year = test_input($_POST['academic_year']);
  $email = test_input($_POST['email']);
  $semester = test_input($_POST['semester']);
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
  $course = test_input($_POST['course']);
  $gname = test_input($_POST['gname']);
  $maritalstatus = test_input($_POST['maritalstatus']);

      if(empty($firstname) || empty($lastname) || empty($paddress) || empty($dob) || empty($nationality) || empty($religion) || empty($contact) || empty($course) || empty($email)){
           $errors[] = "The * field Should Not Be Empty !!!!!";
        }
      if(empty($errors)==true) {
        $hashed_password = password_hash($firstname, PASSWORD_DEFAULT);
        $sql ="UPDATE `student_details` SET `student_id`='$uniqueId',`email`='$email',`semester`='$semester',`firstname`='$firstname',`lastname`='$lastname',`middlename`='$middlename',`paddress`='$paddress',`sex`='$sex',`dob`='$dob',`birthplace`='$birthplace',`nationality`='$nationality',`religion`='$religion',`contact`='$contact',`maritalstatus`='$maritalstatus',`course_id`='$course',`guardian_name`='$gname',`academic_year`='$academic_year' WHERE s_id = $id";
             if (mysqli_query($conn, $sql)) {
                  echo "<br><h4><span class='alert alert-success' role='alert'>Student Details Updated successfully !!!!</span></h4><br>";
          } else{
              echo "Error" .$sql. "<br>" . mysqli_error($conn);
            }
          mysqli_close($conn);
      } else{
          echo ("<span class='text-danger' role='alert' align='center'><h3>".$errors[0]."</h3></span><br>");
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
  <?php 
  // echo $_SESSION['staff_email'];
  //bin2hex(random_bytes(100));
  // random_int(min, max)
  // $token = bindec(random_bytes(10));
  // // $token = bindec(100);
  // // $token = random_int(1000, 2000000);
  // echo $token;

   ?>
  <div class="row ">
    <?php if(isset($_GET['View'])){ 
      include"includes/config.php";
          $id = $_GET['id'];
            $sql = "SELECT * FROM `student_details` s, `course` c WHERE s.course_id = c.course_id and s_id=$id";
            $result = mysqli_query($conn, $sql);
            $students = mysqli_fetch_all($result, MYSQLI_ASSOC);

      ?>
    <div class="col-md-12" >
        <!-- Textarea  -->
    <?php foreach ($students as $student): ?>
     <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="form-horizontal well" method="post" >
    <div class="table-responsive">
        
    <table class="table">
       <h1 class="h1 mb-0 text-primary text-center">View Details</h1><br>
        <tr>
        <td><label>Academic year</label></td>
        <td><input type="hidden" name="uniqueId" value="<?php echo $student['student_id']; ?>">
         <select class="form-control input-sm" name="academic_year" readonly>
         <option value="<?php echo $student['academic_year']; ?>"><?php echo $student['academic_year']; ?></option>
             
          </select>  </td>
          <td>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label>Course<span style="color:red">&nbsp;*</span></label></td>
        <td>
          <input type="hidden" name="s_id" value="<?php echo $id; ?>">
         <select class="form-control input-sm" name="course" readonly>
         <option value="<?php echo $student['course_id']; ?>"><?php echo $student['course_name']; ?></option>
             
          </select> 


        </td>
        
        <td><label>Semester<span style="color:red">&nbsp;*</span></label></td>
        <td>
          <select class="form-control input-sm" name="semester" readonly="true">
            <option selected class="text-white" value="<?php echo $student['semester']; ?>"><?php echo $student['semester']; ?></option>
             <?php 
                  include "includes/config.php";
                  $sql = "SELECT * FROM semester";
                  $result = mysqli_query($conn, $sql);
                  if(mysqli_num_rows($result)>0) {
                    while($row=mysqli_fetch_array($result)) {
                     $semester = $row['semester'];
                      ?>
        <option value="<?php echo"$semester";?>"><?php echo "$semester"; ?></option>
        <?php 
      }
    }else{
      echo "";
    }
         ?>
          </select>
        </td>
      </tr>
        <tr>
        <td><label>Firstname<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="2">
          <input readonly="true" required="true" class="form-control input-md" id="firstname" name="firstname" placeholder="First Name" type="text"value="<?php echo $student['firstname']; ?>">
        </td>
        <td>
          <input readonly="true" required="true" class="form-control input-md" id="middlename" name="middlename" placeholder="" type="text"value="<?php echo $student['middlename']; ?>">
        </td>
        <td><label>Lastname<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="2">
          <input readonly="true" required="true" class="form-control input-md" id="lastname" name="lastname" placeholder="First Name" type="text"value="<?php echo $student['lastname']; ?>">
        </td> 
      </tr>
      <tr>
        <td><label>Address<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="5"  >
        <input required="true" value="<?php echo $student['paddress']; ?>" class="form-control input-md" id="paddress" name="paddress" placeholder="Permanent Address" type="text">
        </td> 
      </tr>
      </tr>
      <tr>
        <td ><label>Sex<span style="color:red">&nbsp;*</span></label></td> 
        <td colspan="2">
          <label>
            <?php
            if ($student['sex']=='Male') {
              # code...
              echo '<input checked id="gender1" name="gender" type="radio"  CHECKED="true"  value="Male"> Male
              <input id="gender2" name="gender" type="radio"   value="Female">Female
              <input id="gender3" name="gender" type="radio"   value="Other">Others' ;
            }else if($student['sex']=='Female'){
                 echo '<input id="gender1" name="gender" type="radio"  CHECKED="true"  value="Male"> Male
              <input checked id="gender2" name="gender" type="radio"   value="Female">Female
              <input id="gender3" name="gender" type="radio"   value="Other">Others';
            } else {
                 echo '<input id="gender1" name="gender" type="radio"  CHECKED="true"  value="Male"> Male
              <input id="gender2" name="gender" type="radio"   value="Female">Female
              <input checked id="gender3" name="gender" type="radio"   value="Other">Others';
            }
          ?>
          </label>
        </td>
        <td ><label>Date of birth<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="2"> 
        <div class="input-group" >
          <input  required="true" name="dob"  id="dob"  type="date" class="form-control input-md"  placeholder="mm/dd/yyyy"  data-inputmask="'alias': 'mm/dd/yyyy'" data-mask value="<?php echo $student['dob']; ?>">
           </div>             
        </td>
         
      </tr>
      <tr><td><label>Place of Birth</label></td>
        <td colspan="5">
        <input class="form-control input-md" id="birthplace" value="<?php echo $student['birthplace']; ?>"name="birthplace" placeholder="Place of Birth " type="text">
         </td>
      </tr>
      <tr>
        <td><label>Nationality</label></td>
        <td colspan="2"><input class="form-control input-md" id="nationality"value="<?php echo $student['nationality']; ?>" name="nationality" placeholder="Nationality " type="text">
              </td>
        <td><label>Religion</label></td>
        <td colspan="2"><input value="<?php echo $student['religion']; ?>" class="form-control input-md" id="religion" name="religion" placeholder="Religion " type="text">
        </td>
        
      </tr>
      <tr>
      <td><label>Contact No.<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="2"><input value="<?php echo $student['contact']; ?>" class="form-control input-md" id="contact" name="contact" placeholder="Contact Number " type="text">
              </td>
              <td><label>Guardian Name:</label></td>
        <td colspan="2">
          <input required="true" value="<?php echo $student['guardian_name']; ?>" class="form-control input-md" id="gname" name="gname" placeholder="Guardian Name" type="text" >
        </td> 
      </tr>
      <tr>
        <td><label>Email ID<span style="color:red">&nbsp;*</span></label></td>
        <td  colspan="1"><input required="true" class="form-control input-md" id="Email" name="email" placeholder="abc@gmail.com" type="email" value="<?php echo $student['email']; ?>"></td>
        <td><label>Marital Status</label></td>
        <td>
           <select class="form-control input-sm" name="maritalstatus">
            <option selected class="text-white" value="<?php echo $student['maritalstatus']; ?>"><?php echo $student['maritalstatus']; ?></option>
             <option value="Single">Single</option>
             <option value="Married">Married</option> 
             <option value="Widow">Widow</option>
          </select>
        </td>
        <td><label>Profile Pic<span style="color:red">&nbsp;*</span></label></td>
        <td  colspan="1"><input required="true" id="file" name="file" placeholder="abc@gmail.com" type="file"></td>
      </tr>
      
    </table><hr>
     <input class="btn btn-success btn-lg btn-block" name="update" type="submit" value="Update Student Information">
  </div><br>
    </form>
  <?php endforeach; ?>
    </div>

    <?php } ?>
    <!-- add new student -->
    <div class="col-md-12">
      <div class="card shadow mb-4">
           <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" style="font-size:18px">List Of The Students <a href="setStudents.php?AddNewStudent" class="btn btn-primary btn-sm rounded">  <i class="fa fa-plus-circle fw-fa"></i> New</a></h6>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>SN.</th>
                          <th>Name</th>
                          <th>Gender</th>
                          <th>Age</th>
                          <th>Address</th>
                          <th>Contact No.</th>
                          <th>Course</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tfoot>
                    <tr>
                          <th>SN.</th>
                          <th>Name</th>
                          <th>Gender</th>
                          <th>Age</th>
                          <th>Address</th>
                          <th>Contact No.</th>
                          <th>Course</th>
                          <th>Action</th>
                    </tr>
                  </tfoot>
                  <?php 
                  include"includes/config.php";
                      $sql = "SELECT * FROM student_details as s, course as c where s.course_id=c.course_id";
                      $result = mysqli_query($conn, $sql);
                      $students = mysqli_fetch_all($result, MYSQLI_ASSOC);

                     
                   ?>
                   <?php foreach ($students as $student): ?>
                      <?php  
                      $count = 0;
                      $count++;
                      $date1 = date_create($student['dob']);
                      $date2 = date_create('now');
                       $age = date_diff($date1,$date2)->y;
                       ?>
                       <tbody>
                      <tr>
                          <td><?php echo $count; ?></td>
                          <td><?php echo $student['lastname']; ?>,&nbsp;<?php echo $student['firstname']; ?></td>
                          <td><?php echo $student['sex']; ?></td>
                           <td><?php echo $age; ?></td>
                          <td><?php echo $student['paddress']; ?></td>
                          <td><?php echo $student['contact']; ?></td>
                         
                          <td><?php echo $student['course_name']; ?></td>
                          <td>&nbsp;&nbsp;<a href="setStudents.php?View&&id=<?php echo $student['s_id']; ?>"  class="btn btn-primary btn-sm rounded" ><i class="fa fa-info-circle"></i> View</a>&nbsp;&nbsp;<a href="setStudents.php?delete&&id=<?php echo $student['s_id']; ?>"  class="btn btn-danger btn-sm rounded" >  <i class="fa fa-info-circle"></i> Delete</a></td>
                      </tr>
                      </tbody>
                       <?php endforeach; ?>
              </table>
            </div>
          </div>
        </div>
      </div>
      <?php if(isset($_GET['AddNewStudent'])) { ?>
        <div class="col-md-12">
       <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="form-horizontal well" method="post" >
  <div class="table-responsive">
        
    <table class="table">
       <h1 class="h1 mb-0 text-primary text-center">Add New Student</h1><br>
        <tr>
        <td><label>Academic year</label></td>
        <td><select class="form-control input-sm" name="academic_year">
         <option selected class="text-white">---------Select---------</option>
             <?php 
                  include "includes/config.php";
                  $sql = "SELECT * FROM academic_year limit 2";
                  $result = mysqli_query($conn, $sql);
                  if(mysqli_num_rows($result)>0) {
                    while($row=mysqli_fetch_array($result)) {
                     $academic_year = $row['academic_year'];
                      ?>
        <option value="<?php echo"$academic_year";?>"><?php echo "$academic_year"; ?></option>
        <?php 
      }
    }else{
      echo "";
    }
         ?>
          </select> </td>
          <td><label>Course<span style="color:red">&nbsp;*</span></label></td>
        <td>
          <select class="form-control input-sm" name="course">
               <option selected class="text-white">----------Select Course--------</option>
          <?php 
                  include "includes/config.php";
                  $sql = "SELECT * FROM course";
                  $result = mysqli_query($conn, $sql);
                  if(mysqli_num_rows($result)>0) {
                    while($row=mysqli_fetch_array($result)) {
                     $course_id = $row['course_id'];
                     $course_name = $row['course_name'];
                      ?>
        <option value="<?php echo"$course_id";?>"><?php echo "$course_name"; ?></option>
        <?php 
      }
    }else{
      echo "";
    }
         ?>
            </select> 


        </td>
        
        <td><label>Semester<span style="color:red">&nbsp;*</span></label></td>
        <td>
          <select class="form-control input-sm" name="semester">
            <option selected class="text-white">--------Select Semester---------</option>
             <?php 
                  include "includes/config.php";
                  $sql = "SELECT * FROM semester";
                  $result = mysqli_query($conn, $sql);
                  if(mysqli_num_rows($result)>0) {
                    while($row=mysqli_fetch_array($result)) {
                     $semester = $row['semester'];
                      ?>
        <option value="<?php echo"$semester";?>"><?php echo "$semester"; ?></option>
        <?php 
      }
    }else{
      echo "";
    }
         ?> 
          </select>
        </td>
      </tr>
        <tr>
        <td><label>Firstname<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="2">
          <input required="true" class="form-control input-md" id="firstname" name="firstname" placeholder="First Name" type="text">
        </td>
        <td>
          <input class="form-control input-md" id="middlename" name="middlename" placeholder="Middle Name"  maxlength="10" type="text">
        </td>
        <td><label>Lastname<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="2">
          <input required="true"  class="form-control input-md" id="lastname" name="lastname" placeholder="Last Name" type="text" >
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
              <td><label>Guardian Name:<span style="color:red">&nbsp;*</span></label></td>
        <td colspan="2">
          <input required="true"  class="form-control input-md" id="gname" name="gname" placeholder="Guardian Name" type="text" >
        </td> 
        
      </tr>
      <tr>
        <td><label>Email ID<span style="color:red">&nbsp;*</span></label></td>
        <td  colspan="1"><input required="true" class="form-control input-md" id="Email" name="email" placeholder="abc@gmail.com" type="email"></td>
        <td><label>Marital Status</label></td>
        <td>
          <select class="form-control input-sm" name="maritalstatus">
            <option selected class="text-white">-----------------Select----------------</option>
             <option value="Single">Single</option>
             <option value="Married">Married</option> 
          </select>
        </td>
        <td><label>Profile Pic<span style="color:red">&nbsp;*</span></label></td>
        <td  colspan="1"><input required="true" id="file" name="file" placeholder="abc@gmail.com" type="file"></td>
      </tr>
      
    </table><hr>
     <input class="btn btn-success btn-lg btn-block" name="submit" type="submit" value="Add New Student">
  </div><br>
</form>


      </div>
    <?php }  ?>

  </div>
</div>

  
    <?php include"includes/footer.php"; ?>