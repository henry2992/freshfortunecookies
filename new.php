<?php
  	include 'db.php';	
		  	
	
?>

	<?php
    if(!empty ($error_message)){ ?>
      <p class="error"> 
      <?php echo $error_message; ?>
      </p>
    <?php } ?>

    <form action="insert_message.php" method="POST">
        
	    <div id="data">
			<!-- Get First Name -->
			<label class="form-label" for="message">First Name:</label>
			<input type="text" name="message" id="message" value= '<?php echo (isset($message) ? $message : null); ?>' />
			
			<!-- Submit Button -->
			<input  class="login-btn btn btn-primary btn-lg" type="submit" name="feedback" value="Submit">  			
		</div>
	</form>
