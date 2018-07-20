
<!DOCTYPE html>
<html>
<head>
<title>Manage Care Inventory - Admin</title>
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
		border-radius:5px;
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
</head>
<body width="80%">
	<div>
		<h1>Manage Car Inventory - Admin</h1>
		<div align="right" width="50%">
			<a href="index.php"><input type="button" class="button" value="Home"></a>
			<a href="add_manufacture.php"><input type="button" class="button" value="Add Manufacturer"></a>
			<a href="add_model.php"><input type="button" class="button" value="Add Model"></a>
		</div><br>
		<?php
				include_once("classes/Crud.php");
				$crud = new Crud();
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
						</tr>
					<thead>
					<tbody>
						<?php
						if($results){
							foreach($results as $result){
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
								</tr>";
							}
						} else{
							echo "<tr>
									<td colsapn='7' align='center'>No Cars Available</td>
									</tr>";
						}
						
						?>
					</tbody>
				</table>
			</div>
	</div>

</body>
</html> 

<?php
?>