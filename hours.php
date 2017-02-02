<html>
<head>
	<title> Hour Production </title>
</head>
<body>
	<?php
	//// Not yet completed...
	$lineno = 1;
	$conn = mysqli_connect("localhost", "root", "", "tables");
	
	$hr = 0;
	
	for($i = 1; $i < 24; $i++)
	{
		$sql = "select count(hangername) hcount from 
		table$i where 
		intime >= (select date_add( min(intime), INTERVAL $hr hour ) from table1) and 
		intime <= (select date_add( min(intime), INTERVAL $i+1 hour ) from 
		table1) and lineno = $lineno";
		 
		$res = mysqli_query($conn, $sql);
				
		$row = mysqli_fetch_assoc($res);
		
		echo $row['hcount'];
		
		mysqli_free_result($res);
	}
	
	mysqli_close($conn); 
	?>
</body>
</html>