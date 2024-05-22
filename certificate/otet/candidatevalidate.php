<?php
  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] == "GET") {
     $roll=trim($_GET['r']);
    $input=trim($_GET['q']);
   $year = preg_replace("/[^0-9]/", "", $input);
//   $dbname='OTET';
$dbname='u772092216_OTET';
  $table='OTET'.$year;
//   $con=new mysqli('localhost','root','','OTET');
    $con=new mysqli('localhost','u772092216_OTET','BseOTET@123','u772092216_OTET');
if(!$con){
    die('Errror...');
}
 

  $flag=0;
  $query="Show tables from $dbname";
  $result=$con->query($query);
  if ($result->num_rows > 0) {
    // echo "Tables in $dbname database:<br>";
    while ($row = $result->fetch_assoc()) {
        // echo $row["Tables_in_$dbname"] . "<br>";
        if( $row["Tables_in_$dbname"] ==$table){
           
            $flag=1;
            break;
        }
    }
} 
if($flag==0){
    header('location:candidateform.php?err=invalid_year'.$year);
    exit;
}else{
    $query_roll="Select * from $table where ROLLNO='$roll'";
    $result_roll=$con->query($query_roll);
    $flag_roll=0;
    if(mysqli_num_rows($result_roll)>0){
      while($row_roll=$result_roll->fetch_assoc()){
        if($row_roll['ROLLNO']==$roll){
            $flag_roll=1;
            break;
        }
      }
    }
    if($flag_roll==0){
        header('location:candidateform.php?err=invalid_roll');
        exit;
    }else{
        header('location:candidatedetails.php?q='.$roll.'&r='.$year);
        exit;
    }
}

}
?>