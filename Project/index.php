<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#ajaxdata").load("allrecords.php");
			$("#price_dropdown").change(function(){
				var selected=$(this).val();
				$("#ajaxdata").load("search.php",{niveau: selected});
			});
			$("#refresh").click(function(){
				$("#ajaxdata").load("allrecords.php");
			});
		});
	</script>

</head>
<body>
<div class="container">
	<br><br>
	<h1><strong>Search/Filter data in php using Ajax</strong></h1>
	<br>
	<div class="row">	
		<form action="index.php" method="post" class="form-horizontal" >
			<label for="niveau" class="control-label col-sm-3 col-sm-offset-2" >niveau: </label>
			<div class="col-sm-2" >
				<select name="niveau" class="form-control" id="niveau_dropdown">
					<option>---Select---</option>
					<option value="Beginner">Beginner</option>
					<option value="Gevorderde">Gevorderde</option>
					<option value="Expert">Expert</option>
				</select>
			</div>
			<button type="button" name="refresh" id="refresh" class="btn btn-primary">Refresh</button>
		</form>
	</div>
	<br><br>
	<div id="ajaxdata">
		
	</div>
</div>

</body>
</html>