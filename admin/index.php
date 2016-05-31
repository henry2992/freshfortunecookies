<!-- DataBase Connection -->
<?php
      include '../db.php';
?>
<!-- End Of DataBase Connection -->

<?php
   if($_POST && isset( $_POST['email'], 
             $_POST['pwd']
             )) {

      $email = $_POST['email'];
      $pwd = $_POST['pwd'];
      $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

      if (empty($email)) {
          $error_message = 'Please enter an email';
      } else if (empty($pwd)) {
        $error_message = 'Please enter a password';
      } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error_message = 'Invalid email format';
      } 
      else {
        
        $sql="SELECT email, pwd, approved from admin where Email ='$email' and approved = '1' ";

        $sth = $db ->prepare($sql);
        $sth->execute();
        $result = $sth ->fetchAll();

        
       if ($sth->rowCount() > 0) {
        $check_email = $result[0][0];
        $checkPwd =   $result[0][1];
          if ($check_email != $email ) {
              $error_message = "The user is not Registered.";
          } elseif (password_verify($pwd,$checkPwd) == false) {
              $error_message = "The password that you have entered is incorrect.";
          } else {
            header("Location: approve.php");
          } 
        } else {
           echo "The user is not Registered.";
        }

      }
  }
      
?> 

<!-- Session Start -->
<?php
  session_start();
  //On page 1
  if(isset($email)){
    $_SESSION['email'] = $email;
  } 
?>


<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Chicago Inn</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css"/> 
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>

    <!-- Jquery and JqueryUI Connection -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  </head>
  <body>

    <div class="login container">  
      <h3>Enter your username and password </h3>
        <?php
            if(!empty ($error_message)){ ?>
              <p class="error"> 
              <?php echo $error_message; ?>
              </p>
        <?php } ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                  
                <div id="data">
                <!-- Get Email--> 
                <label class="form-label "for="email">Email:</label> 
                <input type="text" name="email" id="email" value= '<?php echo (isset($email) ? $email : null); ?>' />
                <br>
                <label  class="form-label" for="pwd">Password:</label>
                <input type="password" name="pwd" id="pwd" value= '<?php echo (isset($pwd) ? $pwd : null); ?>'>
                <br>
                 

                <!-- Submit Button -->
                <input class="login-btn btn btn-primary btn-lg" type="submit" name="user_register" value="Log In">       
              </div>
          </form>
    </div>
  </body>
</html>