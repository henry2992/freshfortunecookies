<?php
  include 'db.php';
 
 	$sql= "SELECT * FROM messages where approved = '1' "; 

 	$sth = $db ->prepare($sql);
	$sth->execute();
	// $result = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
	$result = $sth ->fetchAll();
	// var_dump($result)
?>
<?php  include 'header.php'; ?>
<body>
	<?php include 'navbar.php'; ?>
	<div id="bg">
		<div class="fortune-text">
			<div class="oval-thought cookie-quote">
			    <h3 class="fortune-heading">
					<?php 
						$fortune =  $result[array_rand($result)];
						echo $fortune[0];
						$emotion = $fortune[2];
					?>
				</h3>
				<ul class="creatures" id="creatures">
					<?php if ($emotion == 'sad') { 
							echo file_get_contents("emotions/sad.html");
						} elseif ($emotion == 'surprised'){
							echo file_get_contents("emotions/surprised.html");
						} elseif ($emotion == 'confused'){
							echo file_get_contents("emotions/confused.html");
						} else {
							echo file_get_contents("emotions/frustrated.html");
						}
					?>
				</ul>
			</div>
			<img class="fc-img" src="images/fc1.png"> 
			<a class="anchor-tweet" href="https://twitter.com/intent/tweet?text=<?php echo $fortune[0]; ?> - Baked By@freshdesignnews"  target="_blank" ><button class="example twitter">Tweet this!</button></a>
				<button onclick="gogogo()" class="example facebook">Share this!</button>	
		</div>
		<div class="powered">
			<h1>Powered by <a href="http://freshdesignstudio.com" target="_blank">Fresh Design Studio</a></h1>
		</div>
	</div>
</body>

	
	<script type="text/javascript">
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));

		// async init once loading is done
		window.fbAsyncInit = function() {
		  FB.init({appId: 1603209240007176, status: false});
		};
	</script>
	<script>
		function gogogo() {
		  var data = <?php echo json_encode($fortune); ?>;
		  FB.ui({
		    method: 'feed',
		    link: 'http://keepingitrealfortunecookies.com/',
		    picture: 'http://keepingitrealfortunecookies.com/images/fc1.png',
		    name:  data,
		    caption: 'Keeping it real fortune cookies',
		  });
		}
	</script>



</html>

	



    
    







