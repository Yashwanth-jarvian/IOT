<html>

<head> 
	<title>Efficiency Tracking</title>
</head>

<body>
	<nav>
		<a href = "hours.php"> Hour Production </a>
	</nav>
	<?php
	function per_table($conn, $table, $lineno, $info)
	{
		$result = mysqli_query($conn, "select * from $table where lineno = $lineno order by hangername;");
				
		while($row = mysqli_fetch_assoc($result))
		{
			$hangername = $row['hangername'];
			$intime 	= strtotime($row['intime']);
			$outtime 	= strtotime($row['outtime']);			
			$diff 		= $outtime - $intime;
			$info[$hangername] += $diff;
		}		
		foreach($info as $key => $val)
		{
			echo "<td>$val</td>";
		}
		
		mysqli_free_result($result);
		
		return $info;
	}

	///	table { hangername, lineno, intime, outtime }
	function tables($conn, $lineno)
	{

		echo '<table border = 1><tr><th>info</th>';
		for($i=1; $i<=100;$i++)
		{
			$keys[$i] = "h$i";
		}
		$info = array_fill_keys( $keys, 0);

		foreach($info as $key => $val)
		{
			echo "<th>$key</th>";
		}
		echo '</tr>';
		
		for($i = 1; $i <= 24; $i++)
		{
			echo "<tr><th>table$i</th>";
			per_table($conn, "table$i", $lineno, $info);
			echo "</tr>";
		}
		echo "</table>";
	}
	
		$conn = mysqli_connect("localhost", "root", "", "tables");
	
	for($i = 1; $i <= 5; $i++)
	{
		echo "<br>Line $i<br>";
		tables($conn, $i);
	}
		mysqli_close($conn);
	
	?>
</body>
</html>