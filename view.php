<!DOCTYPE html>
<html>
<head>
	<title>View</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
			padding: 8px 28px 8px 28px;
			border-top: 1px solid #100f0f;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<h1 class="text-center">Vote Result</h1>
		<a class="btn btn-danger" href="index.php">Go back</a><hr>
		<div class="row">
			<div class="col-sm-3 col-md-6 col-lg-4">
				<form method="post" action="#">
					<div class="form-group">
						<h3>Choose Candidate Name</h3>
						<select name="canselect" class="form-control" id="sel1">
							<option value="" selected="selected">- Choose -</option>
					        <?php 
					            require 'config.php';
					            $conn = mysqli_connect($host, $user, $pass, $db) or die ("Error While Connecting Database.");
					            $queryid = "SELECT COUNT(id) FROM `count`";
					            $resultid = mysqli_query($conn, $queryid);
					            $rowsid = mysqli_fetch_assoc($resultid);
					            $cid = $rowsid['COUNT(id)'];
					            for ($i=1; $i <= $cid; $i++) { 
					                $queryname = "SELECT `can_name` FROM `count` WHERE `id` = $i";
					                $resultname = mysqli_query($conn, $queryname);
					                $rowsname = mysqli_fetch_assoc($resultname);
					                echo "<option value='".$i."'>". $rowsname['can_name'] ."</option>";
					            }
					            mysqli_close($conn);
					        ?>
						</select>
					</div>
					<input type="submit" name="submit">
				</form>
			</div>
			<div class="col-sm-9 col-md-6 col-lg-8" style="background-color:#d8d8d7;">
				<?php
					error_reporting(0);
					if (isset($_POST['submit'])) {
						$canid = $_POST['canselect'];
						$conn = mysqli_connect($host, $user, $pass, $db) or die ("Error While Connecting Database.");
						$queryvote = "SELECT `can_name`, `can_vote` FROM `count` WHERE `id` = $canid";
					    $resultvote = mysqli_query($conn, $queryvote);
					    $rowsvote = mysqli_fetch_assoc($resultvote);
					    echo "<br><br><table class='table'>
							<tr>
								<th>Name</th>
								<th>Vote</th>
							</tr>
							<tr>
								<td>
									". $rowsvote['can_name'] ."
								</td>
								<td>
									". $rowsvote['can_vote'] ."
								</td>
							</tr>
						</table>";
					}
					mysqli_close($conn);
				?> 
			</div>
		</div>
	</div>
</body>
</html>