<?php
//error_reporting(E_ALL);
//ini_set("display_errors","on");
	include_once("classes/Crud.php");
	$crud = new Crud();
	if(isset($_REQUEST['method']) && $_REQUEST['method']=="add_manufacturer"){
		$manufacturer = $crud->escape_string($_REQUEST['manufacturer']);
		$lower_name = strtolower($manufacturer);
		$query = "SELECT * FROM manufacturer WHERE name = '$lower_name'";
		if(!empty($crud->getData($query))){
			echo 'duplicate';
		} else{
			$query = "INSERT INTO manufacturer SET name = '$manufacturer'";
			if($crud->execute($query)){
				echo 'success';
			} else{
				echo 'error';
			}
		}
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add manufacturer</title>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
	body{
		background-color: #F8F8F8;
		font-family: Courier;
		font-size: 12px;
	}
	h1{
		font-color: #87CEEB;
		text-align: center;
	}
	a{
		cursor: pointer;
	}
	.submit_button {
		background-color: #4CAF50; /* Green */
		border: none;
		color: white;
		padding: 05px 15px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		border-radius:5px;
		cursor: pointer;
	}
	
	.button {
		background-color: #4CAF50; /* Green */
		border: none;
		color: white;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		border-radius:5px;
		cursor: pointer;
	}
</style>
<script>
	$(document).ready(function(){
		$("#add_manufacturer").click(function(){
			var manufacturer = $.trim($("#manufacturer").val());
			if(manufacturer == ""){
				alert("Please Enter manufacturer name.");
				return false;
			}
			$.ajax({
				type: "POST",
				url: "add_manufacture.php",
				data: {
					method: "add_manufacturer",
					manufacturer: manufacturer
				},
				async: false,
				success:function(html){
					if($.trim(html)=='duplicate'){
						alert("Same Manufacturer already exists");
						return false;
					} else if($.trim(html) =="success"){
						alert("Manufacturer record Inserted Successfully.");
						$("#manufacturer").val('');
						return false;
					} else{
						alert("Something went wrong. Please try again later.");
						return false;
					}
				},
				error:function(){
					alert('ajax error');
				}	
			});
		});
	});
</script>
</head>
<body width="80%">
	<div >
		<h1>Add Manufacturer</h1>
		<div  style="margin-left:20%">
			<div align="right" width="50%">
				<a href="index.php"><input type="button" class="button" value="Home"></a>
				<a href="admin.php"><input type="button" class="button" value="Admin"></a>
				<a href="add_model.php"><input type="button" class="button" value="Add Model"></a>
			</div>
			<form>
				Manufacturer Name: <input type="text" name="manufacturer" id="manufacturer">
				<input class="submit_button" type="button" name="add" value="Add" id="add_manufacturer">
			</form
		</div>
	</div>

</body>
</html> 
