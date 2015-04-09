<style type="text/css">
	.supplier-logo{
		max-width : 300px;
		max-height: 100px;
	}
	td {
	  text-align: center;
	}
	tr:nth-child(2n) {
	  background: none repeat scroll 0 0 #cff;
	}
</style>
<?php

/* Migration Scripts - Author : Hoja.M.A 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

	$username	= 	'pits';
	$host			=	'localhost';
	$password	=	'MaranzaPits1';
	$db			=	'pits_hoja';
	$con 			=	mysql_connect($host,$username,$password) or die("Unable to connect to MySQL");
	$db_select	=	mysql_select_db($db,$con);
	$queryF 		=	 "SELECT user_suppliers_data.uid as suppID,user_suppliers_data.suppliername,identifier
						FROM user_suppliers_data
						LEFT JOIN sys_file_reference on sys_file_reference.uid_foreign = user_suppliers_data.uid 
						LEFT JOIN sys_file on sys_file.uid = sys_file_reference.uid_local 
						WHERE user_suppliers_data.pid = 87826 
						AND user_suppliers_data.deleted=0 
						AND sys_file_reference.tablenames = 'user_suppliers_data'
						AND sys_file_reference.fieldname = 'imagedam'
						AND user_suppliers_data.hidden = 0 
						AND user_suppliers_data.sys_language_uid=0
						GROUP BY suppID
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
	
	$getEmptySuppliers = showExistingTable($row);
	 echo '<pre>';print_r( $getEmptySuppliers );echo '</pre>';exit;
	$emptyReulsts = array();
	$noImages = array();
	foreach ($getEmptySuppliers  as $key => $value) {
				/*$qy =	" SELECT a.uid suppUid,b.uid sysID, suppliername,b.*, sys_file.identifier 
						FROM user_suppliers_data a
						LEFT JOIN sys_file_reference b ON  a.uid = b.uid_foreign 
						LEFT JOIN sys_file on sys_file.uid = b.uid_local
						WHERE  a.suppliername LIKE '%".mysql_real_escape_string($value['suppliername'])."%' AND a.deleted=0 AND a.hidden = 0 AND a.sys_language_uid=0
						AND b.deleted=0 AND b.hidden=0 AND b.tablenames = 'user_suppliers_data' AND b.fieldname='imagedam'
						GROUP BY suppliername 
				";*/

		echo $qy = "
			SELECT a.uid suppUid, a.pid  as supplier_pid,suppliername, b.uid as B_uid, b.uid_foreign as B_sys_file,c.identifier as fliepath
			FROM user_suppliers_data a 
			LEFT JOIN sys_file_reference b on a.uid = b.uid_local
			LEFT JOIN sys_file c on b.uid_foreign = c.uid
			WHERE a.suppliername LIKE '%".mysql_real_escape_string($value['suppliername'])."%' 
			AND a.deleted = 0 AND a.hidden = 0
			AND b.deleted = 0 AND b.hidden = 0
			AND b.tablenames = 'user_suppliers_data'
			AND b.fieldname = 'imagedam'
			AND c.deleted = 0
			AND a.pid != 87826
			AND a.sys_language_uid = 0
			GROUP BY suppliername
			";
		$insideQuery	=	mysql_query($qy ,$con);
		$res	=	mysql_fetch_array($insideQuery , MYSQLI_ASSOC);
		if(isset($res) && is_array($res)){
			while($res	=	mysql_fetch_array($insideQuery , MYSQLI_ASSOC)){
				$merged_array = array_merge($res,array('old' => $value) );
				$emptyReulsts[$key][] = $merged_array;
				//$emptyReulsts[$key][]['oldSupplierValues'] = $value;
				//array_push($emptyReulsts, $res);
			};	
		}
		else{
			array_push($noImages, $value);
		}
		
		
	} 
	$query = NULL;
	//Creating New Insert Query in to sys_file_reference
	foreach ($emptyReulsts as $search_result => $value) {
		echo $query .= " INSERT INTO `sys_file_reference` ( `pid`, `tstamp`, `crdate`, `cruser_id`, `sorting`, `deleted`, `hidden`, `t3ver_oid`, `t3ver_id`, `t3ver_wsid`, `t3ver_label`, `t3ver_state`, `t3ver_stage`, `t3ver_count`, `t3ver_tstamp`, `t3ver_move_id`, `t3_origuid`, `sys_language_uid`, `l10n_parent`, `l10n_diffsource`, `uid_local`, `uid_foreign`, `tablenames`, `fieldname`, `sorting_foreign`, `table_local`, `title`, `description`, `alternative`, `link`, `downloadname`, `damUidRef`, `pits_uidlocal`) VALUES (87826,	'".$value['tstamp']."','".$value['crdate']."','".$value['cruser_id']."','".$value['sorting']."','".$value['deleted']."','".$value['hidden']."','".$value['t3ver_oid']."','".$value['t3ver_id']."','".$value['t3ver_wsid']."','".$value['t3ver_label']."','".$value['t3ver_state']."','".$value['t3ver_stage']."','".$value['t3ver_count']."','".$value['t3ver_tstamp']."','".$value['t3ver_move_id']."','".$value['t3_origuid']."','".$value['sys_language_uid']."','".$value['l10n_parent']."','".$value['l10n_diffsource']."','".$value['uid_local']."','".$value['suppUid']."','".$value['tablenames']."','".$value['fieldname']."','".$value['sorting_foreign']."','".$value['table_local']."','".$value['title']."','".$value['description']."','".$value['alternative']."','".$value['link']."','".$value['downloadname']."','".$value['damUidRef']."','".$value['pits_uidlocal']."');"."\n";
	}

	echo '<pre>';print_r( $getEmptySuppliers );echo '</pre>';
 	echo '<pre>';print_r( $noImages );echo '</pre>';
	 exit;



	function showExistingTable($filledRow){
		echo '
			<table>
				<thead>
					<th>Nr.</th>
					<th>UID</th>
					<th>Supplier Name</th>
					<th>Supplier Logo</th>
				</thead>
				<tbody>
			';
			$emptySuppliers= array();$i=1;
				foreach ($filledRow as $key => $value) {
					if( !empty($value['identifier']) ){
						echo '
							<tr>
								<td>'.$i++.'</td>
								<td>'. $value['suppID'].'</td>
								<td>'. $value['suppliername'].'</td>
								<td><img class="supplier-logo" src="../../fileadmin'. $value['identifier'].'" alt="'.$value['suppliername'].'"/></td>
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
			return $emptySuppliers;
	}
?>