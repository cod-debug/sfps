<?php include('db_connect.php');?>
<?php
    $student_id = $_SESSION['login_id'];
    $student_fee_q = "SELECT * FROM `student_ef_list` WHERE `student_id` = $student_id";
    $fee = $conn->query($student_fee_q)->fetch_assoc();
    if (isset($fee)) {
        $fee_id = $fee['id'];
        $payment_q = "SELECT * FROM `payments` WHERE `ef_id` = $fee_id";
        $payments = $conn->query($payment_q);

        
        $paid = $conn->query("SELECT sum(amount) as paid FROM payments where ef_id=".$fee_id);
        $paid = $paid->num_rows > 0 ? $paid->fetch_array()['paid']:'';
        $balance = $fee['total_fee'] - $paid;
    }
    
?>
<div class="card m-5">
    <?php
        if (isset($fee)) {

    ?>
    <div class="card-header">
        <h6>Payment Record <p1 class='float-right'></h6>
        <b>Total Fee:</b> Php <?php echo number_format($fee['total_fee'], 2); ?></p1><br>
        <b>Paid:</b> Php <?php echo number_format($paid, 2); ?></p1><br>
        <b>Current Balance:</b> Php <?php echo number_format($balance, 2); ?></p1>
    </div> 
    <div class="card-body">
        <table class="table table-condensed table-bordered table-hover" id="datatable">
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>Remarks</th>
                    <th>Timestamp</th>
                </tr>
            
            </thead>
            <tbody>

                <?php while($row=$payments->fetch_assoc()): ?>
                    <tr>
                        <td>Php <?php echo number_format($row['amount'], 2); ?></td>
                        <td><?php echo $row['remarks']; ?></td>
                        <td><?php echo date_format(date_create($row['date_created']), 'M d, Y h:m A'); ?></td>
                    </tr>
                <?php endwhile ?>
                    
            </tbody>
        </table>
    </div>
    <?php
        } else {

    ?>
    <div class="card-body">
        <h3>No Fees/Payment yet.</h3>
    </div>
    
    <?php
        }
    ?>
</div>
<script>
    $(document).ready( function () {
        $('#datatable').DataTable();
    } );
</script>