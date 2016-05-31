<?php
  	include '../db.php';	
	$sql= "SELECT * FROM messages where approved = '0' "; 

 	$sth = $db ->prepare($sql);
	$sth->execute();
	
	$result = $sth->fetchAll(PDO::FETCH_COLUMN, 0);	
?>


<?php
	session_start();
  	$email = $_SESSION['email'];
  	if ($email == null) {
  		header("location: index.php");
  	}
?>


<?php 
	if($_POST && isset($_POST['validate_quote'] )) {
	    $validate_quote = $_POST['validate_quote'];
		

		try {
			$sql="UPDATE messages SET approved = 1 WHERE message = '$validate_quote' ";
		    $stmt = $db->prepare($sql);
		    $rows = $stmt->execute();
		} catch(PDOException $e) {

			if ($e->errorInfo[1] == 1062) {
				$error_message = "Duplicate Fortune Text";
			} else{
		   	 echo $e->getMessage();
		    }
		} 	
  //   	
	 } 
?>

<?php  include '../header.php'; ?>




	<body>
		<?php
		  include 'navbar-admin.php';
		?>
		<div class="container-fluid">
			<div class="quotes row">
			
				<ul class="fortune-cookie">

					<?php if (empty($result)) { 
						echo "There are no Keeping It Real Fortune Cookies";
					} ?>

					<?php 
						foreach ($result as &$quote) {
					?>
						

						
						<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" accept-charset="UTF-8" role="form">
						    	<?php
								    if(!empty ($error_message)){ ?>
								      <p class="error"> 
								      <?php echo $error_message; ?>
								      </p>
								<?php } ?>

							<fieldset>
					    	  	<div class="form-group">

								    <p class="robotic" id="pot">
								      <label><?php echo $quote; ?></label>
								      <input name="validate_quote" type="text" id="validate_quote" class="validate_quote" value='<?php echo $quote; ?>' hidden/>
								    </p>
							
						    		<input type="submit"  class="btn btn-success fortune-btn" name="feedback" value="Approve">  
					    		</div>	
					    	</fieldset>
					    </form>

					<?php
						}
					?> 
				</ul>

			</div>
		</div>
	</body>
	
</html>


	


</html>

