<!DOCTYPE html>
<html>
<head>
	<title>admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style type="text/css">
		.canhead{
			padding: 0px 0px 0px 0px;
			max-width: 28%;
		}
		.caninput{
			padding-left: 0px;
		}
	</style>
</head>
<body>
<div class="container">
	<h1 class="text-center">Admin Dashboard</h1>
		<div class="row">
			<div class="col-sm-9 col-md-6 col-lg-7">
				<h2>Add Candidate</h2><hr><br>
				<form method="post" accept="#">
					<div class="form-group">
						<label class="control-label col-sm-5 canhead" for="ex4">Candidate Name : </label>
						<div class="col-md-6 caninput">
							<input class="form-control" id="ex3" type="text" name="candidate_name">
						</div>
					</div> 
					<button type="submit" name="submit" class="btn btn-primary">Add</button>
				</form>
				<br>
			</div>
		</div>

<?php

require 'config.php';

if(isset($_POST['submit'])){
	$can_name = $_POST['candidate_name'];
	$vote = 0;
	if ($can_name == null) {
		echo '<div class="alert alert-danger alert-dismissible" id="myAlert"><a href="#" class="close">&times;</a><strong>Candidate name can\'t empty!!!</strong></div>';
	}
	else{
		$conn = mysqli_connect($host, $user, $pass, $db) or die ("Error while connecting to database");
		$query = "INSERT INTO `count`(`id`, `can_name`, `can_vote`) VALUES (NULL, '$can_name', '$vote')";
		$result = mysqli_query($conn, $query);
		if ($result) {
			echo '<div class="alert alert-success alert-dismissible" id="myAlert"><a href="#" class="close">&times;</a><strong>New record stored!!!</strong></div>';
		}else{
			echo '<div class="alert alert-danger alert-dismissible" id="myAlert"><a href="#" class="close">&times;</a><strong>New record can\'t stored!!!</strong></div>';
		}
	}

}
echo '<div  style="background-color:#d8d8d7; padding:15px 25px 15px 25px">';
echo "<h2 class='text-center'>Vote Result</h2><br>";
$conn = mysqli_connect($host, $user, $pass, $db) or die ("Error While Connecting Database.");
$queryid = "SELECT COUNT(id) FROM `count`";
$resultid = mysqli_query($conn, $queryid);
$rowsid = mysqli_fetch_assoc($resultid);
$cid = $rowsid['COUNT(id)'];
echo "<table class='table table-striped table-bordered'><tr><th>Name</th><th>Vote</th></tr>";
for ($i=1; $i <= $cid; $i++) { 
	$queryvote = "SELECT `can_name`, `can_vote` FROM `count` WHERE `id` = $i";
	$resultvote = mysqli_query($conn, $queryvote);
	$rowsvote = mysqli_fetch_assoc($resultvote);
	echo "
		<tr>
			<td>
				". $rowsvote['can_name'] ."
			</td>
			<td>
				". $rowsvote['can_vote'] ."
			</td>
		</tr>";
}
echo "</table></div>";


?>
</div>

<script>
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);
</script>

</body>
</html>