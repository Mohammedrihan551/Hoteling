<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Insertion | Page</title>
</head>

<body>

  <?php
  require "dblink.php";
  /*Checkin*/
  if (isset($_POST["checkined"])) {
    echo "";

    echo  '<nav class="navbar navbar-expand-lg navbar-light bg-info">
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

    $code = $_POST["code"];
    $fullname = $_POST["fullname"];
    $phone = $_POST["phone"];
    $datefrom = $_POST["datefrom"];
    $dateto = $_POST["dateto"];
    $totalperson = $_POST["totalperson"];
    $status = $_POST["status"];
    $datechekedin = $_POST["date"];
    $timecheckedin = $_POST["time"];

    require "dblink.php";

    $sql = "UPDATE `customerdetails` SET `status` = 'CHECKEDIN' WHERE `customerdetails`.`bookingcode` = $code";
    $result = mysqli_query($con, $sql);
    if (!$result) {
      echo '<div class="alert alert-danger" role="alert" style="margin:2rem;">
      <h4 class="alert-heading">FAILED!</h4>
       <p>NO,UPDATE NOT SAVED.</p>
        <hr>
      <p class="mb-0">FAILED.</p>
      </div>';
    } else {
      '<div class="alert alert-success" role="alert" style="margin:2rem;">
      <h4 class="alert-heading">SUCCESSFULLY!</h4>
        <p>YES,UPDATE SAVED SUCCESSFULLY.</p>
        <hr>
       <p class="mb-0">SUCCESS.</p>
     </div>';
    }

    $ssql = "SELECT * FROM `customerdetails` where bookingcode='$code'";
    $sresult = mysqli_query($con, $ssql);
    while ($srow = mysqli_fetch_array($sresult)) {
      $newstatus = $srow[11];
    }

    $isql = "INSERT INTO `customercheckin` (`bookingcode`, `fullname`,`phone`, `datecheckin`, `timecheckin`,`status`,`person`) 
    VALUES ('$code', ' $fullname',$phone, '$datechekedin', '$timecheckedin','$newstatus','$totalperson');";
    $iresult = mysqli_query($con, $isql);
    if (!$iresult) {
      echo '<div class="alert alert-danger" role="alert" style="margin:2rem;">
      <h4 class="alert-heading">FAILED!</h4>
       <p>NO,RECORD NOT SAVED.</p>
        <hr>
      <p class="mb-0">FAILED.</p>
      </div>';
    } else {
      echo '<div class="alert alert-success" role="alert" style="margin:2rem;">
      <h4 class="alert-heading">SUCCESSFULLY!</h4>
        <p>YES,RECORD SAVED SUCCESSFULLY.</p>
        <hr>
       <p class="mb-0">SUCCESS.</p>
     </div>';
    }
    /*checkin Insertion And Display Starts*/
    echo "<div class='card mb-4' style='margin: 2rem;'>
   <div class='card-body'>
 <h2 style='color:mediumturquoise;'>CHECK-IN</h2>
 <hr>
 <div class='row'>
   <div class='col-sm-3'>
     <p class='mb-0' style='color:blue;font-weight:bolder'>Booking Code</p>
   </div>
   <div class='col-sm-9'>
   <p class='mb-0' style='color:blue;font-weight:bolder'>$code</p>
   </div>
 </div>
 <hr>
 <div class='row'>
   <div class='col-sm-3'>
     <p class='mb-0' style='color:mediumvioletred;font-weight:bold'>Full Name</p>
   </div>
   <div class='col-sm-9'>
     <p class='mb-0' style='color:mediumvioletred;font-weight:bold'>$fullname</p>
   </div>
 </div>
 <hr>
 <div class='row'>
   <div class='col-sm-3'>
     <p class='mb-0' style='color:rebeccapurple;font-weight:bold'>Phone</p>
   </div>
   <div class='col-sm-9'>
     <p class='mb-0' style='color:rebeccapurple;font-weight:bold'>$phone</p>
   </div>
 </div>
 <hr>
 <div class='row'>
   <div class='col-sm-3'>
     <p class='mb-0' style='color:purple;font-weight:bold'>From</p>
   </div>
   <div class='col-sm-9'>
     <p class='mb-0' style='color:purple;font-weight:bold'>$datefrom</p>
   </div>
 </div>
 <hr>
 <div class='row'>
   <div class='col-sm-3'>
     <p class='mb-0' style='color:purple;font-weight:bold'>To</p>
   </div>
   <div class='col-sm-9'>
     <p class='mb-0' style='color:purple;font-weight:bold'>$dateto</p>
   </div>
 </div>
 <hr>
 <div class='row'>
   <div class='col-sm-3'>
     <p class='mb-0' style='color:slateblue;font-weight:bold'>Person</p>
   </div>
   <div class='col-sm-9'>
   <p class='mb-0' style='color:slateblue;font-weight:bold'>$totalperson</p>
   </div>
 </div>
 <hr>
 <div class='row'>
   <div class='col-sm-3'>
     <p class='mb-0' style='color:seagreen;font-weight:bold'>Checkin-Date</p>
   </div>
   <div class='col-sm-9'>
     <p class='mb-0' style='color:seagreen;font-weight:bold'>$datechekedin</p>

     </div>
 </div>
 <hr>
 <div class='row'>
   <div class='col-sm-3'>
     <p class='mb-0' style='color:seagreen;font-weight:bold;' >Checkin-time</p>
   </div>
   <div class='col-sm-9'>
     <p class='mb-0' style='color:seagreen;font-weight:bold;'>$timecheckedin</p>
   </div>
 </div>
 <hr>
 
 
 </div>
 </div>";
    /*Checkin Insertion Ends*/
    /*Checkin Ends */
  }

  /*checkout starts*/
  /*checkout data starts */
  if (isset($_POST["checkouted"])) {
    echo  '<nav class="navbar navbar-expand-lg navbar-light bg-info">
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

    /*checkout data starts */
    $code = $_POST["code"];
    $fullname = $_POST["fullname"];
    $phone = $_POST["phone"];
    $datechekedin = $_POST["datecheckin"];
    $timecheckedin = $_POST["timecheckin"];
    $datechekedout = $_POST["date"];
    $timecheckedout = $_POST["time"];
    $status = $_POST["status"];
    $totalperson = $_POST["totalperson"];
    /*checkout data ends */

    /*checkout Insertion And Display Starts*/

    require "dblink.php";

    $sql = "UPDATE `customerdetails` SET `status` = 'CHECKEDOUT' WHERE `customerdetails`.`bookingcode` = $code";
    $result = mysqli_query($con, $sql);
    if (!$result) {
      echo '<div class="alert alert-danger" role="alert" style="margin:2rem;">
    <h4 class="alert-heading">FAILED!</h4>
     <p>NO,UPDATE NOT SAVED.</p>
      <hr>
    <p class="mb-0">FAILED.</p>
    </div>';
    } else {
      '<div class="alert alert-success" role="alert" style="margin:2rem;">
           <h4 class="alert-heading">SUCCESSFULLY!</h4>
             <p>YES,UPDATE SAVED SUCCESSFULLY.</p>
             <hr>
            <p class="mb-0">SUCCESS.</p>
          </div>';
    }

    $csql = "UPDATE `customercheckin` SET `status` = 'CHECKEDOUT' WHERE `customercheckin`.`bookingcode` = $code";
    $cresult = mysqli_query($con, $csql);
    if (!$cresult) {
      echo '<div class="alert alert-danger" role="alert" style="margin:2rem;">
          <h4 class="alert-heading">FAILED!</h4>
           <p>NO,UPDATE NOT SAVED.</p>
            <hr>
          <p class="mb-0">FAILED.</p>
          </div>';
    } else {
      '<div class="alert alert-success" role="alert" style="margin:2rem;">
           <h4 class="alert-heading">SUCCESSFULLY!</h4>
             <p>YES,UPDATE SAVED SUCCESSFULLY.</p>
             <hr>
            <p class="mb-0">SUCCESS.</p>
          </div>';
    }

    $ssql = "SELECT * FROM `customerdetails` where bookingcode='$code'";
    $sresult = mysqli_query($con, $ssql);
    while ($srow = mysqli_fetch_array($sresult)) {
      $newstatus = $srow[11];
    }

    $isql = "INSERT INTO `customercheckout` (`bookingcode`, `fullname`, `phone`, `datecheckout`, `timecheckout`, `status`, `person`)
   VALUES ('$code', '$fullname', '$phone', '$datechekedout', '$timecheckedout', '$newstatus', '$totalperson')";
    $iresult = mysqli_query($con, $isql);
    if (!$iresult) {
      echo '<div class="alert alert-danger" role="alert" style="margin:2rem;">
          <h4 class="alert-heading">FAILED!</h4>
          <p>NO,RECORD NOT SAVED.</p>
          <hr>
            <p class="mb-0">FAILED.</p>
          </div>';
    } else {
      echo '<div class="alert alert-success" role="alert" style="margin:2rem;">
     <h4 class="alert-heading">SUCCESSFULLY!</h4>
     <p>YES,RECORD SAVED SUCCESSFULLY.</p>
     <hr>
     <p class="mb-0">SUCCESS.</p>
    </div>';
    }


    echo "<div class='card mb-4' style='margin: 2rem;'>
     <div class='card-body'>
      <h2 style='color:mediumturquoise;'>CHECK-OUT</h2>
      <hr>
      <div class='row'>
      <div class='col-sm-3'>
       <p class='mb-0' style='color:blue;font-weight:bolder'>Booking Code</p>
      </div>
      <div class='col-sm-9'>
     <p class='mb-0' style='color:blue;font-weight:bolder'>$code</p>
     </div>
      </div>
      <hr>
      <div class='row'>
      <div class='col-sm-3'>
       <p class='mb-0' style='color:mediumvioletred;font-weight:bold'>Full Name</p>
      </div>
     <div class='col-sm-9'>
       <p class='mb-0' style='color:mediumvioletred;font-weight:bold'>$fullname</p>
     </div>
    </div>
    <hr>
    <div class='row'>
     <div class='col-sm-3'>
       <p class='mb-0' style='color:rebeccapurple;font-weight:bold'>Phone</p>
     </div>
     <div class='col-sm-9'>
       <p class='mb-0' style='color:rebeccapurple;font-weight:bold'>$phone</p>
     </div>
    </div>
    <hr>
    <div class='row'>
     <div class='col-sm-3'>
       <p class='mb-0' style='color:purple;font-weight:bold'>Checkin|date</p>
     </div>
     <div class='col-sm-9'>
       <p class='mb-0' style='color:purple;font-weight:bold'>$datechekedin</p>
     </div>
    </div>
    <hr>
    <div class='row'>
     <div class='col-sm-3'>
       <p class='mb-0' style='color:purple;font-weight:bold'>Checkin|time</p>
     </div>
     <div class='col-sm-9'>
       <p class='mb-0' style='color:purple;font-weight:bold'>$timecheckedin</p>
     </div>
    </div>
    <hr>
    <div class='row'>
     <div class='col-sm-3'>
       <p class='mb-0' style='color:slateblue;font-weight:bold'>Person</p>
     </div>
     <div class='col-sm-9'>
     <p class='mb-0' style='color:slateblue;font-weight:bold'>$totalperson</p>
     </div>
    </div>
    <hr>
    <div class='row'>
     <div class='col-sm-3'>
       <p class='mb-0' style='color:seagreen;font-weight:bold'>Checkout|Date</p>
     </div>
     <div class='col-sm-9'>
       <p class='mb-0' style='color:seagreen;font-weight:bold'>$datechekedout</p>
    
       </div>
    </div>
    <hr>
    <div class='row'>
     <div class='col-sm-3'>
       <p class='mb-0' style='color:seagreen;font-weight:bold;' >Checkout|Time</p>
     </div>
     <div class='col-sm-9'>
       <p class='mb-0' style='color:seagreen;font-weight:bold;'>$timecheckedout</p>
     </div>
    </div>
    <hr>
    <div class='row'>
     <div class='col-sm-3'>
       <p class='mb-0' style='color:seagreen;font-weight:bold;' >Status</p>
     </div>
     <div class='col-sm-9'>
       <p class='mb-0' style='color:seagreen;font-weight:bold;'>$status</p>
     </div>
    </div>
    <hr>
    
    
    </div>
    </div>";
  }
  /*Checkin Insertion display Ends*/
  /* checkout ends*/
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>