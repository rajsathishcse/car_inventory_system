
<?php
//error_reporting(E_ALL);
//ini_set("display_errors","on");
	include_once("classes/Crud.php");
	$crud = new Crud();
	if(isset($_REQUEST['method']) && $_REQUEST['method']=="add_model"){
		$manufacturer = $crud->escape_string($_REQUEST['manufacturer']);
		$model_name = $crud->escape_string($_REQUEST['model_name']);
		$color = $crud->escape_string($_REQUEST['color']);
		$manufacturing_year = $crud->escape_string($_REQUEST['manufacturing_year']);
		$reg_number = $crud->escape_string($_REQUEST['reg_number']);
		$note = $crud->escape_string($_REQUEST['note']);
		$query = "INSERT INTO models SET manufacturer_ref = '$manufacturer', model_name='$model_name', color='$color',manufacturing_year='$manufacturing_year',reg_number='$reg_number',note='$note' ";
		if($crud->execute($query)){
			echo 'success';
		} else{
			echo 'error';
		}
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Model</title>
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
		$("#add_model").click(function(){
			var manufacturer = $.trim($("#manufacturer").val());
			var model_name = $.trim($("#model_name").val());
			var color = $.trim($("#color").val());
			var manufacturing_year = $.trim($("#manufacturing_year").val());
			var reg_number = $.trim($("#reg_number").val());
			var note  = $.trim($("#note").val());
			if(manufacturer == ""){
				alert("Please select manufacturer.");
				return false;
			}
			if(model_name == ""){
				alert("Please Enter Model name");
				return false;
			}
			if(color == ""){
				alert("Please Enter Color");
				return false;
			}
			if(manufacturing_year == ""){
				alert("Please Enter Manufacturing Year");
				return false;
			}
			if(reg_number == ""){
				alert("Please Enter Registraion Number");
				return false;
			}
			if(note == ""){
				alert("Please Enter Note");
				return false;
			}
			$.ajax({
				type: "POST",
				url: "add_model.php",
				data: {
					method: "add_model",
					manufacturer: manufacturer,
					model_name : model_name,
					color : color,
					manufacturing_year : manufacturing_year,
					reg_number : reg_number,
					note : note
				},
				async: false,
				success:function(html){
					if($.trim(html) =="success"){
						alert("Car Model record Inserted Successfully.");
						$("#manufacturer").val('');
						$("#model_name").val('');
						$("#color").val('');
						$("#manufacturing_year").val('');
						$("#reg_number").val('');
						$("#note").val('');
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
		<h1>Add Model</h1>
		<div  style="margin-left:20%">
			<div align="right" width="50%">
				<a href="index.php"><input type="button" class="button" value="Home"></a>
				<a href="admin.php"><input type="button" class="button" value="Admin"></a>
				<a href="add_manufacture.php"><input type="button" class="button" value="Add Manufacturer"></a>
				
			</div>
			<form>
				<?php
					$select_manu = "SELECT * FROM manufacturer ORDER BY name ASC";
					$results = $crud->getData($select_manu);
				?>
				<table>
					<tr>
						<td colspan="2">
							Select Manufacturer Name: 
							<select name="manufacturer" id="manufacturer">
								<option value="">--Select--</option>
								<?php
									foreach($results as $result){
										$id = $result['id'];
										$name = $result['name'];
										echo "<option value=$id>$name</option>";
									}
								?>
							</select>
							Model Name: <input type="text" name="model_name" id="model_name">
						</td>
					</tr>
					<tr>
						<td>
							Color: 
						</td>
						<td>
							<input type="text" name="color" id="color">
						</td>
					</tr>
					<tr>
						<td>
							Manufacturing Year: 
						</td>
						<td>
							<input type="number" name="manufacturing_year" id="manufacturing_year">
						</td>
					</tr>
					<tr>
						<td>
							Registration Number: 
						</td>
						<td>
							<input type="text" name="reg_number" id="reg_number">
						</td>
					</tr>
					<tr>
						<td>
							Notes: 
						</td>
						<td>
							<input type="text" name="note" id="note">
						</td>
					</tr>
					<tr></tr>
					<tr>
						<td colspan="2">
							<input class="submit_button" type="button" name="add" value="Add" id="add_model">
						</td>
					</tr>
				</table>
			</form
		</div>
	</div>

</body>
</html> 