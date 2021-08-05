<?php
   include 'auth.php';
   if(isset($_COOKIE['username']) and isset($_COOKIE['token'])){
  $username=$_COOKIE['username'];
  $token=$_COOKIE['token'];
  if(do_verify_session($username,$token)){
    header("Location:/home.php");
  }else{
    header("Location:/signin.php");
  }
   }
   $flag=0;
   if(!isset($_GET['verify']) and isset($_POST['username']) and isset($_POST['password']) and isset($_POST['cpassword'])){
     $username=$_POST['username'];
     $password=$_POST['password'];
     $cpassword=$_POST['cpassword'];
      if($password==$cpassword){
        if(do_signup($username,$password) == 1){
        header("Location:/signup.php?verify=$username");
      }else{
        $flag=-2;
      }
    }else{
      $flag=-1;
    }
   }
   
  if(isset($_GET['verify']) or isset($_POST['otp'])){
     $otp=$_POST['otp'];
     $username=$_GET['verify'];
     if(isset($_POST['otp'])){
       if(do_verify_signup($username,$otp)){
        header("Location:/signin.php?signup=success"); 
        exit();
       }else{
      $flag=-3;
       }
     }
   }
 ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
    <title>Instagram</title>
    <!-- External css -->
    <link rel="stylesheet" href="style.css">
    <!-- Font awesome link -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
</head>
<body>

    <div id="wrapper">
        <div class="container">
            <div class="phone-app-demo"></div>
            <div class="form-data">
      <?php if(isset($_GET['verify'])){?>
       <form class="form-verify" action="signup.php?verify=<?php echo $username; ?>" method="Post">
           <h1>Please Verify:)</h1>
         <?php
        if($flag==-3){
          ?>        
          <div class="alert alert-danger" role="alert">
          Invalid otp,try again?
          </div>
           <?php }
           ?>
          <input type="text" placeholder="Enter otp" name= "otp" required> 
                    
          <button class="form-btn" type="submit">verify</button>
                    
         </form>
      
      
               
                <?php }else{ ?>   
               <form class="form-signup" action="signup.php" method="Post">
        <?php
        if($flag==-1){
          ?>        
          <div class="alert alert-success" role="alert">
          Password and confirm password does not match
          </div>
        <?php }else if($flag==-2){
          ?>
            <div class="alert alert-danger" role="alert">
          Cannot signup, username already exists.         
           </div>
           <?php }
           ?>

                    <div class="header">
                      <img src="https://i.imgur.com/zqpwkLQ.png" > 
                     </div>
                    <input type="text" placeholder="Username" name="username" required>
                    <input type="password" placeholder="Password" name="password" >
          <input type="password" placeholder="Confirm Password" name="cpassword" >
                    <input type="hidden" name="form_id" value="signup_form">
          <button class="form-btn" type="submit">Signup</button>
          <?php } ?>
              
                    
                   <h4>Have an account?<h4><a href="/signin.php" class="sg"><h3> Sign-in</h3></a> 
                </form>       
        
      
                </div>
            </div>
        </div>
           
        <footer>
            <div class="container">
                <nav class="footer-nav">
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Jobs</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Terms</a></li>
                        <li><a href="#">Profiles</a></li>
                        <li><a href="#">Languages</a></li>
                    </ul>
                </nav>
                <div class="copyright-notice">
                    &copy: 2019 Complaints
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
