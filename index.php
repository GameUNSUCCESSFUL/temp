<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>test input data</title>
</head>
<body>
	<form action="insert.php" method="post" enctype="multipart/form-data">
		<div>
			<label for="temp">Temp Input:</label>
			<input type="text" name="temp" id="temp" />
		</div>
		<div>
			<label for="pic">Pic Input:</label>
			<input type="file" name="photo" id="photo" />
		</div>				
		<div>
			<input type="submit" value="Submit" />
		</div>
	</form>
</body>
</html>