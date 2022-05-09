<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="booking.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


  <?php
  require "dblink.php";
  if (isset($_POST["submitBtn"])) {
    echo '<title>Booking | Page</title>
         </head>
      <body>

      
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
          <a class="navbar-brand" href="#" style="color:white;">Hoteling</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link " aria-current="page" href="index.html" style="color:white;">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="booking.html" style="color:white">Book</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="check.php" style="color:white;">Check</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdown" role="button" 
                data-bs-toggle="dropdown" aria-expanded="false">
                  Admin
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="booked.php">BOOKINGS</a></li>
                  <li><a class="dropdown-item" href="checkin.php">CHECK-IN</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="checkout.php">CHECK-OUT</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>';

    /*navbar ends*/

    $name = strtoupper($_POST["fname"]);
    $lname = strtoupper($_POST["lname"]);
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $from = $_POST["dateFrom"];
    $to = $_POST["dateTo"];
    $people = $_POST["peopleNum"];
    $room = $_POST["roomSelect"];
    $days = $_POST["difference"];
    $priceper = $_POST["priceSelect"];


    require "dblink.php";

    $code1 = substr($from, 2, 2);
    $code2 = substr($from, 5, 2);
    $code = $code1 . "" . $code2;
    $price = $priceper * $days * $people;

    $status = "BOOKED";
    $ssql = "SELECT * FROM `customerdetails`";
    $sresult = mysqli_query($con, $ssql);
    $row = mysqli_num_rows($sresult);
    $bookingcode = $code . "" . $row;

    $dsql = "SELECT * FROM `customerdetails` where bookingcode='$bookingcode'";
    $dresult = mysqli_query($con, $ssql);
    $tot = 0;
    while ($drow = mysqli_fetch_array($dresult)) {
      if ($drow[5] == $from) {
        $tot = $tot + $drow[8];
      }
    }
    $remain = $tot + $people;
    if ($remain < 100) {
      $sql = "INSERT INTO `customerdetails` (`bookingcode`, `firstname`,`lastname`, `phone`, `email`, `datefrom`, `dateto`, `totaldays`, `totalperson`, `roomtype`, `price`,`status`) VALUES
      ('$bookingcode', '$name','$lname', '$phone', '$email', '$from', '$to', '$days', '$people', '$room', '$price', '$status')";
      $result = mysqli_query($con, $sql);
      if (!$result) {
        echo "<div class='alert alert-danger' role='alert' style='margin: 2rem';>
           <h4 class='alert-heading'>FAILED!</h4>
           <p>NO,BOOKING NOT DONE.</p>
           <hr>
           <p class='mb-0'>FAILURE.</p>
          </div>";
      } else {
        echo " <div class='alert alert-success' role='alert' style='margin: 2rem'>
          <h4 class='alert-heading'>SUSSESFULLY!</h4>
          <p>BOOKING DONE SUCCESSFULLY ON $from.</p>
          <hr>
          <p class='mb-0'>SUCCESS</p>
        </div>";

        /*Booking Insertion And Display*/
        echo "<div class='card mb-4' style='margin: 2rem;'>
        <div class='card-body'>
      <h2 style='color:slateblue;'>BOOKED DETAILS</h2>
      <hr>
      <div class='row'>
        <div class='col-sm-3'>
          <p class='mb-0' style='color:blue;font-weight:bolder'>Booking Code</p>
        </div>
        <div class='col-sm-9'>
        <p class='mb-0' style='color:blue;font-weight:bolder'>$bookingcode</p>
        </div>
      </div>
      <hr>
      <div class='row'>
        <div class='col-sm-3'>
          <p class='mb-0' style='color:lightseagreen;font-weight:bold'>First Name</p>
        </div>
        <div class='col-sm-9'>
          <p class=' mb-0' style='color:lightseagreen;font-weight:bold'>$name</p>
        </div>
      </div>
      <hr>
      <div class='row'>
        <div class='col-sm-3'>
          <p class='mb-0' style='color:lightseagreen;font-weight:bold'>Last Name</p>
        </div>
        <div class='col-sm-9'>
          <p class=' mb-0' style='color:lightseagreen;font-weight:bold'>$lname</p>
        </div>
      </div>
      <hr>
      <div class='row'>
        <div class='col-sm-3'>
          <p class='mb-0' style='color:indigo;font-weight:bold'>Phone</p>
        </div>
        <div class='col-sm-9'>
          <p class=' mb-0' style='color:indigo;font-weight:bold'>$phone</p>
        </div>
      </div>
      <hr>
      <div class='row'>
        <div class='col-sm-3'>
          <p class='mb-0' style='color:darkslategrey;font-weight:bold'>E-mail</p>
        </div>
        <div class='col-sm-9'>
          <p class=' mb-0' style='color:darkslategrey;font-weight:bold'>$email</p>
        </div>
      </div>
      <hr>
      <div class='row'>
        <div class='col-sm-3'>
          <p class='mb-0' style='color:darkmagenta;font-weight:bold'>From</p>
        </div>
        <div class='col-sm-9'>
        <p class='mb-0' style='color:darkmagenta;font-weight:bold'>$from</p>
        </div>
      </div>
      <hr>
      <div class='row'>
        <div class='col-sm-3'>
          <p class='mb-0' style='color:darkmagenta;;font-weight:bold'>To</p>
        </div>
        <div class='col-sm-9'>
          <p class='mb-0' style='color:darkmagenta;font-weight:bold'>$to</p>
        </div>
      </div>
      <hr>
      <div class='row'>
        <div class='col-sm-3'>
          <p class='mb-0' style='color:thistel;font-weight:bold'>People</p>
        </div>
        <div class='col-sm-9'>
          <p class='mb-0' style='color:thistel;font-weight:bold'>$people</p>
        </div>
      </div>
      <hr>
      <div class='row'>
        <div class='col-sm-3'>
          <p class='mb-0' style='color:purple;font-weight:bold'>Room</p>
        </div>
        <div class='col-sm-9'>
          <p class='mb-0' style='color:purple;font-weight:bold'>$room</p>
        </div>
      </div>
      <hr>
      <div class='row'>
      <div class='col-sm-3'>
        <p class='mb-0' style='color:blueviolet;font-weight:bold'>Days</p>
      </div>
      <div class='col-sm-9'>
        <p  mb-0' style='color:blueviolet;font-weight:bold'>$days</p>
      </div>
      <hr>
      <div class='row'>
        <div class='col-sm-3'>
          <p class='mb-0' style='color:mediumvioletred;font-weight:bolder'>₹ TotalPrice</p>
        </div>
        <div class='col-sm-9'>
        <p class='mb-0' style='color:mediumvioletred;font-weight:bolder'>₹ $price</p>
        </div>
      </div>
    </div>
      
    </div>
    </div>";
        /*Booking Insertion Ends*/
      }
    } else {
      $remainrooms = 100 - $tot;
      echo "<div class='alert alert-danger' role='alert' style='margin: 2rem'>
           <h4 class='alert-heading'>FAILED!</h4>
           <p>ROOMS HAVE BEEN FULLED ON $from PLEASE CHOOSE ANY OTHER DATE.</p>
           <p> REMAINING ROOMS = $remainrooms ON $from .</p>
           <hr>
           <p class='mb-0'>FAILURE.</p>
          </div>";
    }
  }


  /*checkin*/
  if (isset($_POST["checkin"])) {
    echo ' 
 <title>Checkin | Page</title>  
 </head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
          <a class="navbar-brand" href="#" style="color:white;">Hoteling</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link " aria-current="page" href="index.html" style="color:white;">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="booking.html" style="color:white">Book</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="check.php" style="color:white;">Check</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdown" role="button" 
                data-bs-toggle="dropdown" aria-expanded="false">
                  Admin
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="booked.php">BOOKINGS</a></li>
                  <li><a class="dropdown-item" href="checkin.php">CHECK-IN</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="checkout.php">CHECK-OUT</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>';
    /*navbar ends*/

    /*Data From Booking starts*/
    $bookingcode = $_POST["bookingcode"];
    $fullname = $_POST["fullname"];
    $phone = $_POST["phone"];
    $datefrom = $_POST["datefrom"];
    $dateto = $_POST["dateto"];
    $totalperson = $_POST["totalperson"];
    $status = $_POST["status"];
    /*Data From Booning ends*/

    /*check-in insertion and  starts*/
    echo "<form name='checkinfrm' action='inserted.php' method='post'  style='margin: 2rem;background-color:steelblue;border-radius: 0.5rem;'>
        <legend style='margin:1rem;'>CHECK-IN</legend>

        <div class='form-group row' style='margin:1rem;'>
        <label for='inputText3' class='col-sm-2 col-form-label' style='width:5rem'>FirstName</label>
          <div class='col-sm-10' style='width:25rem';>
            <input type='text' class='form-control' name='code' value=$bookingcode id='inputText3'  placeholder='First Name' readonly>
          </div>
        </div>

        <div class='form-group row' style='margin:1rem;'>
        <label for='inputTextl3' class='col-sm-2 col-form-label' style='width:5rem'>LastName</label>
            <div class='col-sm-10' style='width:25rem';>
              <input type='text' class='form-control'value=$fullname name='fullname' id='inputTextl3' readonly>
            </div>
          </div>

        <div class='form-group row' style='margin:1rem;'>
        <label for='inputTel3' class='col-sm-2 col-form-label' style='width:5rem'>Phone</label>
          <div class='col-sm-10' style='width:25rem';>
            <input type='tel' class='form-control' value=$phone name='phone' id='inputTel3' readonly>
          </div>
        </div>

        <div class='form-group row' style='margin:1rem;'>
        <label for='inputDate3' class='col-sm-2 col-form-label' style='width:5rem'>From</label>
          <div class='col-sm-10' style='width:25rem';>
            <input type='date' class='form-control'value=$datefrom name='datefrom' id='inputDate3' readonly>
          </div>
        </div>


        <div class='form-group row' style='margin:1rem;'>
        <label for='inputDateto3' class='col-sm-2 col-form-label' style='width:5rem'>To</label>
            <div class='col-sm-10' style='width:25rem';>
              <input type='date' class='form-control' value=$dateto name='dateto' id='inputDateto3' readonly>
            </div>
          </div>
          
          <div class='form-group row' style='margin:1rem;'>
          <label for='inputRoom3' class='col-sm-2 col-form-label' style='width:5rem' >Status</label>
            <div class='col-sm-10' style='width:25rem';>
              <input type='text' class='form-control'  name='status' value=$status id='inputRoom3' readonly>
            </div>
          </div>
        
          <div class='form-group row' style='margin:1rem;'>
        <label for='inputEmail3' class='col-sm-2 col-form-label' style='width:5rem'>Persons</label>
          <div class='col-sm-10' style='width:25rem';>
            <input type='email' class='form-control' value=$totalperson name='totalperson' id='inputEmail3' readonly>
          </div>
        </div>

       <div class='form-group row' style='margin:1rem;'>
        <label for='inputnDate3' class='col-sm-2 col-form-label' style='width:5rem'>Checkin</label>
          <div class='col-sm-10' style='width:25rem';>
            <input type='date' class='form-control' name='date' id='inputnDate3' placeholder='YY-MM-DD' required>
          </div>
        </div>

        <div class='form-group row' style='margin:1rem;'>
        <label for='inputTime3' class='col-sm-2 col-form-label' style='width:5rem'>Time</label>
          <div class='col-sm-10' style='width:25rem';>
            <input type='time' class='form-control'  name='time' id='inputTime3' placeholder='YY-MM-DD' required>
          </div>
        </div>
          </div>

        <div class='form-group row' style='margin:1rem;display: inline-block;'>
          <div class='col-sm-10'>
            <button type='reset' class='btn btn-danger btn-md'>Reset</button>
          </div>
        </div>
        <div class='form-group row' style='display: inline-block;'>
          <div class='col-sm-10'>
            <button type='submit' class='btn btn-success btn-md' name='checkined' >CHECKIN</button>
          </div>
        </div>
      </form>";
  }
  /*check-in insertion and  ends*/


  /*checkout starts */
  /*Check out*/
  if (isset($_POST["checkedout"])) {

    echo ' 
  <title>Checkout | Page</title>  
  </head>
 <body>
 
     <nav class="navbar navbar-expand-lg navbar-light bg-info">
         <div class="container-fluid">
           <a class="navbar-brand" href="#" style="color:white;">Hoteling</a>
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               <li class="nav-item">
                 <a class="nav-link " aria-current="page" href="index.html" style="color:white;">Home</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="booking.html" style="color:white">Book</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="check.php" style="color:white;">Check</a>
               </li>
               <li class="nav-item dropdown">
                 <a class="nav-link dropdown-toggle"  href="#" id="navbarDropdown" role="button" 
                 data-bs-toggle="dropdown" aria-expanded="false">
                   Admin
                 </a>
                 <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                   <li><a class="dropdown-item" href="booked.php">BOOKINGS</a></li>
                   <li><a class="dropdown-item" href="checkin.php">CHECK-IN</a></li>
                   <li><hr class="dropdown-divider"></li>
                   <li><a class="dropdown-item" href="checkout.php">CHECK-OUT</a></li>
                 </ul>
               </li>
             </ul>
           </div>
         </div>
       </nav>';

    /*navbar ends*/

    $bookingcode = $_POST["bookingcode"];
    $fullname = $_POST["fullname"];
    $phone = $_POST["phone"];
    $datecheckedin = $_POST["datecheckedin"];
    $timecheckedin = $_POST["timecheckedin"];
    $status = $_POST["status"];
    $totalperson = $_POST["person"];



    /*check-in insertion and  starts*/
    echo " <form name='checkfrm' action='inserted.php'  method='post'  style='margin: 2rem;background-color:steelblue;border-radius: 0.5rem;'>
        <legend style='margin:1rem;'>CHECK-OUT</legend>

        <div class='form-group row' style='margin:1rem;'>
        <label for='inputText3' class='col-sm-2 col-form-label' style='width:5rem'>FirstName</label>
          <div class='col-sm-10' style='width:25rem';>
            <input type='text' class='form-control' name='code' value=$bookingcode id='inputText3'  placeholder='First Name' readonly>
          </div>
        </div>

        <div class='form-group row' style='margin:1rem;'>
        <label for='inputTextl3' class='col-sm-2 col-form-label' style='width:5rem'>LastName</label>
            <div class='col-sm-10' style='width:25rem';>
              <input type='text' class='form-control'value=$fullname name='fullname' id='inputTextl3' readonly>
            </div>
          </div>

        <div class='form-group row' style='margin:1rem;'>
        <label for='inputTel3' class='col-sm-2 col-form-label' style='width:5rem'>Phone</label>
          <div class='col-sm-10' style='width:25rem';>
            <input type='tel' class='form-control' value=$phone name='phone' id='inputTel3' readonly>
          </div>
        </div>

        <div class='form-group row' style='margin:1rem;'>
        <label for='inputDate3' class='col-sm-2 col-form-label' style='width:5rem'>Checkin</label>
          <div class='col-sm-10' style='width:25rem';>
            <input type='date' class='form-control'value=$datecheckedin name='datecheckin' id='inputDate3' readonly>
          </div>
        </div>


        <div class='form-group row' style='margin:1rem;'>
        <label for='inputDateto3' class='col-sm-2 col-form-label' style='width:5rem'>Checkin</label>
            <div class='col-sm-10' style='width:25rem';>
              <input type='time' class='form-control' value=$timecheckedin name='timecheckin' id='inputDateto3' readonly>
            </div>
          </div>
          
          <div class='form-group row' style='margin:1rem;'>
          <label for='inputRoom3' class='col-sm-2 col-form-label' style='width:5rem' >Status</label>
            <div class='col-sm-10' style='width:25rem';>
              <input type='text' class='form-control'  name='status' value=$status id='inputRoom3' readonly>
            </div>
          </div>
        
          <div class='form-group row' style='margin:1rem;'>
        <label for='inputEmail3' class='col-sm-2 col-form-label' style='width:5rem'>Persons</label>
          <div class='col-sm-10' style='width:25rem';>
            <input type='email' class='form-control' value=$totalperson name='totalperson' id='inputEmail3' readonly>
          </div>
        </div>

       <div class='form-group row' style='margin:1rem;'>
        <label for='inputnDate3' class='col-sm-2 col-form-label' style='width:5rem'>Checkin</label>
          <div class='col-sm-10' style='width:25rem';>
            <input type='date' class='form-control' name='date' id='inputnDate3' placeholder='YY-MM-DD' required>
          </div>
        </div>

        <div class='form-group row' style='margin:1rem;'>
        <label for='inputTime3' class='col-sm-2 col-form-label' style='width:5rem'>Time</label>
          <div class='col-sm-10' style='width:25rem';>
            <input type='time' class='form-control'  name='time' id='inputTime3' placeholder='YY-MM-DD' required>
          </div>
        </div>
          </div>

        <div class='form-group row' style='margin:1rem;display: inline-block;'>
          <div class='col-sm-10'>
            <button type='reset' class='btn btn-danger btn-md'>Reset</button>
          </div>
        </div>
        <div class='form-group row' style='display: inline-block;'>
          <div class='col-sm-10'>
            <button type='submit' class='btn btn-success btn-md' name='checkouted' >CHECKOUT</button>
          </div>
        </div>
      </form>";
  }
  /*insertion into checkout done */
  /*checkout ends */

  ?>

  <script src="booking.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>

</html>