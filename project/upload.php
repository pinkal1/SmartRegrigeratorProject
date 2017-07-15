<?php
include_once 'dbconnect.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Select grocery receipt..</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="header">
<label>Select grocery receipt..</label>
 <br /><br /> <br /><br />
</div>
<div id="body">
 <form action="uploadphp.php" method="post" enctype="multipart/form-data">
 <input type="file" name="file" />
 <button type="submit" name="btn-upload">upload</button>
 </form>
    <br /><br />
    <?php
 if(isset($_GET['success']))
 {
  $license_code = 'F223E4928B9C4538BFB48708C457C568';
  $username =  'PINK';
  ?>
        <label>File Uploaded Successfully...  <a href="viewupload.php">click here to view file.</a></label>
        <?php
 }
 else if(isset($_GET['fail']))
 {
  ?>
        <label>Problem While File Uploading !</label>
        <?php
 }
 else
 {
  ?>
        <label>Try to upload any files(PDF, DOC, JPEG, etc...)</label>
        <?php
 }
 ?>
</div>
<div id="footer">
<label>By <a href="http://cleartuts.blogspot.com">Pinkal Patel</a></label>
</div>
</body>
</html>