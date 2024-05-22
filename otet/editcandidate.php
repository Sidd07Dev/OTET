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
    $row=$result->fetch_array();
    }}}

  

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Candidate Details</title>
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
    .edit-form {
      margin-bottom: 0;
    }
    .edit-form th, .edit-form td {
      border: none;
      padding: 5px 10px;
    }
    .edit-form .input-field {
      margin: 0;
    }
    .edit-form .input-field input {
      width: 100%;
      margin: 0;
    }
  </style>
</head>
<body>
  <div class="card">
    <h4 class="card-title">Edit Candidate Details</h4>
    <form class="edit-form" method="post" action="process_form.php" enctype="multipart/form-data">
      <table>
        <tbody>
          <tr>
            <th>Candidate Name:</th>
            <td class="input-field"><input type="text" value="<?php echo $row['CNAME'];   ?>" name="candidate_name" required ></td>
            <th>Father Name:</th>
            <td class="input-field"><input type="text" value="<?php echo $row['FNAME']; ?>" name="father_name" required  ></td>
          </tr>
          <tr>
            <th>Year:</th>
            <td class="input-field"><input type="text" value="<?php echo $row['PASSYEAR']; ?>" name="year" required ></td>
            <th>Mark Paper1:</th>
            <td class="input-field"><input type="text" value="<?php echo $row['PAPEROPT']; ?>" name="mark_paper1" required  ></td>
          </tr>
          <tr>
          <th>Mark Paper2:</th>
            <td class="input-field"><input type="text" value="<?php echo $row['PAPEROPT2']; ?>" name="mark_paper2" required  ></td>
            <th>Category:</th>
            <td class="input-field"><input type="text" value="<?php echo $row['CASTE']; ?>" name="category" required ></td>
          </tr>
          <tr>
            <th>Certificate No:</th>
            <td class="input-field"><input type="text" value="<?php echo $row['CERTNO']; ?>" name="certificate_no" required  ></td>
            <th>Appl No:</th>
            <td class="input-field"><input type="text" value="<?php echo $row['OTETID']; ?>" name="appl_no" required  readonly></td>
          </tr>
          <tr>
            <th>Serial No:</th>
            <td class="input-field"><input type="text" value="<?php echo $row['SLNO']; ?>" name="serial_no" required  ></td>
            <th>Roll No:</th>
            <td class="input-field"><input type="text" value="<?php echo $row['ROLLNO']; ?>" name="roll_no" required  readonly></td>
          </tr>
          <tr> <th>Obtain Mark:</th>
            <td class="input-field"><input type="text" value="<?php echo $row['TOTAL']; ?>" name="obtain_mark" required  > </td>
            <th>Current Photo:</th>
            <td class="input-field" colspan="3"><img src="<?php echo $row['PROFILEPATH']; ?>" alt="Current Photo" style="width: 100px;">
            <input type="text" name="currentImage" value="<?php echo $row['PROFILEPATH']; ?>" style="display: none;" required  >
          </td>
          </tr>
          <tr>
            <th>New Photo:</th>
            <td class="input-field" colspan="3"><input type="file" accept="image/*" name="new_photo"  ></td>
            <td><input type="text" name="year2" style="display: none;" value="<?php echo $_GET['r'];  ?>"  ></td>
          </tr>
          <tr>
            <td colspan="4" style="text-align: center;">
              <button class="btn waves-effect waves-light" type="submit" name="action">Save Changes
                <i class="material-icons right">save</i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>

  <!-- Materialize JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
