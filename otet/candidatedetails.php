<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  $roll=trim($_GET['q']);
    $year=trim($_GET['r']);
    
  // $dbname='OTET';
 
   $table='OTET'.$year;
  //  $con=new mysqli('localhost','root','','OTET');
  $dbname='u772092216_OTET';
  $con=new mysqli('localhost','u772092216_OTET','Bseotet@123','u772092216_OTET');
   $query='Select * from '.$table.' where ROLLNO='.$roll ;
   if($con){
    $result=$con->query($query);
    if(mysqli_num_rows($result)>0){
    while( $row=$result->fetch_array()){

  

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Candidate Details</title>
  <!-- Materialize CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <!-- Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    body {
      background-color: #f5f5f5;
    }
    .card {
      width: 80%;
      margin: 50px auto;
      padding: 20px;
      border-radius: 10px;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card-title {
      font-size: 24px;
      margin-bottom: 20px;
      text-align: center;
    }
    .admit-card-table {
      margin-bottom: 0;
    }
    .admit-card-table th, .admit-card-table td {
      border: none;
      padding: 5px 10px;
    }
    .admit-card-table .actions {
      text-align: center;
    }
    .action-icons a {
      color: #333;
      margin: 0 5px;
    }
  </style>
</head>
<body>
  <div class="card">
    <h4 class="card-title">Candidate Details</h4>
    <table class="admit-card-table">
      <tbody>
        <!-- Sample data, replace with your actual data -->
        <tr>
          <th>Candidate Name:</th>
          <td><?php echo $row['CNAME']; ?></td>
          <th>Photo:</th>
          <td><img src="<?php echo $row['PROFILEPATH']; ?>" alt="John Doe Photo" style="width: 5em;"></td>
        </tr>
        <tr>
          <th>Father Name:</th>
          <td><?php echo $row['FNAME']; ?></td>
          <th>Year:</th>
          <td><?php echo $row['PASSYEAR']; ?></td>
        </tr>
        <tr>
          <th>Mark Paper1:</th>
          <td><?php echo $row['PAPEROPT']; ?></td>
         <th>Mark Paper2</th>
         
          <td><?php echo $row['PAPEROPT2']; ?></td>
        </tr>
        <tr>
          <th>Category:</th>
          <td><?php echo $row['CASTE']; ?></td>
          <th>Certificate No:</th>
          <td><?php echo $row['CERTNO']; ?></td>
        </tr>
        <tr>
          <th>Appl No:</th>
          <td><?php echo $row['OTETID']; ?></td>
          <th>Serial No:</th>
          <td><?php echo $row['SLNO']; ?></td>
        </tr>
        <tr>
          <th>Roll No:</th>
          <td><?php echo $row['ROLLNO']; ?></td>
          <th>Obtain Mark:</th>
          <td><?php echo $row['TOTAL']; ?></td>
        </tr>
        <tr>
         
          <td colspan="2" class="actions">
            <div class="action-icons">
             <?php
              echo '<a href="editcandidate.php?q='.$roll.'&r='.$year.'">
                <i class="material-icons right">edit</i>
              </a>';
            echo '<a href="certificate.php?q='.$roll.'&r='.$year.'">
                <i class="material-icons right">receipts</i>
              </a>';?>
            </div>
          </td>
        </tr>
        <!-- More rows here -->
      </tbody>
    </table>
  </div>

  <!-- Materialize JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
<?php
  }

      
}
}


}
?>