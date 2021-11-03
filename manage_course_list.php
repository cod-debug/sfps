<form id="manage_course_list">
    <div class="form-group">
        <label>Course Name</label>
        <input type="text" class="form-control" name="course_name">
    </div>
    <div class="form-group">
        <label>Short Name</label>
        <input type="text" class="form-control" name="course_short_name">
    </div>
</form>

<script>
    
    $('#manage_course_list').submit(function(e){
        e.preventDefault()
        start_load()
        $('#msg').html('')
        $.ajax({
            url:'ajax.php?action=save_course_list',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
                if(resp==1){
                    alert_toast("Data successfully saved.",'success')
                        setTimeout(function(){
                            location.reload()
                        },1000)
                }else{
                    console.log(resp);
                $('#msg').html('<div class="alert alert-danger mx-2">Course Name & Level already exist.</div>')
                end_load()
                }   
            }
        })
    })
</script>