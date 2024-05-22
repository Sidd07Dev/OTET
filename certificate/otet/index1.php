<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    $uid=$_POST['Username'];
    $Pass=$_POST['password'];
      ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    if($uid==''|| $Pass==''|| $uid==null || $Pass==null){
        $error="UID AND PASSWORD CAN'T BE BLANK";
        header("location:index.html?notification=".$error);
        exit;
    }else{
        $dbname='u772092216_OTET';
        $con=new mysqli('localhost','u772092216_OTET','BseOTET@123','u772092216_OTET');
        // $dbname='OTET';
        // $con=new mysqli('localhost','root','','OTET');
        $sql="Select * from ADMIN where UID='$uid'";
        $result=$con->query($sql);
        if($result->num_rows>0){
            $row=$result->fetch_assoc();
            $flag=0;
        if($uid==$row['UID'] && $Pass==$row['PASS']){
            
            session_start();
            $_SESSION['username']=$uid;
           
            header("location:candidateform.php");
        }else{
            $error="WRONG UID OR  PASSWORD ";
            header("location:index.html?notification=".$error);
        }
    }else{
            $error="WRONG UID OR  PASSWORD ";
            header("location:index.html?notification=".$error);
        }
    }
}
?>