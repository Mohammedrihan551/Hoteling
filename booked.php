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
      </nav>
    <!--navbar ends-->

    <!--Date And Time Check starts-->
    <!--check with code starts-->
    <h1 style="color: gray; margin:2rem">Booking Check</h1>
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


    <!--check with code ends-->
    <!--check with date starts-->
    <form name="datecheck" method="post" 
     style="margin: 2rem;border:1px solid gray;border-radius: 0.5rem;">
        <legend style="margin:1rem;">Date Check</legend>
        <!-- Grid row -->
        <div class="form-group row" style="margin:1rem;">
          <!-- Default input -->
          <label for="inputdate3" class="col-sm-2 col-form-label" style="width:5rem">Date</label>
          <div class="col-sm-10" style="width:25rem";>
            <input type="date" class="form-control" name="bookedDate" id="inputdate3"  placeholder="First Name" required>
          </div>
        </div>
        <div class="form-group row" style="display: inline-block;margin:1.5rem">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-success btn-md" name="submitbtn" >Ckeck</button>
          </div>
        </div>
        <!-- Grid row -->
      </form>
    <!--check with date ends-->
<?php
    require "dblink.php";

    if(isset($_POST["submitbtn"])){
       $date=$_POST["bookedDate"];

       $sql="SELECT * FROM `customerdetails` where datefrom='$date' and status='BOOKED'";
       $reselt=mysqli_query($con,$sql);
        if(!$reselt){
            echo "Enable to fetch data";
        }else{
            "Fetched Data ";
        }

        echo "<div class='table-responsive' style=margin:2rem>
        <table class='table table-bordereless table-hover table-condensed small'>
          <thead><tr><th scope='col' style='color:darkcyan;'>SLNO</th>
          <th scope='col' style='color:darkslateblue;'>BOOKINGCODE</th>
          <th scope='col' style='color:darkslategray;'>FULLNAME</th>
          <th scope='col' style='color:mediumpurple;'>PHONE</th>
          <th scope='col' style='color:tomato;'> DATE-FROM</th>
          <th scope='col'style='color:tomato;'> DATE-TO</th>
          <th scope='col' style='color:mediumvioletred;'>PERSONS </th>
          <th scope='col' style='color:violet;'> TOTAL PRICE </th>
          <th scope='col' style='color:green;'> STATUS </th>
          <th scope='col' style='color:blue;'>CHECK-IN</th></tr></thead>";
              $i=1;
              $tot=0;
              while($mrow=mysqli_fetch_array($reselt)){
                $slno=$i++;
             
              echo " <form name='bookedinfrm' method='post' action='insert.php'><div class='form-group'>
           <tbody><tr>
           <td scope='row' style='color:darkcyan;font-weight:bold;width:auto;'>$slno</td>
           <td scope='row'><input type='number' value=$mrow[bookingcode] name='bookingcode'   style='color:darkslateblue;font-weight:bold;' readonly/></td>
           <td scope='row'><input type='text' value=$mrow[firstname]_$mrow[lastname] name='fullname' style='color:darkslategray;font-weight:bold;' readonly/></td>
           <td scope='row'><input type='tel' value=$mrow[phone] name='phone' style='color:mediumpurple;font-weight:bold'  readonly /></t>
           <td scope='row'><input type='date' value=$mrow[datefrom] name='datefrom'  style='color:tomato;font-weight:bold;' readonly/></td>
           <td scope='row'><input type='date' value=$mrow[dateto] name='dateto'  style='color:tomato;font-weight:bold;' readonly/></td>
           <td scope='row'><input type='number' value=$mrow[totalperson] name='totalperson'  style='color:mediumvioletred;font-weight:bold;' readonly/></td>
           <td scope='row'><input type='number' value=$mrow[price] name='totalprice'  style='color:violet;font-weight:bold;' readonly/></td>
           <td scope='row'><input  type='text' value=$mrow[status] name='status'  style='color:green;font-weight:bold' readonly/></td>
           <td scope='row'><button type='submit' class='btn btn-primary' name='checkin'>Checkin</button></td>";
           $tot=$tot+$mrow[8];  
              }
        $nrow=mysqli_num_rows($reselt);
        echo "<tr><th style='color:rebeccapurple;font-weight:bold' scope='row' colspan='9'>Number Of People Boked on ".$date." is ".$nrow."</th></tr>";
        echo "<tr><th style='color:rebeccapurple;font-weight:bold' scope='row' colspan='9'>Total Number Of People ".$tot."</th></tr>";
        echo '</table></div>';
    }

   /*display with date ends*/

   /*display with code starts*/

     if(isset($_POST["codebtn"])){
      $code=$_POST["code"];
 
      $sql="SELECT * FROM `customerdetails` where bookingcode='$code' and status='BOOKED'";
      $reselt=mysqli_query($con,$sql);
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


       echo "<div class='table-responsive' style=margin:2rem>
       <table class='table table-bordereless table-hover table-condensed small'>
         <thead><tr><th scope='col' style='color:darkcyan;'>SLNO</th>
         <th scope='col' style='color:darkslateblue;'>BOOKINGCODE</th>
         <th scope='col' style='color:darkslategray;'>FULLNAME</th>
         <th scope='col' style='color:mediumpurple;'>PHONE</th>
         <th scope='col' style='color:tomato;'> DATE-FROM</th>
         <th scope='col'style='color:tomato;'> DATE-TO</th>
         <th scope='col' style='color:mediumvioletred;'>PERSONS </th>
         <th scope='col' style='color:violet;'> TOTAL PRICE </th>
         <th scope='col' style='color:green;'> STATUS </th>
         <th scope='col' style='color:blue;'>CHECK-IN</th></tr></thead>";
             $i=1;
             $tot=0;
             while($mrow=mysqli_fetch_array($reselt)){
               $slno=$i++;
            
             echo " <form name='bookedinfrm' method='post' action='insert.php'><div class='form-group'>
          <tbody><tr>
          <td scope='row' style='color:darkcyan;font-weight:bold;width:auto;'>$slno</td>
          <td scope='row'><input type='number' value=$mrow[bookingcode] name='bookingcode'   style='color:darkslateblue;font-weight:bold;' readonly/></td>
          <td scope='row'><input type='text' value=$mrow[firstname]_$mrow[lastname] name='fullname' style='color:darkslategray;font-weight:bold;' readonly/></td>
          <td scope='row'><input type='tel' value=$mrow[phone] name='phone' style='color:mediumpurple;font-weight:bold'  readonly /></t>
          <td scope='row'><input type='date' value=$mrow[datefrom] name='datefrom'  style='color:tomato;font-weight:bold;' readonly/></td>
          <td scope='row'><input type='date' value=$mrow[dateto] name='dateto'  style='color:tomato;font-weight:bold;' readonly/></td>
          <td scope='row'><input type='number' value=$mrow[totalperson] name='totalperson'  style='color:mediumvioletred;font-weight:bold;' readonly/></td>
          <td scope='row'><input type='number' value=$mrow[price] name='totalprice'  style='color:violet;font-weight:bold;' readonly/></td>
          <td scope='row'><input  type='text' value=$mrow[status] name='status'  style='color:green;font-weight:bold' readonly/></td>
          <td scope='row'><button type='submit' class='btn btn-primary' name='checkin'>Checkin</button></td>";
          $tot=$tot+$mrow[8];  
             }     
    $nrow=mysqli_num_rows($reselt);
    echo "<tr><th style='color:rebeccapurple;font-weight:bold' scope='row' colspan='9'>Total Number Of People ".$tot."</th></tr>";
    echo '</table></div>';
         
     }
  
  /*Display With Code Ends*/
    /*Displaying Booked People Ends*/

    /*Diplaying all booked starts*/
    
    $sql="SELECT * FROM `customerdetails` where status='BOOKED'";
       $reselt=mysqli_query($con,$sql);
        if(!$reselt){
            echo "Enable to fetch data";
        }else{
            "Fetched Data ";
        }

    echo "<div class='table-responsive' style=margin:2rem>
   <table class='table table-bordereless table-hover table-condensed small'>
     <thead><tr><th scope='col' style='color:darkcyan;'>SLNO</th>
     <th scope='col' style='color:darkslateblue;'>BOOKINGCODE</th>
     <th scope='col' style='color:darkslategray;'>FULLNAME</th>
     <th scope='col' style='color:mediumpurple;'>PHONE</th>
     <th scope='col' style='color:tomato;'> DATE-FROM</th>
     <th scope='col'style='color:tomato;'> DATE-TO</th>
     <th scope='col' style='color:mediumvioletred;'>PERSONS </th>
     <th scope='col' style='color:violet;'> TOTAL PRICE </th>
     <th scope='col' style='color:green;'> STATUS </th>
     <th scope='col' style='color:blue;'>CHECK-IN</th></tr></thead>";
         $i=1;
         $tot=0;
         while($mrow=mysqli_fetch_array($reselt)){
           $slno=$i++;
        
         echo " <form name='bookedinfrm' method='post' action='insert.php'><div class='form-group'>
      <tbody><tr>
     <td scope='row' style='color:darkcyan;font-weight:bold;width:auto;'>$slno</td>
      <td scope='row'><input type='number' value=$mrow[bookingcode] name='bookingcode'   style='color:darkslateblue;font-weight:bold;' readonly/></td>
      <td scope='row'><input type='text' value=$mrow[firstname]_$mrow[lastname] name='fullname' style='color:darkslategray;font-weight:bold;' readonly/></td>
      <td scope='row'><input type='tel' value=$mrow[phone] name='phone' style='color:mediumpurple;font-weight:bold'  readonly /></t>
      <td scope='row'><input type='date' value=$mrow[datefrom] name='datefrom'  style='color:tomato;font-weight:bold;' readonly/></td>
      <td scope='row'><input type='date' value=$mrow[dateto] name='dateto'  style='color:tomato;font-weight:bold;' readonly/></td>
      <td scope='row'><input type='number' value=$mrow[totalperson] name='totalperson'  style='color:mediumvioletred;font-weight:bold;' readonly/></td>
      <td scope='row'><input type='number' value=$mrow[price] name='totalprice'  style='color:violet;font-weight:bold;' readonly/></td>
      <td scope='row'><input  type='text' value=$mrow[status] name='status'  style='color:green;font-weight:bold' readonly/></td>
      <td scope='row'><button type='submit' class='btn btn-primary' name='checkin'>Checkin</button></td>";
      $tot=$tot+$mrow[8];  
         }
   $nrow=mysqli_num_rows($reselt);
   echo "<tr><th style='color:rebeccapurple;font-weight:bold' scope='row' colspan='9'>Number Of People Boked on ".$nrow."</th></tr>";
   echo "<tr><th style='color:rebeccapurple;font-weight:bold' scope='row' colspan='9'>Total Number Of People ".$tot."</th></tr>";
   echo '</table></div>';
   
?>
    <!--Diplaying all booked Ends-->
    
      <script src="booking.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>