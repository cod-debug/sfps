<?php 
include 'db_connect.php'; 

?>

<style>
    .upload-div {
        position: relative;
        overflow: hidden;
    }
    .upload-input {
        position: absolute;
        font-size: 50px;
        opacity: 0;
        right: 0;
        top: 0;
    }
</style>
<br>
<div class="card w-50 m-auto">
    <div class="card-header text-center">
        <img src="assets/img/logo.png" alt="" class="src m-auto" style="width: 25%;"><h3>Online Payment Form</h3>    
    </div>
    <div class="card-body">
        <form id="online_payment" action="save_online_payment.php" enctype="multipart/form-data" method="POST">
            <div class="form-group">
                <label>ID No.</label>
                <input type="text" class="form-control" name="student_id_num" value="<?php echo $_SESSION['login_id_no'] ?>">
            </div>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" name="full_name" value="<?php echo $_SESSION['login_name'] ?>">
            </div>
            <div class="form-group">
                <label>Course</label>
                <select name="course_id" id="course_id" class="form-control select2" required>
                    <option value=""selected disabled></option>
                    <?php
                        $course_list = $conn->query("SELECT * FROM `course_list`");
                        while($cl = $course_list->fetch_assoc()) {
                            echo $cl['cl_id'];
                    ?>
                        <option value="<?php echo $cl['cl_id'] ?>"><?php echo $cl['course_name'] . ' (' . $cl['course_short_name'] . ')' ?></option>
                    <?php                       
                        }
                    ?>
                </select>
   
                <!-- <input type="text" class="form-control" name="course"  value="<?php echo isset($course) ? $course :'' ?>" required> -->
            </div>
            <div class="form-group">
                <label>Attached File (Proof of Payment)</label>
                <br>
                <div class="file btn btn-sm btn-outline-primary upload-div">
					<i class="fa fa-upload"></i> Upload
                    <input type="file" name="proof_of_payment" accept="image/*" class="upload-input" onchange="readURL(this);"/>
                    
                </div>
            </div>
            
            <div class="form-group">
                <img id="proof" src="#" alt="your image will be shown here..." class="d-none"/>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Send Payment</button>
            </div>
        </form>
    </div>
</div>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#proof')
                    .attr('src', e.target.result)
                    .attr('class', 'd-inline-block')
                    .width("50%")
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    <?php
        if (isset($_GET['saved'])){
            echo 'alert_toast("Data successfully saved.","success")';
        }
    ?>
    // $('#online_payment').submit(function(e){
    //     e.preventDefault()
    //     start_load()
    //     $('#msg').html('')
    //     var formData = new FormData($(this)[0]);
    //     jQuery.each(jQuery('.upload-input')[0].files, function(i, file) {
    //         formData.append('file-'+i, file);
    //     });
    //     $.ajax({
    //         url:'ajax.php?action=save_online_payment',
    //         data: formData,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         method: 'POST',
    //         type: 'POST',
    //         success:function(resp){
    //             if(resp==1){
    //                 alert_toast("Data successfully saved.",'success')
    //                     setTimeout(function(){
    //                         location.reload()
    //                     },1000)
    //             }else{
    //                 console.log(resp);
    //             $('#msg').html('<div class="alert alert-danger mx-2">Something Went Wrong</div>')
    //             end_load()
    //             }   
    //         }
    //     })
    // })
</script>