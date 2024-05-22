<?php
// Database connection parameters
session_start();
date_default_timezone_set('Asia/Kolkata');
$updateBy=$_SESSION['username'];
if($updateBy=='' || empty($updateBy) || $updateBy==null){
    header('location:index.html');
    exit();
}
$updateTime=date("Y-m-d H:i:s");
include('./connection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// $con=new mysqli('localhost','root','','OTET');
$con=new mysqli('localhost','u772092216_OTET','BseOTET@123','u772092216_OTET');
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $candidateName = $_POST['candidate_name'];
    $fatherName = $_POST['father_name'];
    $year = $_POST['year'];
    $year2 = $_POST['year2'];
    $dbname='OTET'.$year2;
    $markPaper1 = $_POST['mark_paper1'];
    $markPaper2= $_POST['mark_paper2'];

    $obtainMark = $_POST['obtain_mark'];
    $category = $_POST['category'];
    $certificateNo = $_POST['certificate_no'];
    $applNo = $_POST['appl_no'];
    $serialNo = $_POST['serial_no'];
    $rollNo = $_POST['roll_no'];
    $oldImage=$_POST['currentImage'];
    $dist=$_POST['dist'];

    // Check if a new photo is uploaded
    if ($_FILES['new_photo']['error'] === UPLOAD_ERR_OK) {
        $newPhotoName = $_FILES['new_photo']['name'];
        $newPhotoTmp = $_FILES['new_photo']['tmp_name'];
        $uploadDir = './profiles/';
        $newPhotoPath = $uploadDir .$rollNo. $newPhotoName;
        move_uploaded_file($newPhotoTmp, $newPhotoPath);

        // Update the photo path in the database or wherever it's stored
        $photoUpdateQuery = "UPDATE $dbname  SET PROFILEPATH = '$newPhotoPath' WHERE ROLLNO = '$rollNo'";
        $resultPhotoUpdateQuery=$con->query($photoUpdateQuery);
        if($resultPhotoUpdateQuery){ 
           if($oldImage!='./profiles/default.png')
        unlink($oldImage);
        }
       
    }

    // Update other candidate details
    $otherDetailsUpdateQuery = "UPDATE $dbname  SET CNAME = '$candidateName', FNAME = '$fatherName', PASSYEAR = '$year', PAPEROPT = '$markPaper1',PAPEROPT2 = '$markPaper2', TOTAL = '$obtainMark', CASTE = '$category', CERTNO = '$certificateNo', SLNO = '$serialNo',UPDATEBY='$updateBy',UPDATETIME='$updateTime' ,DISTNM='$dist' WHERE ROLLNO = '$rollNo'";
    $resultOtherDetailsUpdateQuery=$con->query($otherDetailsUpdateQuery);
if($resultOtherDetailsUpdateQuery){
   
}
    header('Location: candidatedetails.php?q='.$rollNo.'&r='.$year2);
    exit();
}
?>




<!-- $con=new mysqli('localhost','u772092216_OTET','BseOTET@123','u772092216_OTET'); -->