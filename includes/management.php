<?php
$session->isNotLoggedIn();
$form = new Controller\Upload();
$userData = new Controller\Display();
?>
<div class="row">
<div class="col-6 col-12-medium">
<h3>Upload images</h3>
<form method='post' action='' enctype='multipart/form-data'>
<div class="row gtr-uniform">
<div class="col-6 col-12-xsmall">
  
  <ul class="actions">
		<li><input type='file' name='files[]' multiple /></li>
		<li><input class="button primary" type='submit' value='Submit' name='submit' /></li>
</ul>
  </div>
  </div>
</form>
</div>
</div>
<?php 
if(!empty($_POST)){   
    foreach ($form->checkForm($_FILES['files'], $_SESSION['userId']) as $error) {
    echo $error;
}
}



$dataSet = $userData->tableData();

?>

<div class="row">
<div class="table-wrapper" style="width: 100%;">
<table class="alt">
<thead>
  <tr>
    <th>Username</th>
    <th>E-mail</th>
    <th>Image</th>
    <th>Remove</th>
  </tr>
  </thead>
  <tbody>
<?php if ($dataSet) {
      foreach ($dataSet as $data){ ?>
   <tr>
   <td><?php echo $data->getUserName();?></td>
   <td><?php echo $data->getUserEmail();?></td>
   <td><img src="uploads/<?php echo $data->getUserFolder() . '/' . $data->getUserImage();?>" alt="No image yet." style="width:100px;height:100px;"></td>
    <td><?php if($data->getUserId() == $_SESSION['userId']) {?> <a class="confirmation button primary" href="<?php echo "?s=delete&di=" . $data->getUserImageId(); ?>">Delete Image</a> <?php } ?></td>
  </tr>
<?php }
      } ?>
      </tbody>
</table>
</div>
</div>


