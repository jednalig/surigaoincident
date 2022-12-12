
<style>
	.collapse a{
		text-indent:10px;
	}
	nav#sidebar{
		/*background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>) !important*/
	}
	.navdiv2{
		background-color: #703275;
		width: 500px;
	}

</style>

<nav class="navdiv2" id="sidebar" class='mx-lt-8 bg-dark' >
		
		<!-- <div class="sidebar-list">
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-tachometer-alt "></i></span> Dashboard</a>
				<a href="index.php?page=complaints" class="nav-item nav-complaints"><span class='icon-field'><i class="fa fa-list-alt "></i></span> Complainants</a>
				
				<a href="index.php?page=complainants" class="nav-item nav-complainants"><span class='icon-field'><i class="fa fa-user-secret "></i></span> List of Complainant</a>
				<a href="index.php?page=responders" class="nav-item nav-responders"><span class='icon-field'><i class="fa fa-user-shield "></i></span> Responders</a>
				<a href="index.php?page=stations" class="nav-item nav-stations"><span class='icon-field'><i class="fa fa-building "></i></span>Responders Setting</a>
				
				<a href="index.php?page=complaints_report" class="nav-item nav-complaints_report"><span class='icon-field'><i class="fa fa-th-list"></i></span> Complaints Report</a>
				
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users "></i></span> Users</a>
				<a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs"></i></span> System Settings</a>
			<?php endif; ?>
				
				
				
				
				<a href="index.php?page=stations" ><span class='icon-field'><i class="fa fa-building "></i></span>Responders Setting</a>
				
				
				
				
				
				<a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs"></i></span> System Settings</a>
			
		
		</div> -->
		<section id="sidebar">
        <div class="inner">
            <nav>
                <ul>
                    <li><a href="index.php?page=home" ><span class='icon-field'><i class="fa fa-tachometer-alt "></i></span> Dashboard</a>
			</li>
                    <li><a href="index.php?page=complaints"><span class='icon-field'><i class="fa fa-list-alt "></i></span> Complainants</a></li>
                    <li><a href="index.php?page=complainants" ><span class='icon-field'><i class="fa fa-user-secret "></i></span> List of Complainant</a></li>
                    <li><a href="index.php?page=responders" ><span class='icon-field'><i class="fa fa-user-shield "></i></span> Responders</a></li>
                    <li><a href="index.php?page=stations" ><span class='icon-field'><i class="fa fa-building "></i></span>Responders Setting</a></li>
					<li><a href="index.php?page=complaints_report" ><span class='icon-field'><i class="fa fa-th-list"></i></span> Complaints Report</a></li>

					<?php if($_SESSION['login_type'] == 1): ?>
						<li><a href="index.php?page=site_settings"><span class='icon-field'><i class="fa fa-cogs"></i></span> System Settings</a></li>
					<li><a href="index.php?page=users" ><span class='icon-field'><i class="fa fa-users "></i></span> Users</a></li>
					<!-- <li><a class="nav" href="logout.php">LogOut</a></li> -->
					<?php endif; ?>
				</ul>
            </nav>
        </div>
    </section>

</nav>
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
