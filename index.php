<?php
     include "connection.php";
     $msg = "";
 
     // login 
 if(isset($_POST["submit"])){
      $username = mysqli_real_escape_string ($conn, $_POST["username"]);
      $password = $_POST["password"];
 
     $sql = "SELECT * FROM tbl_users WHERE email='$username' AND password = '$password'";
     $run_query = mysqli_query($conn,$sql);
     $count = mysqli_num_rows($run_query);
     if ($count == 1) {
         $row= mysqli_fetch_array($run_query);
         session_start ();
           $_SESSION["uid"] = $row["user_id"]; 
           $_SESSION["name"] = $row["Firstname"]." ".$row["Lastname"];
           $user_id =  $_SESSION["uid"];
          
           $role = $row['user_type'];
           $_SESSION["role"] = $role;
         
         echo "<script>window.location = 'dashboard'</script>";
     }else{
         $msg = "
     <div class='alert alert-warning'>
     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
     <b>Invalid Email or password</b>
     </div>
     ";
     }
 }
 

?>
<html>
 
 <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SSIMS | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name"> </h1>

            </div>
             <div class="space">

             </div>
             <div class='message-info'>
                    <?php if ($msg != "") echo $msg . "<br>" ?>
                </div>
            <form class="m-t" role="form" action="index" method="POST">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" name="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#"><small>Forgot password?</small></a>
            </form>
            <p class="m-t"> <small> All rights reserved &copy; 2021</small> </p>
        </div>
    </div> 
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>

</body>


 </html>
