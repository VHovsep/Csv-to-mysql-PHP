<?php include_once("db.php");

?>
<div class="container">
<div class="panel panel-default">
<div class="panel-body">
<br>
<div class="row">
<form action="import.php" method="post" enctype="multipart/form-data" id="import_form">
<div class="col-md-3">
<input type="file" name="file" />
</div>
<div class="col-md-5">
<input type="submit" class="btn btn-primary" name="import_data" value="IMPORT">
</div>
</form>
</div>
<br>
<div class="row">
<table class="table table-bordered">
<thead>
<tr>
<th>Id</th>
<th>Name</th>
<th>Lastname</th>
</tr>
</thead>
<tbody>
<?php
$sql = "SELECT * FROM emp";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
if(mysqli_num_rows($resultset)) {
while( $rows = mysqli_fetch_assoc($resultset) ) {
?>
<tr>
<td><?php echo $rows['id']; ?></td>
<td><?php echo $rows['name']; ?></td>
<td><?php echo $rows['lastname']; ?></td>
</tr>
<?php } } else { ?>
<tr><td colspan="5">0 Field.....</td></tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>