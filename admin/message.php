<?php include 'db_connect.php' ?>
<style>
	.btn{
		background-color: blue;
	}
</style>
<?php
error_reporting(E_ERROR | E_PARSE);
$qry = $conn->query("SELECT * FROM complaints where id = {$_GET['id']} ");
foreach ($qry->fetch_array() as $k => $v) {
	$$k = $v;
}
if ($status > 1) {
	$aqry =  $conn->query("SELECT * FROM complaints_action where complaint_id = {$_GET['id']} ");
	foreach ($aqry->fetch_array() as $k => $v) {
		$ca[$k] = $v;
		error_reporting(0);
	}
}
?>
<div class="container-fluid">
	<div class="col-lg-12">
	
		<br>
	
		<large><b>Succesfull sent to:</b></large>
		<p><?php echo $contact ?></p>

	</div>
</div>
<script>


	function myFunction() {
	//	alert("SMS sent Successfully!");
		<?php



		 include 'vendor/autoload.php';
		 $MessageBird = new \MessageBird\Client('ZKBiElDAq19dwTrjDfZY3ry89');
		  $Message = new \MessageBird\Objects\Message();
		  $Message->originator ='+639207493641';
		  $Message->recipients = $contact;
		  $Message->body = 'Good Day Thank you For your report. Immediate action has been made as soon as possible.';
		 $response = $MessageBird->messages->create($Message);
		 print_r(json_encode($response));
		?>;
	};
</script>