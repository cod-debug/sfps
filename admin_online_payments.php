<?php
    include("db_connect.php");
    $status = $_GET['status'];
    $ol_payments_q = "SELECT * FROM `online_payments` 
    WHERE `status` = '$status' 
    ORDER BY `timestamp` DESC";

    $ol_payments = $conn->query($ol_payments_q);
?>
<div class="modal fade" id="viewPaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Online Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="view_payment_div">
      </div>
    </div>
  </div>
</div>

<a href="index.php?page=admin_online_payments&status=pending" class="btn btn-success my-3"><i class="fa fa-clock"></i> Pending</a>
<a href="index.php?page=admin_online_payments&status=approved" class="btn btn-primary my-3"><i class="fa fa-check"></i> Approved</a>
<a href="index.php?page=admin_online_payments&status=disapproved" class="btn btn-danger my-3"><i class="fa fa-times"></i> Disapproved</a>

<div class="card" id="online_payments">
    <div class="card-header">
        <h3 class="text-capitalize">Online Payments <small>(<?php echo $_GET['status'] ?>)</small></h3>
    </div>

    <div class="card-body">
        <table class="table w-100 table-stripes datatable">
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>Full Name</th>
                    <th>ID Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $ol_payments->fetch_assoc()): ?>
                    <tr>
                        <td><span style="display:none;"><?php echo $row['timestamp']; ?></span><?php echo date_format(date_create($row['timestamp']), "M d, Y h:i:s A"); ?></td>
                        <td><?php echo $row['full_name'] ?></td>
                        <td><?php echo $row['student_id_num'] ?></td>
                        <td>
                            <button data-id="<?php echo $row['op_id'] ?>" class="btn btn-success btn-sm view_payment"><i class="fa fa-eye"></i> View</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(".view_payment").on("click", function(){
        $.get("view_ol_payment.php?id="+this.dataset.id, function(data, status){
            // alert("Data: " + data + "\nStatus: " + status);
            $('#view_payment_div').html(data);
            $('#viewPaymentModal').modal('show');
        });
    });
	$(document).ready(function(){
		$('table').dataTable({
            "order": [[ 0, "desc" ]], //or asc 
        })
	})
</script>