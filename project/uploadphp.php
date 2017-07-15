<?php
include_once 'dbconnect.php';
if(isset($_POST['btn-upload']))
{    
     
 $file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
 $folder="uploads/";
 
 // new file size in KB
 $new_size = $file_size/1024;  
 // new file size in KB
 
 // make file name in lower case
 $new_file_name = strtolower($file);
 // make file name in lower case
 
 $final_file=str_replace(' ','-',$new_file_name);
 
 if(move_uploaded_file($file_loc,$folder.$final_file))
 {

  $license_code = 'F223E492-8B9C-4538-BFB4-8708C457C568';
  $username =  'PINK';
  $url = 'http://www.ocrwebservice.com/restservices/processDocument?gettext=true';
  $filePath =$folder.$final_file ;

  
        $fp = fopen($filePath, 'r');
        $session = curl_init();

        curl_setopt($session, CURLOPT_URL, $url);
        curl_setopt($session, CURLOPT_USERPWD, "$username:$license_code");

        curl_setopt($session, CURLOPT_UPLOAD, true);
        curl_setopt($session, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($session, CURLOPT_TIMEOUT, 200);
        curl_setopt($session, CURLOPT_HEADER, false);


        // For SSL using
        //curl_setopt($session, CURLOPT_SSL_VERIFYPEER, true);

        // Specify Response format to JSON or XML (application/json or application/xml)
        curl_setopt($session, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
 
        curl_setopt($session, CURLOPT_INFILE, $fp);
        curl_setopt($session, CURLOPT_INFILESIZE, filesize($filePath));

        $result = curl_exec($session);

     echo '<pre>'; print_r($result); die;
     
    $httpCode = curl_getinfo($session, CURLINFO_HTTP_CODE);
        curl_close($session);
        fclose($fp);
  
        if($httpCode == 401) 
  {
           // Please provide valid username and license code
           die('Unauthorized request');
        }

        // Output response
  $data = json_decode($result);

        if($httpCode != 200) 
  {
     // OCR error
           die($data->ErrorMessage);
        }

        // Task description
  echo 'TaskDescription:'.$data->TaskDescription."\r\n";

        // Available pages 
  echo 'AvailablePages:'.$data->AvailablePages."\r\n";

        // Extracted text
        echo 'OCRText='.$data->OCRText[0][0]."\r\n";

        
  $sql="INSERT INTO tbl_uploads(file,type,size) VALUES('$final_file','$file_type','$new_size')";
  mysql_query($sql);
  ?>
  <script>
  alert('successfully uploaded');
        window.location.href='viewupload.php?success';
        </script>
  <?php
 }
 else
 {
  ?>
  <script>
  alert('error while uploading file');
        window.location.href='upload.php?fail';
        </script>
  <?php
 }
}
?>