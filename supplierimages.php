<?php

/* Migration Scripts - Author : Hoja.M.A 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
	
	$queryF 		=	 "SELECT user_suppliers_data.uid as suppID,user_suppliers_data.suppliername,identifier,sys_file_reference.tablenames,user_suppliers_data.url
						FROM user_suppliers_data
						LEFT JOIN sys_file_reference on sys_file_reference.uid_foreign = user_suppliers_data.uid 
						LEFT JOIN sys_file on sys_file.uid = sys_file_reference.uid_local 
						WHERE user_suppliers_data.pid = 87826 
						AND user_suppliers_data.deleted=0 
						AND user_suppliers_data.hidden = 0 
						AND sys_file_reference.tablenames='user_suppliers_data'
						AND user_suppliers_data.sys_language_uid=0
					";
	$query	=	mysql_query($queryF, $con);

	$row 		=  	array();
	$filledRow	= 	array();
	$emptyRow	=	array();
	$rowFinal	=	array();
	$missedQery = 	array();
	while($result	=	mysql_fetch_array($query , MYSQLI_ASSOC)){
		array_push($row, $result);
	};

	echo '
			<table class="table table-bordered table-hover table-sortable imagesuppliers">
				<thead>
					<th>Nr.</th>
					<th>UID</th>
					<th>Supplier Name</th>
					<th>Supplier Logo</th>
				</thead>
				<tbody>
			';
			$emptySuppliers= array();$i=1;
				foreach ($row as $key => $value) {
					if( !empty($value['identifier']) && ($value['identifier'] != NULL  && $value['tablenames'] == "user_suppliers_data")){
						echo '
							<tr>
								<td>'.$i++.'</td>
								<td>'. $value['suppID'].'</td>
								<td>'. $value['suppliername'].'</td>
								<td><img class="supplier-logo" src="../../fileadmin'. $value['identifier'].'" alt="'.$value['url'].'"/></td>
							</tr>
						 ';
					}
					else{
						array_push($emptySuppliers, $value);
					}
					
				}
		echo '
				</tbody>
			</table>
			';

		/*
		* No Logo Entries
		 */
		$queryF2 		=	 "SELECT user_suppliers_data.uid ,user_suppliers_data.suppliername,user_suppliers_data.url
							FROM user_suppliers_data
							WHERE user_suppliers_data.uid NOT IN
							(
								SELECT user_suppliers_data.uid 
								FROM user_suppliers_data
							 	LEFT JOIN sys_file_reference on sys_file_reference.uid_foreign = user_suppliers_data.uid 
								LEFT JOIN sys_file on sys_file.uid = sys_file_reference.uid_local 
								WHERE user_suppliers_data.pid = 87826 
								AND user_suppliers_data.deleted=0 
								AND user_suppliers_data.hidden = 0 
								AND sys_file_reference.tablenames='user_suppliers_data'
								AND user_suppliers_data.sys_language_uid=0
							)
							AND user_suppliers_data.sys_language_uid=0
							AND user_suppliers_data.deleted=0 
							AND user_suppliers_data.hidden = 0 
							AND user_suppliers_data.pid = 87826
							";
		$execQuery = mysql_query($queryF2 , $con );
		$noLogosupp = array();
		while($result	=	mysql_fetch_array($execQuery , MYSQLI_ASSOC)){
			array_push($noLogosupp, $result);
		};
?>