<h1>Supplier with no logo/Image</h1><hr/>
<?php
echo '
			<table class="table table-bordered table-hover table-sortable nonimagesuppliers">
				<thead>
					<th>Nr.</th>
					<th>UID</th>
					<th>Supplier Name</th>
			
				</thead>
				<tbody>
			';
$emptySuppliers= array();$i=1;
foreach ($noLogosupp as $key => $value) {
	echo '
						<tr>
							<td>'.$i++.'</td>
							<td>'. $value['uid'].'</td>
							<td>'. $value['suppliername'].'</td>
				
						</tr>
					 ';
	array_push($emptySuppliers, $value);
}
echo '
				</tbody>
			</table>
			';

?>
</div>