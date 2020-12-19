<?php 
if(isset($_POST['update'])){
  if(!empty($_POST['Name']) && !empty($_POST['Email']) && !empty($_POST['Password']) && !empty($_POST['Gender']) &&!empty($_POST['Address'])){

      $name_updated = $_POST['Name'];
      $email_updated = $_POST['Email'];
      $password_updated = $_POST['Password'];
      $gender_updated = $_POST['Gender'];
      $address_updated = $_POST['Address'];
      $db_con = mysqli_connect('localhost','root','','users');
      if($db_con){

        $update_query = "UPDATE user_profile SET name = '$name_updated',name = '$email_updated',name =  '$password_updated',name = '$gender_updated',name = '$address_updated' WHERE ID = '$id'";

        $execute_update_query = mysqli_query($db_con,$update_query);
        if($execute_update_query){
          echo "<script>  alert('Profile Has Been Updated.')  </script>";
        }
      }else{
    echo "<script>  alert('No Connection With DB.')  </script>";

      }
  }else{
    echo "<script>  alert('All Fields Must Be Filled.')  </script>";
  }
}?>
<script>  location.href = "update_profile_form.php?update_result=ok" </script>
