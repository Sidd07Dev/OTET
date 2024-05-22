<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user=$_SESSION['username'];
if($user=='' || empty($user) || $user==null){
  header('location:index.html');
  exit();
}
date_default_timezone_set('Asia/Kolkata');
$Time=date("Y-m-d H:i:s");
// $con = new mysqli('localhost', 'root', '', 'OTET');

$con=new mysqli('localhost','u772092216_OTET','BseOTET@123','u772092216_OTET');
// require_once('connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array();

    // Validate Candidate Name
    if (empty($_POST["candidate_name"])) {
        $errors["candidate_name"] = "Candidate Name is required";
    } else {
        $candidate_name = test_input($_POST["candidate_name"]);
        // Check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $candidate_name)) {
            $errors["candidate_name"] = "Only letters and white space allowed";
        }
    }

    // Validate Father's/Mother's Name
    if (empty($_POST["father_name"])) {
        $errors["father_name"] = "Father's/Mother's Name is required";
    } else {
        $father_name = test_input($_POST["father_name"]);
        // Check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $father_name)) {
            $errors["father_name"] = "Only letters and white space allowed";
        }
    }

    // Validate other fields similarly...

    // Validate and handle uploaded image
    if (!empty($_FILES["input-photo"]["name"])) {
        $target_dir = "profiles/";
        $target_file = $target_dir . basename($_FILES["input-photo"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["input-photo"]["tmp_name"]);
        if ($check !== false) {
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $errors["input-photo"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            } else {
                if (move_uploaded_file($_FILES["input-photo"]["tmp_name"], $target_file)) {
                    $image_path = $target_file;
                } else {
                    $errors["input-photo"] = "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            $errors["input-photo"] = "File is not an image.";
        }
    }

    // If there are no errors, proceed with further processing
    if (empty($errors)) {
      $year=test_input($_POST['year']);
      $cname=test_input($_POST['candidate_name']);
      $fname=test_input($_POST['father_name']);
      $certNo=test_input($_POST['certificate_no']);
      $serialNo=test_input($_POST['serial_no']);
      $rollNo=test_input($_POST['roll_no']);
      $applNo=test_input($_POST['appl_no']);
      $paper1=test_input($_POST['mark_paper1']);
      $paper2=test_input($_POST['mark_paper2']);
      $mark=test_input($_POST['obtain_mark']);
      $caste=test_input($_POST['caste']);
      $dop=test_input($_POST['dop']);
      $dist=test_input($_POST['dist']);
        // Process form data or save to database
        // Redirect to success page or show success message
      
        //   $dbname = 'OTET';
           $dbname='u772092216_OTET';
          $query = "SHOW TABLES FROM $dbname";
          $result = $con->query($query);
          $flag=0;
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              foreach ($row as $value) {
               if($value=='OTET'.$year){
                echo "true";
                $table=$value;
                $flag=1;
                break;
               }
              }
            }
          }

          if($flag==1){
            $query1="select * from $table  where ROLLNO='$rollNo'";
            $res2=$con->query($query1);
            if($res2->num_rows > 0){ 
              header('location:candidateform.php');
              unlink($image_path);
              exit();
            }else{ 
            $res=new_Data($con,$table,$rollNo,$applNo,$cname, $fname,$paper1,$paper2,$caste, $mark,$serialNo,$certNo,$year, $image_path,$Time,$dop,$dist);
            if($res){
              header('location:candidateform.php');
              exit();
            }
            }
          }else{
            if(new_table($con,$year)==1){
              $table='OTET'.$year;
              $res=new_Data($con,$table,$rollNo,$applNo,$cname, $fname,$paper1,$paper2,$caste, $mark,$serialNo,$certNo,$year, $image_path,$Time,$dop,$dist);
              header('location:candidateform.php');
              exit();
            }
          }
    }
}

// Function to sanitize and validate input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function new_Data($con,$table,$rollNo,$applNo,$cname, $fname,$paper1,$paper2,$caste, $mark,$serialNo,$certNo,$year, $image_path,$Time,$dop,$dist){
  $flag=0;
  $user=$_SESSION['username'];
  $sql="INSERT INTO $table (`ROLLNO`, `OTETID`, `CNAME`, `FNAME`, `PAPEROPT`, `PAPEROPT2`, `CASTE`, `TOTAL`, `SLNO`, `CERTNO`, `PASSYEAR`, `DOP`, `PROFILEPATH`, `CreateTime`,  `CreateBy`,`UPDATETIME`, `UPDATEBY`,`DISTNM`) VALUES('$rollNo','$applNo','$cname',' $fname','$paper1','$paper2','$caste', '$mark','$serialNo','$certNo','$year','$dop',' $image_path','$Time','$user','not change','not change','$dist') ";
  $res=$con->query($sql);
  if($res){
$flag=1;
  }
return $flag;
}
function new_Table($con,$year){
  $tablename='OTET'.$year;
  $sql="CREATE TABLE $tablename (
    `ROLLNO` varchar(255) DEFAULT NULL,
    `OTETID` varchar(255) DEFAULT NULL,
    `CNAME` varchar(255) DEFAULT NULL,
    `FNAME` varchar(255) DEFAULT NULL,
    `PAPEROPT` varchar(255) DEFAULT NULL,
    `PAPEROPT2` varchar(255) DEFAULT NULL,
    `LANGOPT` varchar(255) DEFAULT NULL,
    `CASTE` varchar(255) DEFAULT NULL,
    `TOTAL` int(11) DEFAULT NULL,
    `RESULT` varchar(255) DEFAULT NULL,
    `PERCENTEGE` int(11) DEFAULT NULL,
    `SLNO` varchar(255) DEFAULT NULL,
    `CERTNO` varchar(255) DEFAULT NULL,
    `STREAM` varchar(255) DEFAULT NULL,
    `PASSYEAR` int(11) DEFAULT NULL,
    `DOI` varchar(255) DEFAULT NULL,
    `DOP` varchar(255) DEFAULT NULL,
    `DISTNM` varchar(255) DEFAULT NULL,
    `GENDER` varchar(255) DEFAULT NULL,
    `PROFILEPATH` varchar(255) NOT NULL DEFAULT './profiles/default.png',
    `CreateTime` varchar(55) NOT NULL DEFAULT current_timestamp(),
    `UPDATETIME` varchar(55) NOT NULL DEFAULT current_timestamp(),
    `CreateBy` varchar(255) DEFAULT NULL,
    `UPDATEBY` varchar(255) DEFAULT NULL
  )";
  $res=$con->query($sql);
  if($res){
    return 1;
  }
  return 0;
}

?>
