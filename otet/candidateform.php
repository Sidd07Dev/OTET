<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Select Year</title>
  <!-- Materialize CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- Materialize JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <style>
    #register{
      display: none;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col s12 m6 offset-m3">
        <div class="card-panel">
          <h3 class="center-align">Enter Candidate Roll</h3>
          <form id="rollNumberForm" method="get" action="candidatevalidate.php" enctype="multipart/form-data">
            <div class="input-field">
              <i class="prefix fas fa-calendar"></i>
              <select id="year" name="q" required>
                <option value="" disabled selected>Choose Year</option>
                <?php
                //  $con = new mysqli('localhost', 'root', '', 'OTET');
               
                  // $dbname = 'OTET';
                  $dbname='u772092216_OTET';
                  $con=new mysqli('localhost','u772092216_OTET','Bseotet@123','u772092216_OTET');
                  $query = "SHOW TABLES FROM $dbname";
                  $result = $con->query($query);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      foreach ($row as $value) {
                          if($value=='ADMIN'){
                              continue;
                          }
                        echo "<option value='$value'>$value</option>";
                      }
                    }
                  }
                ?>
              </select>
              <label for="year">Year</label>
            </div>

            <div class="input-field">
              <i class="prefix fas fa-list-ol"></i>
              <input id="rollNo" type="text" class="validate" name="r" required>
              <label for="rollNo">Roll Number</label>
            </div>

            <button class="btn waves-effect waves-light" type="submit">Submit</button>
            <button class="btn waves-effect waves-light" id="register" onclick="window.location.href='newcandidate.html'"  type="button"  > Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Materialize JavaScript -->
  <script>
    const regbtn=document.getElementById('register');
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize Materialize select dropdown
      var elems = document.querySelectorAll('select');
      var instances = M.FormSelect.init(elems);

      // Check URL parameters for error and show notification
      const urlParams = new URLSearchParams(window.location.search);
      const errParam = urlParams.get('err');
      if (errParam) {
        let errorMessage = '';
        switch (errParam) {
          case 'invalid_year':
            errorMessage = 'Invalid year!';
            break;
          case 'invalid_roll':
            errorMessage = 'Invalid roll number! Please register first';
            regbtn.style.display="inline";
            break;
          default:
            errorMessage = 'An error occurred!';
        }
        M.toast({
          html: errorMessage,
          classes: 'error-toast'
        });
      }
    });
  </script>
</body>

</html>
