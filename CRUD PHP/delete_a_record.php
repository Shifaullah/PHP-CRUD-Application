<?php 
if(!empty($_GET['id'])){
	$profile_id_to_be_delete = $_GET['id'];
	$db_con = mysqli_connect('localhost','root','','users');
	if($db_con){
  		$delete_Query = "DELETE FROM user_profile WHERE ID = '$profile_id_to_be_delete'";
  		$execute_dlt_qury = mysqli_query($db_con,$delete_Query);
	}
} 
?>
<script>   location.href="show_data_in_tables.php"</script>";
