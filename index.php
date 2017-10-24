<!DOCTYPE html>
<html>
<head>
	<title>Vote</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .totalvote:hover{
            text-decoration: none;
        }
        .votedane:hover{
            text-decoration: none;
        }
    </style>
</head>
<body> 
    <div class="container"><br><br>
        <h1 class="text-center">Vote Counter</h1>
        <h3>Choose Your Favorite Person </h3>
    	<form method="post" action="#">
            <div class="form-group col-sm-9 col-md-6 col-lg-8">
            	<select name="select" class="form-control" id="sel1">
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
            	</select><br><br>
            	<input type="submit" name="submit" class="btn-lg btn-primary">
                <a href='view.php' class="btn-info btn-lg totalvote">View Total Vote</a>
            </div>
        </form>
        <script>
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 4000);
        </script>
        <div class="form-group col-sm-9 col-md-6 col-lg-8">
            <?php
                error_reporting(0);
                if(isset($_POST['submit'])){
                    $id = $_POST['select'];
                    $val= 1;
                    if(empty($id)){
                        echo '<div class="alert alert-danger alert-dismissible" id="myAlert"><a href="#" class="close">&times;</a><strong>Select a person name.</strong></div>';
                    }else{
                        $conn = mysqli_connect($host, $user, $pass, $db) or die ("Error while connecting to database");
                        $query = "UPDATE `count` SET `can_vote`=can_vote+'$val' WHERE `id` = '$id'";
                        $result = mysqli_query($conn, $query);
                        if ($result) {
                            echo '<div class="alert alert-success alert-dismissible" id="myAlert"><a href="#" class="close">&times;</a><strong>Vote Done.</strong></div>';
                        }else{
                            echo '<div class="alert alert-danger alert-dismissible" id="myAlert"><a href="#" class="close">&times;</a><strong>Something wrong !!!</strong></div>';
                        }
                    }
                    mysqli_close($conn);
                }
            ?>
        </div>
    </div>
</body>
</html>