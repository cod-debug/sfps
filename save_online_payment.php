<?php
session_start();
include("db_connect.php");

if (isset($_POST)) {
    $id_num = $_POST['student_id_num'];
    $full_name = $_POST['full_name'];
    $course_id = $_POST['course_id'];
    $student_id = $_SESSION['login_id'];
    $proof_of_payment = $_FILES["proof_of_payment"]["name"];

    echo $proof_of_payment;
    if(!is_dir("online_payments/". $_SESSION['login_id'] ."/")) {
        mkdir("online_payments/". $_SESSION['login_id'] ."/");
    }
    
    move_uploaded_file($_FILES["proof_of_payment"]["tmp_name"], "online_payments/". $_SESSION['login_id'] ."/". $_FILES["proof_of_payment"]["name"]);
    
    $save = $conn->query("INSERT INTO `online_payments` (`student_id_num`, `full_name`, `course_id`, `student_id`, `proof_of_payment`, `status`) 
    VALUES ('$id_num', '$full_name', '$course_id', '$student_id', '$proof_of_payment', 'pending')");

    header("Location: student_index.php?page=student_online_payment&saved=true");
}
?>