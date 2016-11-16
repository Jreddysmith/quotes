<!DOCTYPE html>
<html>
<head>
	<title>Quotes</title>
</head>
<body>
	<div id="wrapper">
		<a class="logout" href="/log_in_reg/logout">Logout</a>
		<h1>Welcome, <?= $this->session->userdata['user']['alias'] ?> !</h1>
			
			<div style="float: left; height:700px; overflow-y: scroll; display: inline-block; vertical-align: top; width: 500px">
			<h2>Quotable Quotes</h2>

<?php   			foreach($quotes as $quote) {
?>
						<div style="border: solid black 1px">
							<p><?=$quote['quoteBy']?>:</p>				
							<p><?=$quote['message'] ?></p>
							<p><a href="/Quotes/users/<?= $quote['user_id'] ?>"> Posted BY:<?= $quote['alias']?></a><br>
							<a href="/Quotes/addFavorite/<?= $quote['id'] ?>">Add to favorites</a>
						</div>


<?php   			}
?>
			</div>



					
					<div style="float: left; height:700px; overflow-y: scroll; display: inline-block; vertical-align: top; width: 500px margin-bottom: 300px">
						<h2>Your Favorites</h2>

<?php   			if ($favorites == null) {
						echo "<h3>You don't have any favorite quotes yet, please add some from the left</h3>";
					} else {
						foreach($favorites as $favorite) {
					
?>
					<div style="border: solid black 1px">
						<p><?=$favorite['quoteBy']?>:</p>
						<p><?= $favorite['message'] ?></p>
						Post by: <a href="/Quotes/users/<?= $favorite['user_id'] ?>"><?= $favorite['alias']?></a><br>
						<a href="/Quotes/removeFavorite/<?= $favorite['quote_id'] ?>">Remove From List</a>
					</div>
								

<?php   			}
						}
?>			
					</div>			
				
				<div>
<?php		
			if($this->session->flashdata("messages")) {
				echo $this->session->flashdata("messages");
			}
?>
			<div style="position: fixed; bottom: 0; width: 100%;" >
				<h3>Contribute a Quote:</h3>
				<form action="/Quotes/contribute" method="post">
							Quoted by: <input type="text" name="quoteBy"><br>
							Message: <input type="text" name="message"><br>
					<input type="submit" value="Submit">
				</form>
				
			</div>
</body>
</html>
