<?php
	include 'db.php';
?>

<?php 
	if($_POST && isset($_POST['ftext'], $_POST['emotions'])) {
	    $ftext = $_POST['ftext'];
		$emotions = $_POST['emotions'];
		$robotest = $_POST['robotest'];


		if (empty($ftext)) {
	      $error_message = 'Please enter a valid fortune text';
		} else if (strlen($ftext) > 250) {
			$error_message = 'This fortune text is way to big';
		} else if ($robotest) {
			$error_message = "You are a robot.";
		} 
		else {
			try {
				$sql = "INSERT INTO messages(message, emotion) VALUES (:ftext, :emotions)";
			    $stmt = $db->prepare($sql);
			    $stmt->bindParam(':ftext', $ftext,PDO::PARAM_STR);
			    $stmt->bindParam(':emotions', $emotions,PDO::PARAM_STR);
			    $rows = $stmt->execute();
			    header("Location: index.php");
			} catch(PDOException $e) {

				if ($e->errorInfo[1] == 1062) {
					$error_message = "Duplicate Fortune Text";
				} else{
			   	 echo $e->getMessage();
			    }
			} 	
    	}
	 } 
?>


<?php include 'header.php'; ?>
	<body>
	 	<?php include 'navbar.php'; ?>
		<div id="bg-insert">
			<div class="container fortune-form">
			    <div class="row vertical-offset-100">
			    	<div class="col-md-6 col-md-offset-3">
			    		<div class="panel panel-default">
						  	<div class="panel-heading">
						    	<h3 class="insert-tex-title panel-title">New Keeping It Real Fortune Cookies</h3>
						    	<label class="pen"style="display: none;" for="name">title</label>
						  		<p class="iconicfill-pen-alt2"></p>
						 	</div>
						  	<div class="panel-body">
						    	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" accept-charset="UTF-8" role="form">
						    	<?php
								    if(!empty ($error_message)){ ?>
								      <p class="error"> 
								      <?php echo $error_message; ?>
								      </p>
								<?php } ?>
			                    <fieldset>
							    	  	<div class="form-group">
								    		<textarea  rows="4" class="form-control" onkeyup="countChar(this)" type="text" placeholder="Type Fortune Cookie Text Here"  name="ftext" id="ftext" value= '<?php echo (isset($ftext) ? $ftext : null); ?>'></textarea>
								    		 <!-- The following field is for robots only, invisible to humans: -->
										    <p class="robotic" id="pot">
										      <label>If you're human leave this blank:</label>
										      <input name="robotest" type="text" id="robotest" class="robotest" />
										    </p>
									    	<div class="emotions-insert">
									    		<label for="discount_type">CHOOSE A EMOTION:</label>
									    		<select  name="emotions" id="emotions">
				  										<option value="sad">SAD</option>
				  										<option value="sad">SURPRISED</option>
				  										<option value="sad">CONFUSED</option>
				  										<option value="sad">FRUSTRATED</option>
												</select>
											</div>

								    		<p style="font-size: 30px; float: right;"><span id="charNum">0</span>/250</p>
								    		<input type="submit"  class="btn btn-lg btn-success btn-block fortune-btn" name="feedback" value="Submit">  
							    		</div>	
						    	</fieldset>
						      	</form>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div> 
	</body>

	<script type="text/javascript">
		// jquery transit is used to handle the animation
		   $('textarea').focusin(function() {
		        $('.pen').transition({x:'0px'},500,'ease').next()
		        .transition({x:'5px'},500, 'ease');
				//setTimeout needed for Chrome, for some reson there is no animation from left to right, the pen is immediately present. Slight delay to adding the animation class fixes it
		         setTimeout(function(){
		            $('.pen').next().addClass('move-pen');
		          },100);
		        
		        $('textarea').focusout(function() {
		         $('.pen').transition({x:'0px'},500,'ease').next().transition({x:'0px'},500, 'ease').removeClass('move-pen');
		        });
		    });
	</script>

	<script type="text/javascript">
      function countChar(val) {
        var len = val.value.length;
        if (len >= 251) {
          val.value = val.value.substring(0, 251);
        } else {
          $('#charNum').text(len);
        }
      };
	</script>
	
</html>


