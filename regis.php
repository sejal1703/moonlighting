<?php

session_start();
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!---<title> Employee Registration Form </title>--->
    <link rel="stylesheet" href="css/style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   </head>

<body>
  
<?php 

include 'dbcon.php';
if(isset($_POST['submit'])){
 $username = mysqli_real_escape_string($con,$_POST['fullName']);
 $pfnumber = mysqli_real_escape_string($con,$_POST['pfNo']);
 $email = mysqli_real_escape_string($con,$_POST['email']);
 $password = mysqli_real_escape_string($con,$_POST['password']);
 $cpassword =mysqli_real_escape_string ($con,$_POST['ConfPass']);
 $pnumber = mysqli_real_escape_string($con,$_POST['phNo']);
//  $gender = mysqli_real_escape_string($con,$_POST['gender']);

 $pass=password_hash($password,PASSWORD_BCRYPT);
 $cpass=password_hash($cpassword,PASSWORD_BCRYPT);

 $emailquery = "select * from users where email='$email' ";
 $query = mysqli_query($con,$emailquery);
 $emailcount=mysqli_num_rows($query);

 if($emailcount>0){
    echo "email already exists";
 }else{
    if($password===$cpassword){
        $insertquery="insert into users(fullName, pfNo, email, password, cnfPassword, phone) values('$username','$pfnumber',' $email','$pass','$cpass','$pnumber')";

        $iquery=mysqli_query($con,$insertquery);

        if($iquery){
            ?>
                <script>
                    alert("insert Successful");
                    </script>
                    <?php
        }else{
            ?>
            <script>
                    alert("Not inserted");
                    </script>
                    <?php
        }
    }else{
        ?>
            <script>
                    alert("password no matching");
                    </script>
                    <?php
    }
 }
}
?>
  <div class="container">

	<h2>Welcome to the MoonlightDefender portal</h2>
	<h2></h2>
    <div class="title">Employee Registration</div>
    <div class="content">
      <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">

        <div class="user-details">
          <div class="input-box">
            <label for="fullName">Full Name</label>
            <!-- <span class="details">Full Name</span> -->
            <input type="text" placeholder="Enter your name" required name="fullName">
          </div>
          <div class="input-box">
            <label for="pfNo">PF number</label>
            <!-- <span class="details">PF number</span> -->
            <input type="text" placeholder="Enter your PF number" required name="pfNo">
          </div>
          <div class="input-box">
            <label for="email">Email</label>
            <!-- <span class="details">Email</span> -->
            <input type="text" placeholder="Enter your email" required name="email">
          </div>
          <div class="input-box">
            <label for="phNo">Phone Number</label>
            <!-- <span class="details">Phone Number</span> -->
            <input type="text" placeholder="Enter your number" required name="phNo">
          </div>
          <div class="input-box">
            <label for="password">Password</label>
            <!-- <span class="details">Password</span> -->
            <input type="text" placeholder="Enter your password" required name="password">
          </div>
          <div class="input-box">
            <label for="ConfPass">Confirm Password</label>
            <!-- <span class="details">Confirm Password</span> -->
            <input type="text" placeholder="Confirm your password" required name="ConfPass">
          </div>
        </div>
        <!-- <div class="gender-details">
          <input type="radio" name="gender" id="dot-1">
          <input type="radio" name="gender" id="dot-2">
          <input type="radio" name="gender" id="dot-3">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
            </label>
          </div> -->
        <!-- </div> -->
        <div class="button">
          <input type="submit" name="submit" value="Register">
        </div>
      </form>
    </div>
  </div>

</body>
</html>