<?php include"includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="row ">
    <div class="col-md-12">
    	<div class="card">
			<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary" style="font-size:18px">News Table</h6>
			</div>
			<div class="card-body">
			<div class="table-responsive">
			<table id="dataTable" class="table table-striped table-bordered">
			    <thead>
			    	<tr>
			            <th>SN.</th>
			            <th>Title</th>
			            <th>Content</th>
			            <th>Semester</th>
			            <th>Date</th>
			            <th>Edit</th>
			            <th>Delete</th>
			        </tr>
			    </thead>
			    <tfoot>
			      <tr>
			            <th>SN.</th>
			            <th>Title</th>
			            <th>Content</th>
			            <th>Semester</th>
			            <th>Date</th>
			            <th width="70px">Edit</th>
			            <th width="80px">Delete</th>
			        </tr>
			    </tfoot>
			    <?php 
			      include"includes/config.php";
			        $sql = "SELECT * FROM `news_table` WHERE value=1";
			        $result = mysqli_query($conn, $sql);
			        if(mysqli_num_rows($result)>0) {
			      while($row=mysqli_fetch_array($result)) {
			      	$id = $row['news_id'];
			            // $count = 0;
			            // $count++;
			            $title = $row['title'];
			            $content = $row['content'];
			            if (strlen($content) > 50) {
                                         $stringCut = substr($content, 0, 50);
                                         $endPoint = strrpos($stringCut, '');
                                         $content = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);

                    $content .= "...
                <a style='cursor: pointer;' href=''> Read More</a>";
                    }
			            $semester = $row['semester'];
			            $date = $row['date'];

			        ?>
			        <tbody>
			        <tr>
			            
			            <td><?php echo "$id"; ?></td>
			            <td><?php echo "$title"; ?></td>
			            <td><?php echo "$content"; ?></td>
			            <td><?php echo "$semester"; ?></td>
			            <td><?php echo date_format(date_create($date),'M d'); ?></td>
			            <td><a href="addNews.php?EditNews&&id=<?php echo $id; ?>" class="btn btn-primary btn-sm rounded" ><i class="fa fa-info-circle"></i> Edit</a></td>
			            <td><a href="newsTable.php?delete=true&&id=<?php echo $id;?>"class="btn btn-danger btn-sm rounded" > <i class="fa fa-info-circle"></i> Delete</a></td>
			        </tr>
			        </tbody>
			    <?php 
			      }
			    }
			     ?>
			</table>
			</div>
			</div>
			</div>
			</div>

			</div>
			</div>



<?php include"includes/footer.php"; ?>