<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booked</title>
  <link rel="stylesheet" href="booking.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
   <!-- Navbar -->
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
                <a class="nav-link" href="check.php">Check</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" style="color:white;"  href="chechk.php" id="navbarDropdown" role="button" 
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
      </nav>
    <!--navbar ends-->



<!--check with code starts-->
 <h1 style="color: gray; margin:2rem">Check</h1>
    <form name="codecheck"  method="post" 
     style="margin: 2rem;border:1px solid gray;border-radius: 0.5rem;">
        <legend style="margin:1rem;">Code Check</legend>
        <!-- Grid row -->
        <div class="form-group row" style="margin:1rem;">
          <!-- Default input -->
          <label for="inputText3" class="col-sm-2 col-form-label" style="width:5rem">Code</label>
          <div class="col-sm-10" style="width:25rem";>
            <input type="text" class="form-control" name="code" id="inputText3"  placeholder="BookingCode" required>
          </div>
        </div>
        <div class="form-group row" style="display: inline-block;margin:1.5rem">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-success btn-md" name="codebtn" >Ckeck</button>
          </div>
        </div>
        <!-- Grid row -->
      </form>

<?php
 require "dblink.php";

  if(isset($_POST["codebtn"])){
    $code=$_POST["code"];

    $sql="SELECT * FROM `customerdetails` where bookingcode='$code'";
    $reselt=mysqli_query($con,$sql);
    $mrow=mysqli_fetch_array($reselt);

    if(!$reselt){
        echo '<div class="alert alert-danger" role="alert" style="margin:2rem;">
        <h4 class="alert-heading">FAILED!</h4>
         <p>NO,DATA CANOT BE FETCHED.</p>
          <hr>
        <p class="mb-0">FAILED.</p>
        </div>';
       }else{
         '<div class="alert alert-success" role="alert" style="margin:2rem;">
        <h4 class="alert-heading">SUCCESSFULLY!</h4>
          <p>YES,FETCHED DATA SUCCESSFULLY.</p>
          <hr>
         <p class="mb-0">SUCCESS.</p>
       </div>';
       }


       echo "<div class='card mb-4' style='margin: 2rem;'>
       <div class='card-body'>
     <h2 style='color:slateblue;'>BOOKED DETAILS</h2>
     <hr>
     <div class='row'>
       <div class='col-sm-3'>
         <p class='mb-0' style='color:blue;font-weight:bolder'>Booking Code</p>
       </div>
       <div class='col-sm-9'>
       <p class='mb-0' style='color:blue;font-weight:bolder'>$mrow[0]</p>
       </div>
     </div>
     <hr>
     <div class='row'>
       <div class='col-sm-3'>
         <p class='mb-0' style='color:lightseagreen;font-weight:bold'>First Name</p>
       </div>
       <div class='col-sm-9'>
         <p class=' mb-0' style='color:lightseagreen;font-weight:bold'>$mrow[1]</p>
       </div>
     </div>
     <hr>
     <div class='row'>
       <div class='col-sm-3'>
         <p class='mb-0' style='color:lightseagreen;font-weight:bold'>Last Name</p>
       </div>
       <div class='col-sm-9'>
         <p class=' mb-0' style='color:lightseagreen;font-weight:bold'>$mrow[2]</p>
       </div>
     </div>
     <hr>
     <div class='row'>
       <div class='col-sm-3'>
         <p class='mb-0' style='color:indigo;font-weight:bold'>Phone</p>
       </div>
       <div class='col-sm-9'>
         <p class=' mb-0' style='color:indigo;font-weight:bold'>$mrow[3]</p>
       </div>
     </div>
     <hr>
     <div class='row'>
       <div class='col-sm-3'>
         <p class='mb-0' style='color:darkslategrey;font-weight:bold'>E-mail</p>
       </div>
       <div class='col-sm-9'>
         <p class=' mb-0' style='color:darkslategrey;font-weight:bold'>$mrow[4]</p>
       </div>
     </div>
     <hr>
     <div class='row'>
       <div class='col-sm-3'>
         <p class='mb-0' style='color:darkmagenta;font-weight:bold'>From</p>
       </div>
       <div class='col-sm-9'>
       <p class='mb-0' style='color:darkmagenta;font-weight:bold'>$mrow[5]</p>
       </div>
     </div>
     <hr>
     <div class='row'>
       <div class='col-sm-3'>
         <p class='mb-0' style='color:darkmagenta;;font-weight:bold'>To</p>
       </div>
       <div class='col-sm-9'>
         <p class='mb-0' style='color:darkmagenta;font-weight:bold'>$mrow[6]</p>
       </div>
     </div>
     <hr>
     <div class='row'>
       <div class='col-sm-3'>
         <p class='mb-0' style='color:thistel;font-weight:bold'>People</p>
       </div>
       <div class='col-sm-9'>
         <p class='mb-0' style='color:thistel;font-weight:bold'>$mrow[8]</p>
       </div>
     </div>
     <hr>
     <div class='row'>
       <div class='col-sm-3'>
         <p class='mb-0' style='color:violet;font-weight:bold'>Room</p>
       </div>
       <div class='col-sm-9'>
         <p class='mb-0' style='color:violet;font-weight:bold'>$mrow[9]</p>
       </div>
     </div>
     <hr>
     <div class='row'>
     <div class='col-sm-3'>
       <p class='mb-0' style='color:blueviolet;font-weight:bold'>Days</p>
     </div>
     <div class='col-sm-9'>
       <p  mb-0' style='color:blueviolet;font-weight:bold'>$mrow[8]</p>
     </div>
     <hr>
     <div class='row'>
     <div class='col-sm-3'>
       <p class='mb-0' style='color:green;font-weight:bold'>STATUS</p>
     </div>
     <div class='col-sm-9'>
       <p  mb-0' style='color:green;font-weight:bold'>$mrow[11]</p>
     </div>
     <hr>
     <div class='row'>
       <div class='col-sm-3'>
         <p class='mb-0' style='color:mediumvioletred;font-weight:bolder'>₹ TotalPrice</p>
       </div>
       <div class='col-sm-9'>
       <p class='mb-0' style='color:mediumvioletred;font-weight:bolder'>₹ $mrow[10]</p>
       </div>
     </div>
   </div>
     
   </div>
   </div>";
      }  
/*Display With Code Ends*/

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>