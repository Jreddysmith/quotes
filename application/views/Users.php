<!DOCTYPE html>
<html>
<head>
	<title>User</title>
</head>
<body>
<a href="/Log_in_Reg/logout">Logout</a> <a href="/Quotes">Dashboard</a>

	<h3>Post by <?= $user['alias'] ?></h3>

<?php   	$count = 0;
			foreach($quotebyusers as $quotebyuser) {
				$count ++;
			}
			echo "<h3>Count: " . $count . "<br><br><br>";	
			if ($quotebyusers == null) {
				echo "<h3>This user has not contributed any quotes</h3>";

			} else {
				foreach($quotebyusers as $quotebyuser) {

?>
					<p><strong style="color: red;"><?= $quotebyuser['quoteBy'] ?>: </strong><?= $quotebyuser['message']?></p>
<?php
				}
			}
?>
</body>
</html>
