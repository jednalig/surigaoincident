<?php
session_start();
include('admin/db_connect.php');
ob_start();
$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
foreach ($query as $key => $value) {
  if (!is_numeric($key))
    $_SESSION['system'][$key] = $value;
}
ob_end_flush();



?>
<?php if (isset($_SESSION['login_id'])) : ?>



  <!DOCTYPE HTML>
<?php

include('admin/db_connect.php');
ob_start();
$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
foreach ($query as $key => $value) {
    if (!is_numeric($key))
        $_SESSION['system'][$key] = $value;
}
ob_end_flush();


?>
<?php

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
	include "db_conn.php";

	echo "<pre>";
	print_r($_FILES['my_image']);
	echo "</pre>";

	$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];

	if ($error === 0) {
		
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png");

			if (in_array($img_ex_lc, $allowed_exs)) {
				$message = $_REQUEST['message'];
        $id =  $_REQUEST['id'];
				$type =  $_REQUEST['type'];
				$address = $_REQUEST['address'];
        $contact = $_REQUEST['contact'];
				
				$new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
				$img_upload_path = 'uploads/' . $new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
				$sql = "INSERT INTO complaints(complainant_id,image,contact,address,message,type) 
				        VALUES(' $id','$new_img_name','$contact','$address','$message','$type')";
				mysqli_query($conn, $sql);
			} else {
				// $em = "You can't upload files of this type";
				
			}
		
	} else {
		// $em = "unknown error occurred!";
		
	}
} else {
	
}
?>
<?php
include 'admin/db_connect.php';
?>
<html>

<head>
    <title>Incident Report Management System</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets2/css/main.css" />
    <noscript>
        <link rel="stylesheet" href="assets2/css/noscript.css" />
    </noscript>
    <title><?php echo $_SESSION['system']['name'] ?></title>

</head>
<style>
    #cat-list li {
        cursor: pointer;
    }

    #cat-list li:hover {
        color: white;
        background: #007bff8f;
    }

    .prod-item p {
        margin: unset;
    }

    .bid-tag {
        position: absolute;
        right: .5em;
    }

    #cat-list li {
        cursor: pointer;
    }

    #cat-list li:hover {
        color: white;
        background: #007bff8f;
    }

    .prod-item p {
        margin: unset;
    }

    .bid-tag {
        position: absolute;
        right: .5em;
    }

    .fr-wrapper {
        color: white;
        background: #ffffff08;
        padding: 1em 1.5em;
        border-radius: 5px;
    }

    .fr-wrapper td,
    .fr-wrapper th {
        color: white;
    }

    table.dataTable tbody tr {
        background-color: unset;
    }

    table.dataTable tbody tr:hover {
        background-color: white;
    }

    div#complaint-tbl_wrapper * {
        color: white;
    }

    table.dataTable tbody tr:hover td {
        color: black !important;
    }

    select[name="complaint-tbl_length"],
    select[name="complaint-tbl_length"] option {
        color: black !important;
    }

    .paginate_button {
        color: white !important;
    }

    div#complaint-tbl_filter input {
        color: black !important;
    }

    nav {
        font-size: 20px;
    }

    #one {
        width: 100%;
    }

    .content2 {
        width: 100%;
    }
</style>

<body class="is-preload">

    <!-- Sidebar	 -->
    <section id="sidebar">
        <div class="inner">
            <nav>
                <ul>
                    <li><h3 class="nav"><span><?php echo "Welcome " . $_SESSION['login_name'] ?></span></h3></li>
                    <li><a class="nav" href="#intro">Home</a></li>
                    <?php if(isset($_SESSION['login_id'])): ?>
                    <li><a class="nav" href="#one">My Complaint List</a></li>
                    <li><a class="nav" href="#two">What we do</a></li>
                    <li><a class="nav" href="#three">Get in touch</a></li>
                    <li><a class="nav" href="admin/ajax.php?action=logout2">LogOut</a></li>
                    <?php else: ?>
                        <li><a class="nav" href="log.php" id="login_now">Login</a></li>
                      <?php endif; ?>
                </ul>
            </nav>
        </div>
    </section>

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Intro -->
        <section id="intro" class="wrapper style1 fullscreen fade-up">
            <div class="inner">

                <div class="col-lg-8 align-self-end mb-4 page-title">
                    <h1 class="text-white">Welcome to <?php echo $_SESSION['system']['name']; ?></h1>
                    <hr class="divider my-4" />
                    <div class="row mb-2 text-left justify-content-center ">
                        <a href="#three" class="btn btn-primary" type="button" id="report_crime">Report a Crime/Complaint</a>
                    </div>
                </div>
            </div>
        </section>
        <?php if(isset($_SESSION['login_id'])){ ?>
        <!-- One -->
        <section id="one" class="wrapper style2 spotlights">
            <section>

                <div class="content2">
                    <div class="inner">
                        <?php
                        $cid = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
                        ?>
                        <div class="container">
                            <div class="col-lg-12">
                                <div class="fr-wrapper">
                                    <p><?php echo html_entity_decode($_SESSION['system']['about_content']) ?></p>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </section>

        </section>
        <section id="one" class="wrapper style2 spotlights">
            <section>
                <!-- <a href="#" class="image"><img src="images/pic02.jpg" alt="" data-position="top center" /></a> -->

                <div class="content2">
                    <div class="inner">
                        <div class="container">
                            <div class="table-wrapper" id="">
                                <table class="table table-bordered table-hover" id="complaint-tbl">
                                    <thead>
                                        <tr>
                                            <th width="20%">Date</th>
                                            <th width="30%">Report</th>
                                            <th width="30%">Incident Address</th>
                                            <th width="10%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $status = array("", "Pending", "Received", "Action Made");
                                        $qry = $conn->query("SELECT * FROM complaints where complainant_id = {$_SESSION['login_id']} order by unix_timestamp(date_created) desc ");
                                        while ($row = $qry->fetch_array()) :
                                        ?>
                                            <tr>
                                                <td><?php echo date('M d, Y h:i A', strtotime($row['date_created'])) ?></td>
                                                <td><?php echo $row['message'] ?></td>
                                                <td><?php echo $row['address'] ?></td>
                                                <td><?php echo $status[$row['status']] ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <script>
                            $('#complaint-tbl').dataTable();
                        </script>


                    </div>
                </div>
            </section>

        </section>

        <!-- Two -->
        <section id="two" class="wrapper style3 fade-up">
            <div class="inner">
                <h2>What we do</h2>
                <p>Most officers start off as patrol officers. Typical day to day duties include assisting in emergency scenes, responding to burglaries, and monitoring the roadways and stopping cars that are driving erratically or speeding. For every incident that occurs, a police officer is required to file a report. Doing paperwork is certainly not a glamorous part of the job, but it’s a necessary and frequent task.</p>
                <div class="features">
                    <section>
                        <span class="icon solid major fa-eye"></span>
                        <h3>Our Vission</h3>
                        <p>The major ecotourism destination, fishery producer and mineral-based processing industrial center of Caraga Region, driven by God-centered, empowered, globally-competitive, united, and resilient Surigaonons inspired by ethical and responsive leadership.

                        </p>
                    </section>
                    <section>
                        <span class="icon solid major fa-code"></span>
                        <h3>Our Mission</h3>
                        <p>To achieve a more rapid, inclusive and sustainable socio-economic growth towards poverty alleviation through good governance.</p>
                    </section>

                    <section>
                        <span class="icon solid major fa-man"></span>
                        <h3>Our Team</h3>
                        <p>Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.</p>
                    </section>
                    <section>
                        <span class="icon solid major fa-desktop"></span>
                        <h3>Services</h3>
                        <p>Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.</p>
                    </section>
                    <section>
                        <span class="icon solid major fa-link"></span>
                        <h3>About Us</h3>
                        <p>Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.</p>
                    </section>
                    <section>
                        <span class="icon major fa-gem"></span>
                        <h3>Allies</h3>
                        <p>Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.</p>
                    </section>
                </div>
                <ul class="actions">
                    <li><a href="generic.php" class="button">Learn more</a></li>
                </ul>
            </div>
        </section>

        <!-- Three -->
        <section id="three" class="wrapper style1 fade-up">
            <div class="inner">
                <h2>Get in touch</h2>
                <p>Please input your report below including image as evidence and click upload then expect to receive an sms as a response from responders to your report.</p>
                <div class="split style1">
                    <section>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="fields">
                                <input type="hidden" name="id" placeholder="<?php echo $_SESSION['login_id'] ?>" value="<?php echo $_SESSION['login_id'] ?>">
                                <input type="hidden" name="contact" placeholder="<?php echo $_SESSION['login_contact'] ?>" value="<?php echo $_SESSION['login_contact'] ?>">
                               
                                <div class="field half">
                                    <label for="name">Incident Type</label>
                                    <input type="text" name="type" placeholder="Ex. Carnapping" id="name" />
                                </div>
                                <div class="field half">
                                    <label for="email">Incident Address</label>
                                    <input type="text" name="address" id="email" />
                                </div>
                                <div class="field half">
                                    <label for="image">Select Image File:</label>
                                    <input type="file" name="my_image" />
                                </div>

                                <div class="field">
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" rows="5"></textarea>
                                </div>
                                <input type="submit" class="btn-primary" name="submit" value="Upload">
                            </div>
                            <ul class="actions">
                                <!-- <li><button class="button btn btn-primary btn-sm">Create</button></li> -->

                            </ul>
                        </form>
                    </section>
                    <section>
                        <ul class="contact">
                            <li>
                                <h3>Address</h3>
                                <span>12345 Somewhere Road #654<br />
                                    Nashville, TN 00000-0000<br />
                                   Surigao Del Norte</span>
                            </li>
                            <li>
                                <h3>Email</h3>
                                <a href="#">user@untitled.tld</a>
                            </li>
                            <li>
                                <h3>Phone</h3>
                                <span>(000) 000-0000</span>
                            </li>
                            <li>
                                <h3>Social</h3>
                                <ul class="icons">
                                    <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                                    <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                                    <li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
                                    <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
                                    <li><a href="#" class="icon brands fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </section>
                </div>
            </div>
        </section>

    </div>
    <?php } ?>
    <!-- Footer -->
    <footer id="footer" class="wrapper style1-alt">
        <div class="inner">
            <ul class="menu">
                <li>&copy; Capstone. All rights reserved.</li>
                <li>Design: <a href="">Surigao Nation State University Students</a></li>
            </ul>
        </div>
    </footer>
    <script type="text/javascript">
      $('#login').click(function(){
        uni_modal("Login",'login.php')
      })
      $('.datetimepicker').datetimepicker({
          format:'Y-m-d H:i',
      })
      $('#find-car').submit(function(e){
        e.preventDefault()
        location.href = 'index.php?page=search&'+$(this).serialize()
      })
      $('#report_crime').click(function(){
        if('<?php echo !isset($_SESSION['login_id']) ? 1 : 0 ?>'==1){
          uni_modal("Login",'login.php');
          return false;
        }
          uni_modal("Report",'manage_report.php');
      })
      $('#manage_my_account').click(function(){
          uni_modal("Manage Account",'signup.php');
      })
    </script>
    <!-- Scripts -->
    <script src="assets2/js/jquery.min.js"></script>
    <script src="assets2/js/jquery.scrollex.min.js"></script>
    <script src="assets2/js/jquery.scrolly.min.js"></script>
    <script src="assets2/js/browser.min.js"></script>
    <script src="assets2/js/breakpoints.min.js"></script>
    <script src="assets2/js/util.js"></script>
    <script src="assets2/js/main.js"></script>
    <script>
        $('#complaint-frm').submit(function(e) {
            e.preventDefault();
            // start_load();
            if ($(this).find('.alert-danger').length > 0)
                $(this).find('.alert-danger').remove();
            $.ajax({
                url: 'admin/ajax.php?action=complaint',
                method: 'POST',
                data: $(this).serialize(),
                error: err => {
                    console.log(err)
                    $('#complaint-frm button[type="submit"]').removeAttr('disabled').html('Create');

                },
                success: function(resp) {
                    if (resp == 1) {
                        location.reload();
                        alert_toast("Data successfully saved.", 'success')
                        setTimeout(function() {
                            location.reload()
                        }, 1000)
                    } else {
                        end_load()
                    }
                }
            })
        })
    </script>
</body>

</html>






<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->




<?php else : ?>


<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////// -->




<!DOCTYPE html>
<html lang="en">
<?php include('header.php'); ?>

<style>
  .bg-dark {
    background-color: #312450 !important;
  }

  #main-field {
    margin-top: 5rem !important;
    background-color: #312450;
  }

  body * {
    /*font-size: 13px ;*/
  }

  .modal-body {
    color: black;
  }

  .fr-wrapper {
    color: white;
    background: #ffffff08;
    padding: 1em 1.5em;
    border-radius: 5px;
  }

  .masthead {
   
    background-repeat: no-repeat !important;
    background-size: cover ;
    background-color: #E387FB;
    height: 60vh;
  }
</style>

<body id="page-buttom" class=" bgback">
  <!-- Navigation-->
  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white">
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="./"><?php echo $_SESSION['system']['name'] ?></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">Home</a></li>
          <?php if (isset($_SESSION['login_id'])) : ?>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php">My Complaint List</a></li>
            <div class=" dropdown mr-4">
              <a href="#" class="text-white dropdown-toggle" id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_name'] ?> </a>
              <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
                <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
                <a class="dropdown-item" href="admin/ajax.php?action=logout2"><i class="fa fa-power-off"></i> Logout</a>
              </div>
            </div>
          <?php else : ?>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="javascript:void(0)" id="login_now">Login</a></li>
          <?php endif; ?>



        </ul>
      </div>
    </div>
  </nav>
  <div class="masthead">
    <div class="container-fluid h-100">
      <div class="row h-100 align-items-center justify-content-center text-center">
        <div class="col-lg-8 align-self-end mb-4 page-title">
          <h3 class="text-white">Welcome to <?php echo $_SESSION['system']['name']; ?></h3>
          <hr class="divider my-4" />
          <div class="row mb-2 text-left justify-content-center ">
            <!-- <button class="btn btn-primary" type="button" id="report_crime">Report a Crime/Complaint</button> -->
            <!-- <a class="btn btn-primary" href="message.php" type="button" id="SMS">SEND SMS</a> -->

          </div>
        </div>

      </div>
    </div>
          </div>

  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
        </div>
        <div class="modal-body">
          <div id="delete_content"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="fa fa-arrow-right"></span>
          </button>
        </div>
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
        <img src="" alt="">
      </div>
    </div>
  </div>
  <div id="preloader"></div>
  <footer class=" py-5 bg-dark">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="mt-0 text-white">Contact us</h2>
          <hr class="divider my-4" />
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
          <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
          <div class="text-white"><?php echo $_SESSION['system']['contact'] ?></div>
        </div>
        <div class="col-lg-4 mr-auto text-center">
          <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
          <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
          <a class="d-block" href="mailto:<?php echo $_SESSION['system']['email'] ?>"><?php echo $_SESSION['system']['email'] ?></a>
        </div>
      </div>
    </div>
    <br>
    <div class="container">
      <div class="small text-center text-muted">Copyright © 2022 - <?php echo $_SESSION['system']['name'] ?> | <a href="" target="_blank">SNSU</a></div>
    </div>
  </footer>

  <?php include('footer.php') ?>
</body>
<script type="text/javascript">
  $('#login').click(function() {
    uni_modal("Login", 'login.php')
  })
  $('.datetimepicker').datetimepicker({
    format: 'Y-m-d H:i',
  })
  $('#find-car').submit(function(e) {
    e.preventDefault()
    location.href = 'index.php?page=search&' + $(this).serialize()
  })
  $('#report_crime').click(function() {
    if ('<?php echo !isset($_SESSION['login_id']) ? 1 : 0 ?>' == 1) {
      uni_modal("Login", 'login.php');
      return false;
    }
    uni_modal("Report", 'manage_report.php');
  })
  $('#manage_my_account').click(function() {
    uni_modal("Manage Account", 'signup.php');
  })
</script>
<?php $conn->close() ?>

</html>


<?php endif; ?>

