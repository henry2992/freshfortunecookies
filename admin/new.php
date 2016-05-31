<!-- DataBase Connection -->
     <?php
		  include '../db.php';
	?>
<!-- End Of DataBase Connection -->
<?php 
	if($_POST && isset($_POST['email'],
						$_POST['pwd']
					   )) {
	    $email = $_POST['email'];
		$pwd  = $_POST['pwd'];
  		$pwdHash=password_hash($pwd,PASSWORD_DEFAULT);

 		$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	
		if (empty($email)) {
	      $error_message = 'Please enter a valid email';
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error_message = 'Invalid email format';
		}
		else {
			try {
				$sql = "INSERT INTO admin(email, pwd) VALUES (:email, :pwdHash)";
			    $stmt = $db->prepare($sql);
			    $stmt->bindParam(':email', $email,PDO::PARAM_STR);
			    $stmt->bindParam(':pwdHash', $pwdHash,PDO::PARAM_STR);
			    $rows = $stmt->execute();
			    header("Location: index.php");
			} catch(PDOException $e) {
				if ($e->errorInfo[1] == 1062) {
					$error_message = "Duplicate Admin";
				} else{
			   	 	echo $e->getMessage();
			    }
			} 	
    	}
	 }
?>


		<div class="login container">
			<h3>Admin</h3>
			    <?php
			    if(!empty ($error_message)){ ?>
			      <p class="error"> 
			      <?php echo $error_message; ?>
			      </p>
			    <?php } ?>
		    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
			    <div id="data">
					<!-- Get Email -->
					<label class="form-label" for="email">Email:</label>
					<input type="text" name="email" id="email" value= '<?php echo (isset($email) ? $email : null); ?>' />
					<br>
					<!-- Get Password -->
					<label class="form-label" for="pwd">Password:</label>
						 <input type="password" name="pwd" id="pwd" value= '<?php echo (isset($pwd) ? $pwd : null); ?>'>
						<br>
					<!-- Submit Button -->
					<input  class="login-btn btn btn-primary btn-lg" type="submit" name="feedback" value="Submit">  			
				</div>
			</form>
		</div>
	</body>
</html>
