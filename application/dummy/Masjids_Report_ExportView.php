
<?php 
	header("Content-type: application/octet-stream");	
	$filename = "Beneficiary_Report_".date("Y_m_d_h:i").".xls";			
	header("Content-Disposition: attachment; filename=$filename");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
		
	<table border='1'>
	<tr>
		<th>#</th>
		<th>Masjid ID</th>
		<th>Masjid Name</th>
		<th>Location</th>
		<!-- <th style="width:15%">Collected Date</th> -->			
	 </tr>

<?php		
	 $i =1;	
	 foreach($report_data as $data) {
?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $data["masjid_id"]; ?></td>
		<td><?php echo $data["masjid_name"]; ?></td>		
		<td><?php echo $data["masjid_location"]; ?></td>	
	</tr>
<?php   
		$i++;
	 }
?>
		
	</table>
		
		 