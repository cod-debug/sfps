<?php
    include("db_connect.php");
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header("location: student_index.php?page=admin_online_payments");
    }
    $query = "SELECT * FROM `online_payments` WHERE `op_id` = $id";
    $payment = $conn->query($query);
    $payment = $payment->fetch_assoc();

    $course = "SELECT * FROM `course_list` WHERE `cl_id` = '$payment[course_id]'";
    $course = $conn->query($course);
    $course = $course->fetch_assoc();
?>
<div class="row">
    <div class="col-md-12 text-center">
        <h2><?php echo $payment['full_name']; ?></h2>
        <h3 class="text-muted"><?php echo $payment['student_id_num']; ?></h3>
        <p1>(<?php echo $course['course_name']; ?>)</p1><br>
        <?php echo date_format(date_create($payment['timestamp']), "M d, Y h:i:s A"); ?><br><br>
        <img src="online_payments/<?php echo $payment['student_id'].'/'.$payment['proof_of_payment'] ?>" class="w-100 rounded">
    </div>
</div>
<?php if($payment['status'] == 'pending'): ?>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger approve" data-status="disapproved" data-opid="<?php echo $payment['op_id'] ?>" data-url="ajax.php?action=approve_online_payment" ><i class="fa fa-times"></i> Disapprove</button>
        <button type="button" class="btn btn-success approve" data-status="approved" data-opid="<?php echo $payment['op_id'] ?>" data-url="ajax.php?action=approve_online_payment" ><i class="fa fa-check"></i> Approve</button>
    </div>
<?php endif; ?>

<script>
    $('.approve').click(function(){
        
        var newFormData = new FormData();
        var thisBtn = $(this);
        newFormData.append('status', $(this).data('status'));
        newFormData.append('op_id', $(this).data('opid'));

        $.ajax({
            url:$(this).data('url'),
            data: newFormData,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            error:err=>{
                console.log()
                alert("An error occured")
        },
        success:function(resp){
				if(resp == 1){
					alert_toast("Online payment " + thisBtn.data('status'),'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}else{
					alert_toast("Something went wrong.",'danger')
					setTimeout(function(){
						// location.reload()
					},1500)
					end_load()
				}
			}
        })
    });
</script>