<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
//initialize the main class
$obj = new main();
class Manage 
{
    public static function autoload($class)
     {
        //you can put any file name or directory here
        include $class . '.php';
    }
}
spl_autoload_register(array('Manage', 'autoload'));
class main
{
    function __construct()
    {
        //default page when no page is requested
        $pageRequest = 'uploadForm';
        //check if page is set
        if(isset($_REQUEST['page']))
        {
           $pageRequest = $_REQUEST['page'];
        }
        //call requested page
        $page = new $pageRequest;
            //check requested method and call function
        if($_SERVER['REQUEST_METHOD'] == 'GET')
         {
            $page->show();
        } else {
            $page->display();
        }
    }
}
abstract class page
{
    protected $html;
    function __construct()
    {
        $this->html.='<html><head>';
        //$this->html.='<link rel="stylesheet" href="styles.css" type="text/css">';
        $this->html.= '</head><body>';
    }
    function __destruct()
    {
        $this->html.='</body></html>';
        print_r($this->html);
        //stringFunctions::echoString($this->html);
    }
}
class uploadForm extends page
{
//HTML form
        function show()
        {
            $form = '<form action="index.php?page=uploadForm" method="post" enctype="multipart/form-data">';
            $form .= '<h1>Select the fileto upload</h1>';
            $form .= '<input type="file" name="fileToUpload" id="fileToUpload">';
            $form .= '<input type="submit" value="Upload File" name="submit">';
            $form.= '</form>';
            $this->html.=$form;
        }
//uploading files to directory
function display()
   {       
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
}

}
}
//csv file to html file display
class htmlTabledisplay extends page
{
function show()
{

 $a = $_REQUEST["file"];
 $row = 0;
 if (($handle = fopen($a, "r")) !== FALSE)
  {
 echo "<table border='3'>";
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
      {
        $num = count($data);
        echo '<tr>'; 
         for ($c=0; $c < $num; $c++)
          {
            if ($row == 0) 
            {
            echo '<th>' . $data[$c] . '</th>';
            }
            else  echo '<td>' .  $data[$c] . '</td>';
         }
     echo '</tr>';
     $row++;
     }
     echo '</table>';
     fclose($handle);
     }
else
{
echo 'There is an error in your table display'.$handle;
}
}
}
?>











