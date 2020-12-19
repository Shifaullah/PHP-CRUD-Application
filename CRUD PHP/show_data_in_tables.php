<?php 

if(!empty($_GET['updation']) && $_GET['updation'] === 'ok'){
  echo "<script> alert('UPDATE SUCCESSFUL.')  </script>";
}
 ?>

<?php 
$db_con = mysqli_connect('localhost','root','','users');
if(isset($_GET['searchbtn']) && $db_con){
  if(!empty($_GET['search'])){
    $search = $_GET['search'];
    $search_query = "SELECT * FROM user_profile WHERE name = '$search' OR homeAddress = '$search'";
    $execute_search_query = mysqli_query($db_con,$search_query);
    echo '<table align = "center" class="table w-75 text-light">';
    echo "<tr class='bg-dark'>";
    echo "<th>ID</th><th>Name</th><th>Email</th><th>Password</th><th>Gender</th><th>HomeAddress</th><th>Image</th><th>Entry Date</th>";
    echo "</tr>";
    while($search_rows = mysqli_fetch_assoc($execute_search_query)){

      ?>
      <tr class="text-dark">
      <td><?php  echo $search_rows['ID']; ?></td>
        <td><?php  echo $search_rows['name']; ?></td>
        <td><?php  echo $search_rows['email']; ?></td>
        <td><?php  echo $search_rows['password']; ?></td>
        <td><?php  echo $search_rows['gender']; ?></td>
        <td><?php  echo $search_rows['homeAddress']; ?></td>
        <td><img src="<?php  echo $search_rows['image']; ?>" width="80px" height="60px"></td>
        <td><?php  echo $search_rows['date_of_entry']; ?></td>
      </tr>
    <?php 
  }
echo "</table>";
  }else{
    echo "put something in search.";
  }
}

 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>show Data From the Data Base</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<style>
td{
border:1px solid rgba(0,0,0,0.3);;
}
</style>
<body>
<!-- search table -->
<div class="container">
  <div class="row">
    <div class="col-8">
      <form action="show_data_in_tables.php" method="GET">
        <br><br>
        <input type="text" name="search" placeholder="SEARCH BY NAME OR BY ADDRESS" class="form-control"><br>
        <input style="float: right;" type="submit" class="btn btn-success px-5 btn-sm" value="SEARCH" name="searchbtn"><br><br><br>
      </form>
      
    </div>
  </div>
</div>
<!-- search table End -->
<!-- bootstrap tables -->
	<div class="container">

<table class="table results">
  <div class="alert alert-primary" role="alert">
  <b id="results_length" class="text-success" style="font-size: 1.2rem;"></b> Records Are there in your DATA BASE
</div>
  <thead>
    <tr class="bg-dark text-light">
      <th scope="col">ID</th>
      <th scope="col">NAME</th>
      <th scope="col">EMAIL</th>
      <th scope="col">PASSWORD</th>
      <th scope="col">GENDER</th>
      <th scope="col">HOME ADDRESS</th>
      <th scope="col">IMAGE</th>
      <th scope="col">DATE OF ENTRY</th>
      <th scope="col">DELETE</th>
      <th scope="col">UPDATE</th>
    </tr>
  </thead>
  <tbody>
<?php 
$db_con = mysqli_connect('localhost','root','','users');
if($db_con){

  $show_Query = "SELECT * FROM user_profile";
  $execute_show_Query = mysqli_query($db_con,$show_Query);

  if($execute_show_Query){
    while($dataRows = mysqli_fetch_array($execute_show_Query)){
      ?>
        <tr>
          <td class="text-info font-weight-bold"><?php echo $dataRows['ID']; ?></td>
          <td><?php echo $dataRows['name']; ?></td>
          <td><?php echo $dataRows['email']; ?></td>
          <td><?php echo $dataRows['password']; ?></td>
          <td><?php echo $dataRows['gender']; ?></td>
          <td><?php echo $dataRows['homeAddress']; ?></td>
          <td><img alt="No image is there.Plz Update your profile" src="<?php echo($dataRows['image']); ?>" width="50px" ></td>
          <td><?php echo $dataRows['date_of_entry']; ?></td>
          <td><a href="delete_a_record.php?id=<?php echo $dataRows['ID'];?>"class="text-danger">DELETE</a></td>
          <td><a href="update_profile_form.php?update_id=<?php echo $dataRows['ID'];?>"class="text-success">UPDATE</a></td>
        </tr>

<?php 
    }
    

  }
}else{
  echo "<script>  alert('database connection error.')  </script>";
}

?>
  </tbody>
</table>
<!-- bootstrap tables ### -->


<script>
  var targ = document.querySelectorAll('table.results tr').length;
  document.querySelector('#results_length').innerHTML = targ-1;
</script>
</div>
</body>
</html>