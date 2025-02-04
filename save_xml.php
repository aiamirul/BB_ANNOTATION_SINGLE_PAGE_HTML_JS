<?php
$targetDir = "/var/www/html/labelimg/data";

if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $xmlContent = file_get_contents("php://input"); // Get raw XML data

    if ($xmlContent) {
        $xml = simplexml_load_string($xmlContent); // Parse XML



        if ($xml === false) {
            echo json_encode(["status" => "error", "message" => "Invalid XML format."]);
            exit;
        }

        $filename = (string) $xml->filename;
        if (!$filename) {
            echo json_encode(["status" => "error", "message" => "Missing filename in XML."]);
            exit;
        }

        $filePath = $targetDir ."/". pathinfo($filename, PATHINFO_FILENAME) . ".xml"; // Save with same name as image
	
        file_put_contents($filePath, $xmlContent);
        file_put_contents("/var/www/html/labelimg/debug.log", "Received XML: " . $xmlContent . "\n", FILE_APPEND);




        echo json_encode(["status" => "danger", "message" => "$filePath XML saved! ### $xmlContent ###", "path" => $filePath]);
    } else {
        echo json_encode(["status" => "error", "message" => "No XML data received."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
