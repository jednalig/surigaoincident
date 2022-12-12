<?php
include 'db_connect.php';
?>
<style>
	    td, td img.normal, img.fullsize.normal {
			height: 100px;
			 max-height: 1100px;
			  width: 100px;
			   max-width: 1100px;
			}
    td {
		position: relative;
	}
    img.fullsize {
		position: absolute;
		 top: 0; left: 0; 
		 z-index: 100;
		  height:auto; 
		  max-height: auto; 
		  width: auto;
		   max-width: auto;
		   }
</style>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<b>List of Reports of Complaints</b>
			</div>
			<div class="card-body">
				<table class="table table-bordered table-hover" id="complaint-tbl">
			        <thead>
			          <tr>
			            <th >Date</th>
			            <th >Reported By</th>
						<th>Contact</th>
						<th>Report</th>
						
			            <th>Incident Address</th>
						<th>Image</th>
			            <th>Status</th>
			            <th width="20%">Action</th>
			          </tr>
			        </thead>
			        <tbody>
			          <?php
			          $status = array("","Pending","Received","Action Made");
			          $qry = $conn->query("SELECT * FROM complaints order by unix_timestamp(date_created) desc ");
			          while($row = $qry->fetch_array()):
			          ?>
			          <tr class="<?php echo $row['status'] == 1 ? 'border-alert' : '' ?>">
			            <td><?php echo date('M d, Y h:i A',strtotime($row['date_created'])) ?></td>
						<td><?php echo $row['complainant_id'] ?></td>
						<td><?php echo $row['contact'] ?></td>
			            <td><?php echo $row['message'] ?></td>
			            <td><?php echo $row['address'] ?></td>
						
						<td><img style="width: 100px; hieght: 70px;" src="../uploads/<?php echo $row['image'] ?>" ?></td>
			            <td><?php echo $status[$row['status']] ?></td>
			            <td class="text-center">
			            	<button class="btn btn-primary btn-sm m-0 view_btn" type="button" data-id="<?php echo $row['id'] ?>">View</button>
							<button class="btn btn-secondary  view_btn2" type="button" data-id="<?php echo $row['id'] ?>">Send SMS</button>
			           
						</td>
			          </tr>
			        <?php endwhile; ?>
			        </tbody>
			  </table>
			</div>
		</div>
	</div>
</div>
<style>
	
	.border-gradien-alert{
		border-image: linear-gradient(to right, red , yellow) !important;
	}
	.border-alert th, 
	.border-alert td {
	  animation: blink 200ms infinite alternate;
	}

	@keyframes blink {
	  from {
	    border-color: white;
	  }
	  to {
	    border-color: red;
		background: #ff00002b;
	  }
	}
</style>
<script>
	$('#complaint-tbl').dataTable();
	$('.view_btn').click(function(){
		uni_modal("View Details","manage_complaint.php?id="+$(this).attr('data-id'),"mid-large")
		error_reporting(0);
	})
	$('.view_btn2').click(function(){
		uni_modal2("View Details","message.php?id="+$(this).attr('data-id'),"mid-large")
		error_reporting(0);
	})
	$(document).ready(function(){
    $("img").click(function(){
        $(this).toggleClass("normal");
    });
});
</script>