<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Board Of Secondary Education</title>
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    body {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
      background-color: #f0f0f0;
    }

    main {
      flex: 1 0 auto;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-container {
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }
    span{
        color:black;
    }
  </style>
</head>
<body>
  <main>
    <div class="container form-container">
      <h2 class="center-align">Select an Option</h2>
      
      <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selected_option = $_POST['option'];
        echo "<p class='center-align'>You selected: <strong>$selected_option</strong></p>";
        if($selected_option=='OTET'){
            header('location:./otet/');
            exit();
        }
        if($selected_option=='OSSTET'){
            header('location:./osstet/');
            exit();
        }
      }
      ?>

      <form class="col s12" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p>
          <label>
            <input class="with-gap" name="option" type="radio" value="OTET" checked />
            <span><i class="material-icons">school</i> OTET</span>
          </label>
        </p>
        <p>
          <label>
            <input class="with-gap" name="option" type="radio" value="OSSTET" />
            <span><i class="material-icons">book</i> OSSTET</span>
          </label>
        </p>
        <p>
          <label>
            <input class="with-gap" name="option" type="radio" value="Single Subject" />
            <span><i class="material-icons">subject</i> Single Subject</span>
          </label>
        </p>
        <p>
          <label>
            <input class="with-gap" name="option" type="radio" value="Diploma" />
            <span><i class="material-icons">school</i> Diploma</span>
          </label>
        </p>
        <div class="center-align">
          <button class="btn waves-effect waves-light" type="submit" name="action">Submit
            <i class="material-icons right">send</i>
          </button>
        </div>
      </form>
    </div>
  </main>
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
