<?php 
if(isset($_POST['Submit'])){
  if(!empty($_POST['Name']) && !empty($_POST['Email']) && !empty($_POST['Password']) && !empty($_POST['Gender']) && !empty($_POST['Address']) && !empty($_FILES['image']['name'])){
    // user profile data
    
    $db_con = mysqli_connect('localhost','root','','users');
    $img_path_in_db = "images/".$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],$img_path_in_db);
    $name = mysqli_real_escape_string($db_con,$_POST['Name']);
    $email = mysqli_real_escape_string($db_con,$_POST['Email']);
    $password = mysqli_real_escape_string($db_con,$_POST['Password']);
    $gender = mysqli_real_escape_string($db_con,$_POST['Gender']);
    $address = mysqli_real_escape_string($db_con,$_POST['Address']);


  if($db_con){

    $query = "INSERT INTO user_profile(name,email,password,gender,homeAddress,image) 
    VALUES('$name','$email','$password','$gender','$address','$img_path_in_db')";
    if(mysqli_query($db_con,$query)){
    echo "<script>  alert('Profile Has Been Added.');</script>";
    // Mailing
    $reciever = $email;
    $header = "FROM:SHIFA YOUSUFZAI";
    $subject = "SIGN UP Successful";
    $message = "WELLCOME TO MY WEBSITE\n you are added successfully with the name : $name\n And your Email is: $email\n And Your Password is: $password\n And your Home Address is Set to: $address.";
    if(mail($reciever,$subject, $message,$header)){
    echo "<script>  alert('An email Sent to '$name);</script>";
    }else{ echo "<script>  alert('email Not Sent to '$name);</script>";}
    ///  mailing ////>>>>
    }else{
    echo "<script>  alert('An Arror occured while Submitting form.');  </script>";
    }
  }else{
    echo "<script>  alert('Connection Error With DB.');  </script>";
  }

  }else{
    echo "<script>  alert('all fields should be filled.');  </script>";
  }
}


?>

<!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Form</title>
 		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
 </head>
 <body>

<!-- bootstrap form -->
<div class="container">
	<div class="row">
		<div class="col-lg-2"></div>
		<div class="col-lg-8 pt-5">
			<h1 class="text-success pb-4 text-center">SIGN UP</h1>
				<form action="form.php" method="post" enctype="multipart/form-data">
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Name: </label>
    <div class="col-sm-10">
      <input type="text" class="form-control shadow" id="name" placeholder="Name" name="Name">
    </div>
  </div>
  <div class="form-group row">
    <label for="Email" class="col-sm-2 col-form-label">Email: </label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="Email" placeholder="Email" name="Email">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password: </label>
    <div class="col-sm-10">
      <input type="password" class="form-control shadow" id="inputPassword3" placeholder="Password" name="Password">
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
      <input type="file" name="image" id="image" class="form-control shadow">
    </div>
  </div>
   <div class="form-group row">
    <label for="address" class="col-sm-2 col-form-label">Home Address: </label>
    <div class="col-sm-10">
      <textarea name="Address" id="address" placeholder=" HOME ADDRESS..." class="form-control shadow"></textarea>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="Submit" class="btn btn-dark px-4 shadow">SUBMIT</button>
    </div>
  </div>
</form>
<!-- bootstrap form ######## -->
 		<a href="show_data_in_tables.php" target="_blank"><button class="shadow btn btn-outline-dark btn-sm px-4">click to show data from the data base.</button></a>




		</div>
		<div class="col-lg-2"></div>
	</div>
</div>


 </body>
 </html>