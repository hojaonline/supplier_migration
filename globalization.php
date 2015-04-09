<?php 
	/**
	 * @author Hoja.M.A
	 * @param post variables
	 * Starting Form Migrate Action
	 **/
	if ( isset($_POST['migrate'] ) ){
		$dupSupplierID	= $_POST['duplicateSupplier'];
		$ogSupplierID	= $_POST['originalSupplier'];
		if ($dupSupplierID > 0 && $ogSupplierID > 0){
			globalMigration($dupSupplierID,$ogSupplierID);
		}
		exit;
	}
	$allSupp =	 "SELECT user_suppliers_data.uid as suppID,user_suppliers_data.suppliername
						FROM user_suppliers_data
						WHERE user_suppliers_data.pid = 87826
						AND user_suppliers_data.deleted=0
						AND user_suppliers_data.hidden = 0
						AND user_suppliers_data.sys_language_uid=0
						ORDER BY suppliername
					";
	$queryExec	=	mysql_query($allSupp, $con);
	$suppliers	= [];
	while($result	=	mysql_fetch_array($queryExec , MYSQLI_ASSOC)){
		array_push($suppliers, $result);
	};
	//echo "<pre>";print_r( $suppliers ); exit;
?>
<form method="post">
	<table class="table table-bordered table-hover table-sortable">
		<thead>
			<tr>
				<th colspan="2">Globalization of Supplier Values</th>
			</tr>
			<tr>
				<th> Select the Supplier to delete </th>
				<th> Select the Supplier to Replace it with Mapped Values </th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<select class="form-control duplicateSupplier" name="duplicateSupplier">
						<?php foreach ($suppliers as $key => $value ) {?>
							<option value="<?php echo $value['suppID'];?>"><?php echo $value['suppliername'];?></option>
						<?php  } ?>
					</select>
				</td>
				<td>
					<select class="form-control originalSupplier" name="originalSupplier">
						<?php foreach ($suppliers as $key => $value ) {?>
							<option value="<?php echo $value['suppID'];?>"><?php echo $value['suppliername'];?></option>
						<?php  } ?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<button type="submit" class="migrate btn btn-danger pull-right" name="migrate">
						Migrate <span class="fa fa-exchange"></span>
					</button>
				</td>
			</tr>
		</tbody>
	</table>
</form>
