<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception as ReaderException;
use PhpOffice\PhpSpreadsheet\Writer\Exception as WriterException;

ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the form is submitted
if(isset($_POST['submit'])){
    // Check if a file is uploaded
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Define database connection parameters
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "testing";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        try {
            // Load the uploaded file
            $inputFileName = $_FILES['file']['tmp_name'];
            $spreadsheet = IOFactory::load($inputFileName);

            // Get the first sheet
            $sheet = $spreadsheet->getActiveSheet();

            // Iterate through each row in the sheet starting from the second row
            $rowIterator = $sheet->getRowIterator();
            $rowIterator->next(); // Skip the first row (header row)
            while ($rowIterator->valid()) {
                $row = $rowIterator->current();
                $rowData = [];
                // Iterate through each cell in the row
                foreach ($row->getCellIterator() as $cell) {
                    // Push cell value to $rowData array
                    $rowData[] = $cell->getValue();
                }
                // Check if the data already exists in the database
                $sql_check = "SELECT * FROM testingtable WHERE column1 = ? AND column2 = ? AND column3 = ? AND column4 = ? AND column5 = ?";
                $stmt_check = $conn->prepare($sql_check);
                $stmt_check->bind_param("sssss", $rowData[0], $rowData[1], $rowData[2], $rowData[3], $rowData[4]);
                $stmt_check->execute();
                $stmt_check->store_result();
                // If no rows are returned, insert the data into the database
                if ($stmt_check->num_rows == 0) {
                    $stmt_check->close();
                    // Insert data into the database
                    $sql_insert = "INSERT INTO testingtable (column1, column2, column3, column4, column5) VALUES (?, ?, ?, ?, ?)";
                    $stmt_insert = $conn->prepare($sql_insert);
                    $stmt_insert->bind_param("sssss", $rowData[0], $rowData[1], $rowData[2], $rowData[3], $rowData[4]);
                    $stmt_insert->execute();
                    $stmt_insert->close();
                } else {
                    $stmt_check->close();
                }
                $rowIterator->next(); // Move to the next row
            }

            // Close database connection
            $conn->close();

            echo '<div class="alert alert-success" role="alert">Data inserted successfully!</div>';
        } catch (ReaderException $e) {
            echo '<div class="alert alert-danger" role="alert">Error reading the file: ' . $e->getMessage() . '</div>';
        } catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert">An error occurred: ' . $e->getMessage() . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Error uploading file!</div>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Excel to Database</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Upload Excel to Database</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Choose Excel File</label>
                <input type="file" class="form-control-file" id="file" name="file">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Upload</button>
        </form>
    </div>
</body>
</html>
