<?php
	include_once("classes/Crud.php");
	$crud = new Crud();
	if(isset($_REQUEST['method']) && $_REQUEST['method']=="buy_now"){
		$model_no = $crud->escape_string($_REQUEST['model_no']);
		$query = "UPDATE models SET count = count+1 WHERE id = $model_no";
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
<title>Car Inventory System</title>
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
	.button {
		background-color: #4CAF50; /* Green */
		border: none;
		color: white;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		border-radius: 5px;
		cursor:pointer;
	}
	
	#lists {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	#lists td, #lists th {
		border: 1px solid #ddd;
		padding: 8px;
	}

	#lists tr:nth-child(even){background-color: #f2f2f2;}

	#lists tr:hover {background-color: #ddd;}

	#lists th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		background-color: #4CAF50;
		color: white;
	}
</style>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
	//$(document).ready(function(){
		function buy_now(model_no){
			$.ajax({
				type: "POST",
				url: "index.php",
				data: {
					method: "buy_now",
					model_no: model_no
				},
				async: false,
				success:function(html){
					if($.trim(html) =="success"){
						alert("Car Purchased Successfully.");
						 location.reload(); 
					} else{
						alert("Something went wrong. Please try again later.");
						return false;
					}
				},
				error:function(){
					alert('ajax error');
				}	
			});
		}
	//});
</script>
</head>
<body>
	<div width="80%">
		<div width="75%">
			<h1>Interview Task: Mini Car Inventory System</h1>
			<div align="right" width="50%">
				<a href="admin.php"><input type="button" class="button" value="Admin Screen"></a>
				
			</div>
			<br>
			<?php
				$query = "SELECT manu.id, manu.name, m.model_name, m.color, m.manufacturing_year, m.reg_number, m.id as model_no,m.count FROM models AS m 
							JOIN manufacturer As manu ON manu.id = m.manufacturer_ref
							ORDER BY manu.id ASC";
				$results = $crud->getData($query);
			?>
			<div id="grid" width="75%" align="center" style="font-size:18px; width:"500px;">
				<table id="lists">
					<thead> 
						<tr>
							<th>Manufacturer Id</th>
							<th>Manufacturer Name</th>
							<th>Model Name</th>
							<th>Color</th>
							<th>Manufacturing Year</th>
							<th>Reg Number</th>
							<th>Sold Count<th>
							<th><th>
						</tr>
					<thead>
					<tbody>
						<?php
						if($results){
							foreach($results as $result){
								$model_ref = $result['model_no'];
								echo "<tr>
									<td>
										".$result['id']."
									</td>
									<td>
										".$result['name']."
									</td>
									<td>
										".$result['model_name']."
									</td>
									<td>
										".$result['color']."
									</td>
									<td>
										".$result['manufacturing_year']."
									</td>
									<td>
										".$result['reg_number']."
									</td>
									<td>
										".$result['count']."
									</td>
									<td>
										<a onclick='buy_now($model_ref)' style='cursor:pointer';>Buy Now</a>
									</td>
								</tr>";
							}
						} else{
							echo "<tr>
									<td colsapn='8'>No Cars Available</td>
									</tr>";
						}
						
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</body>
</html> 

<?php
?>