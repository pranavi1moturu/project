
<?
$target_dir = "uploads/";
$target_file = $target_dir .basename($_FILES["fileToUpload"]["name"]);
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
$uploadOk=1;
$tmp_name = $_FILES["fileToUpload"]["tmp_name"];
$name = basename($_FILES["fileToUpload"]["name"]);
if ($imageFileType != 'csv')
 {
 echo 'You can only upload a CSV file';
 }
 else
 {
move_uploaded_file($tmp_name, "$target_dir/$name");
header('Location:index.php?page=htmlTabledisplay&file='.$target_file);
?>