<?php

function checkFiles($filename) {
    $jpgPath = "/var/www/html/labelimg/img/$filename.jpg";
    $xmlPath = "/var/www/html/labelimg/data/$filename.xml";

    if ( !file_exists($xmlPath)) {
        echo " <a href='http://13.228.134.229/labelimg/index.php?imagepath=$filename'><button>   $filename  </button> </a>";
    }
else{
 echo "<a href='http://13.228.134.229/labelimg/index.php?imagepath=$filename' > <button>  COMPLETED $filename   </button></a>";


}



}

// Get list of all .jpg files in /img
$glob_files = glob("/var/www/html/labelimg/img/*.jpg");
$filenames = array_map(function($file) {
    return pathinfo($file, PATHINFO_FILENAME);
}, $glob_files);

foreach ($filenames as $filename) {
    checkFiles($filename);
}

?>
