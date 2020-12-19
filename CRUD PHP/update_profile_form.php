<?php 
  $name = "";
  $email = "";
  $password = "";
  $gender = "";
  $address = "";

  $db_con = mysqli_connect('localhost','root','','users');
  if($db_con){
     if(!empty($_GET['update_id'])){
    define('id',$_GET['update_id']);
    $show_query_execute = mysqli_query($db_con,"SELECT * FROM user_profile WHERE ID = ".id);
    $datarow = mysqli_fetch_assoc($show_query_execute);
    $name = $datarow['name'];
    $email = $datarow['email'];
    $password = $datarow['password'];
    $gender = $datarow['gender'];
    $address = $datarow['homeAddress'];
    }
   
  }
 ?>



<?php 
if(isset($_POST['update'])){
  $id = $_GET['id'];
  if(!empty($_POST['Name']) && !empty($_POST['Email']) && !empty($_POST['Password']) && !empty($_POST['Gender']) &&!empty($_POST['Address']) && !empty($_FILES['image']['name'])){

      $name_updated = $_POST['Name'];
      $email_updated = $_POST['Email'];
      $password_updated = $_POST['Password'];
      $gender_updated = $_POST['Gender'];
      $address_updated = $_POST['Address'];
      $img_updated_path = 'images/'.$_FILES['image']['name'];
      // to save user photo in the directory.
      move_uploaded_file($_FILES['image']['tmp_name'],$img_updated_path);
      $db_con = mysqli_connect('localhost','root','','users');
      if($db_con){

        $update_query = "UPDATE `user_profile` SET `name`= '$name_updated',`email`='$email_updated',`password`='$password_updated',`gender`='$gender_updated',`homeAddress`='$address_updated',`image` = '$img_updated_path' WHERE ID = $id";

        $execute_update_query = mysqli_query($db_con,$update_query);
      }else{
    echo "<script>  alert('No Connection With DB.')  </script>";

      }
  echo "<script>  location.href='show_data_in_tables.php?updation=ok';   </script>";
  }else{
    echo "<script>  alert('All Fields Must Be Filled.')  </script>";
  }
}?>

<!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>UPDATE PROFILE</title>
 		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
 </head>
 <body>

<!-- bootstrap form -->
<div class="container">
	<div class="row">
    <div class="col-12 text-center text-success pt-5 mt-3"> <h3>Update Profile</h3></div>
		<div class="col-lg-2"></div>
		<div class="col-lg-8 pt-5">
			
				<form action="update_profile_form.php?id=<?php echo id ?>" method="post" enctype="multipart/form-data" >
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Name: </label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="name" placeholder="Name" name="Name" value="<?php echo $name; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="Email" class="col-sm-2 col-form-label">Email: </label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="Email" placeholder="Email" name="Email" value="<?php echo $email; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password: </label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="Password" value="<?php echo $password; ?>">
    </div>
  </div>
  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="Gender" id="gridRadios1" value="male" checked>
          <label class="form-check-label" for="gridRadios1">
            Male 
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="Gender" id="gridRadios2" value="female">
          <label class="form-check-label" for="gridRadios2">
            Female
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="Gender" id="gridRadios3" value="other">
          <label class="form-check-label" for="gridRadios3">
            Other
          </label>
        </div>
      </div>
    </div>
  </fieldset>
<div class="form-group row">
    <label class="col-sm-2 col-form-label" for="image">Upload Photo</label>
    <div class="col-sm-10">
      <input type="file" name="image" id="image" class="form-control shadow pb-5">
    </div>
  </div>
  <div class="form-group row">
    <label for="address" class="col-sm-2 col-form-label">Home Address: </label>
    <div class="col-sm-10">
      <input type="text" style="height: 70px !important;" name="Address" id="address" class="form-control" value="<?php echo($address); ?>">
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="update" class="btn btn-success px-5">UPDATE</button>
    </div>
  </div>
</form>
<!-- bootstrap form ######## -->




		</div>
		<div class="col-lg-2"></div>
	</div>
</div>


 </body>
 </html>