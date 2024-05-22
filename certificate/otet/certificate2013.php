<?php
function numberToWords($number)
{
    $ones = array(
        0 => 'zero', 1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four',
        5 => 'five', 6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine'
    );
    $teens = array(
        11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen',
        15 => 'fifteen', 16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen'
    );
    $tens = array(
        10 => 'ten', 20 => 'twenty', 30 => 'thirty', 40 => 'forty',
        50 => 'fifty', 60 => 'sixty', 70 => 'seventy', 80 => 'eighty',
        90 => 'ninety'
    );

    if ($number < 10) {
        return $ones[$number];
    } elseif ($number < 20) {
        return $teens[$number];
    } elseif ($number < 100) {
        $tens_digit = (int) ($number / 10);
        $remainder = $number % 10;
        $result = $tens[$tens_digit * 10];
        if ($remainder > 0) {
            $result .= ' ' . numberToWords($remainder);
        }
        return $result;
    } elseif ($number < 1000) {
        $hundreds_digit = (int) ($number / 100);
        $remainder = $number % 100;
        $result = $ones[$hundreds_digit] . ' hundred';
        if ($remainder > 0) {
            $result .= ' ' . numberToWords($remainder);
        }
        return $result;
    } elseif ($number < 1000000) {
        $thousands_digit = (int) ($number / 1000);
        $remainder = $number % 1000;
        $result = numberToWords($thousands_digit) . ' thousand';
        if ($remainder > 0) {
            $result .= ' ' . numberToWords($remainder);
        }
        return $result;
    } else {
        return 'Number is too large to convert to words';
    }
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $roll = trim($_GET['q']);
    $year = trim($_GET['r']);
    $table = 'OTET' . $year;
    // $dbname = 'OTET';

    // $con = new mysqli('localhost', 'root', '', 'OTET');
     $dbname='u772092216_OTET';
    $con=new mysqli('localhost','u772092216_OTET','BseOTET@123','u772092216_OTET');
    $query = 'Select * from ' . $table . ' where ROLLNO=' . $roll;
    if ($con) {
        $result = $con->query($query);
        if (mysqli_num_rows($result) > 0) {
            $row = $result->fetch_array();



            // Example usage:

        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lugrasimo&display=swap" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            height: 100vh;
            width: 100vw;
        }

        .lugrasimo-regular {
            font-family: "Lugrasimo", cursive;
            text-align: justify;
            /* font-style: normal; */
        }



        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: 100%;
            position: relative;
        }

        .custom-card {
            margin-left: 15px;
            /* Adjust as needed */
            margin-right: 15px;
            /* Adjust as needed */
        }

        .card-header {
            background-color: #fdfdfe;
            color: #100e0e;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            font-size: 16px;
        }

        .btn-print {
            background-color: #28a745;
            color: #fff;
        }

        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .certificate-info {
            display: flex;
            justify-content: space-between;
        }

        .certificate-info p {
            flex-grow: 1;
        }

        .certificate-info .left {
            text-align: left;
        }

        .certificate-info .right {
            text-align: right;
        }

        /* 
        p {
            font-family: 'Courier New', Courier, monospace;
            font-weight: 900;
        } */

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.3;
            z-index: 1;
        }

        .empty {
            height: 30px;
            width: 100%;
        }

        .empty1 {
            height: 20px;
            width: 100%;
        }

        #ItalicTest {
            font-style: italic;
            font-size: 1.4rem;
            width: auto;


        }

        #ItalicTestDate {
            font-style: italic;
            font-size: large;
        }
        .logo {
            height: 100px;
            display: block;
            /* Ensures the image behaves like a block element */
            margin: 0 auto;
            /* Centers the image horizontally */
        }

        #certificateBody {
            margin: auto;
            font-style: normal;
            text-align: justify;
            font-size: 1.2rem;
        }

        @media print {
            @page {
                size: landscape;
            }

            .card-header,
            .btn-print {
                font-weight: bolder;
                color: black;
                background-color: transparent;
            }

            .card-body {
                font-size: 824px;
                height: 21rem;
            }

            /* .row {
                margin-bottom: 10px;
            } */

            .certificate-info {
                display: flex;
                justify-content: space-between;
            }

            p {
                font-size: large;
            }

            #button {
                display: none;
            }

            .card {
                margin-top: 300px;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                height: 100%;
                position: relative;
            }

            .card-body {
                /* Remove fixed height */
                /* height: auto !important; */
                height: fit-content;
            }

            .watermark {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                opacity: 0.3;
                z-index: 1;
            }

            #printbtn {
                height: 0;
                width: 0;
            }

            abbr[title]:after {
                content: none !important;
            }
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: 100%;
            position: relative;
        }

        .card-header {
            background-color: #fdfdfe;
            color: #100e0e;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
        }
    </style>
</head>

<body>
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-24">
                <div class="card mt-4 border border-primary ">





                    <div class="card-body custom-card ">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="certificate-info">
                                    <p class="font-weight-bold mb-0 left">Serial No.: <?php echo $row['SLNO']; ?></p>
                                    <p class="font-weight-bold mb-0 right">Appl No.: <?php echo $row['OTETID']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="certificate-info">
                                    <p class="font-weight-bold mb-0 left">Certificate No.: <?php echo $row['CERTNO']; ?></p>
                                    <p class="font-weight-bold mb-0 right">Roll No.: <?php echo $row['ROLLNO']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display: flex;justify-content: space-around;align-items: center;">
                            <div class="d-block"></div>
                            <div class="card-header">
                                <div class="header-content">

                                    <h2 class="text-center mb-0">Board Of Secondary Education, Odisha</h2>
                                    <img src="logo.png" alt="BSE Odisha Logo" class="logo ">
                                </div>
                            </div>
                            <img src="<?php echo $row['PROFILEPATH'] ?>" alt="Applicant Profile Picture"
                                class=" d-block" style="height: 6rem;">
                            <!-- <img src="logo.png" alt="Watermark" class="watermark"> -->
                        </div>

                        <!-- <div class="row">
                            
                            <img src="logo.png" alt="Watermark" class="watermark">

                        </div> -->
                        <div class="empty"></div>
                        <div class="row">
                            <p class="mb-0 lugrasimo-regular font-weight-bold" id="certificateBody">Certified that <label for="" id="ItalicTest" class="sora-font"><abbr title="attribute"> <?php echo $row['CNAME']; ?></abbr> </label> son/daughter of <label for="" id="ItalicTest" class="sora-font"> <abbr title="attribute"> <?php echo $row['FNAME']; ?> </abbr> </label>
                               Dist <label for="" id="ItalicTest" class="sora-font"> <abbr title="attribute"> <?php echo $row['DISTNM']; ?></abbr> </label>  qualified the <label for="" id="ItalicTest" class="sora-font">Odisha Teacher Eligibility Test, June,2013</label>  and secured <label for="" id="ItalicTest" class="sora-font"> <abbr title="attribute"> <?php echo $row['TOTAL']; ?> (<?php echo numberToWords($row['TOTAL']); ?>) </abbr></label> marks in paper <label for="" id="ItalicTest" class="sora-font"><abbr title="attribute"> <?php echo $row['PAPEROPT']; ?></abbr></label>,<label for="" id="ItalicTest" class="sora-font"><abbr title="attribute"><?php echo $row['PAPEROPT2']; ?></abbr></label> Under category <label for="" id="ItalicTest " class="sora-font"><abbr title="attribute"> <?php echo $row['CASTE']; ?></abbr></label> .</p>
                        </div>

                        <div class="empty1"></div>
                        <!-- <div class="row">
                            <p class="mb-0 ">Date of publication of Results : <label for="" id="ItalicTest"><?php echo $row['DOP']; ?></label></p>
                        </div> -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="certificate-info  bottom-0  ">
                                    <p class="font-weight-bold mb-0 left">Date of Issue <br> <label for="" id="ItalicTestDate"></label></p>
                                    <p class="font-weight-bold mb-0 right ">
                                        <label for=""><img src="signature.png" alt="" class="text-bold" style="width: 9em; height:2em; "></label><br>
                                        SECRETARY
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="empty1">

                        </div>
                        <div class="container mt-4  border border-primary">
                            <p>
This
certificate
and
the
result
of
the
candidates
shall
be
treated
as
cancelled
at
any
time
if
the
information
furnished
by
the
candidate
in
the
OMR
Application
Form
and
OMR
answer
sheet
is
found
false/fabricated/incorrect.</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-4" id="printbtn">
                <button class="btn btn-print" id="button" onclick="window.print()">Print</button>
                   <button class="btn " id="button" onclick="window.location.href='candidateform.php'">Home</button>
            </div>
        </div>
    </div>
</body>
<script>
    let date = new Date();
    let day = date.getDate();
    if (day < 10) {
        day = "0" + day;
    }

    let month = date.getMonth();
    if (month < 10) {
        month = "0" + month
    }
    let year = date.getFullYear();
    fidate = day + "-" + month + "-" + year;

    document.getElementById('ItalicTestDate').innerText = fidate;

    window.onload = function() {
        // Get the height of the card body
        var cardBodyHeight = document.querySelector('.card-body').offsetHeight;

        // Set the height of the card body in the print page
        document.styleSheets[0].addRule('@media print', '.card-body { height: ' + cardBodyHeight + 'px !important; }');
    };
</script>

</html>