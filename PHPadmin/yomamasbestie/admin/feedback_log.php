<?php
include '../shared/connection.php';
include '../shared/auth.php';
if (isset($_POST['searchUser'])) {
	$searchUser = $_POST['searchUser'];
}
			
?>
<!DOCTYPE html>
<html>
<head>
	<title>Feedbacks</title>
</head>
<body>
<h1> Feedbacks </h1>
<table border="1">
<tr>
	<th> Sender </th>
	<th> Recipient </th>
	<th> Content </th>
</tr>
<?php
	

		$limit = 7;
		$current_page = 1;
		if (isset($_GET['page']) && $_GET['page'] > 0) 
		{
		    $current_page = $_GET['page'];
		}
		$offset = ($current_page * $limit) - $limit;

		//request_status
		$viewRes = "CREATE OR REPLACE VIEW theRes AS
            SELECT 
		idUser as a,
        content,
        CONCAT(lastName, firstName, middleName) AS resNames
    FROM
        feedback
            NATURAL JOIN
        user_details
    WHERE
        idUser = recepient";
        $viewSend = "CREATE OR REPLACE VIEW theSender AS
    SELECT 
		idUser as b,
        content,
        CONCAT(lastName, firstName, middleName) AS senderNames
    FROM
        feedback
            NATURAL JOIN
        user_details
    WHERE
        idUser = sender";

		$viewSendQ = mysqli_query($conn, $viewSend) or die(mysqli_error($conn));
		$viewResQ = mysqli_query($conn, $viewRes) or die(mysqli_error($conn));

        $feedBackTo = "select theRes.content, resNames, senderNames from theRes natural join theSender";
        $feedQuery = mysqli_query($conn, $feedBackTo) or die(mysqli_error($conn));
		$totalrequest = mysqli_num_rows($feedQuery);

        $paginator = "select theRes.content, resNames, senderNames from theRes natural join theSender LIMIT $offset, $limit";

		$paginatorQuery = mysqli_query($conn,$paginator) or die(mysqli_error($conn));
		$pages = ceil($totalrequest/$limit);

		while($row = mysqli_fetch_array($paginatorQuery)){
			echo "<tr><td>" . $row['senderNames'] . "</td>";
					echo "<td>" . $row['resNames'] . "</td>";
					echo "<td>" . $row['content'] . "</td>";

		}
		echo "</tr>";

	// }	

	?>
</table>
<ul>
			 <!--  <li><a href="#">1</a></li>
			  <li class="active"><a href="#">2</a></li>
			  <li><a href="#">3</a></li>
			  <li><a href="#">4</a></li>
			  <li><a href="#">5</a></li> -->
			  	<?php
					if($current_page == 1){
						echo "<li class='disabled'><a href='javascipt:void(0)'>&laquo;</a></li>";
					}else{
						echo "<li><a href='feedback_log.php?page=" .($current_page - 1). "'>&laquo;</a></li>";
					}
					for($var = 1; $var <= $pages; $var++){
						echo "<li><a href='feedback_log.php?page=" .$var. "'>" .$var."</a></li>";
					}
					if($current_page == $pages){
						echo "<li class='disabled'><a href='javascipt:void(0)'>&raquo;</a></li>";
					}else{
						$a = $current_page + 1;
						echo "<li><a href='feedback_log.php?page=" .$a. "'>&raquo;</a></li>";
					}
				?>
			</ul>
<a href="../home.php">Home</a>
</body>
</html>
