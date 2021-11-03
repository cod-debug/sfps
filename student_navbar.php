
<style>
	.collapse a{
		text-indent:10px;
	}
	nav#sidebar{
		/*background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>) !important*/
	}
</style>

<nav id="sidebar" class='mx-lt-5 bg-dark' >
    <div class="sidebar-list">
        <a href="student_index.php?page=home" class="nav-item nav-home" style="size: 30%;"><span class='icon-field'><i class="fa fa-tachometer-alt "></i></span> Dashboard</a>
        <a href="student_index.php?page=student_payment_record" class="nav-item nav-fees"><span class='icon-field'><i class="fa fa-money-check "></i></span> Payment Record</a>
        <a href="student_index.php?page=student_online_payment" class="nav-item nav-fees"><span class='icon-field'><i class="fa fa-money-bill-wave "></i></span> Online Payment</a>
    </div>
</nav>
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
