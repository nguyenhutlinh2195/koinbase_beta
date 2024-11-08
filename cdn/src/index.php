<?
ini_set('display_errors', 'Off');
error_reporting(0);

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

function getExtesion($url)
{
    return "." . pathinfo(parse_url($url)['path'], PATHINFO_EXTENSION);
}

function isImage($file_path)
{
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $file_path);
    $whitelist = array("image/jpeg", "image/png", "image/gif");
    if (in_array($mime_type, $whitelist, TRUE)) {
        return true;
    }
    return false;
}

$result->status_code = 500;
$result->message = "";

if (isset($_GET['url'])) {
    $url = $_GET['url'];
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        $result->message = "Not a valid url";
        die(json_encode($result));
    }

    $file_name = "upload/" . bin2hex(random_bytes(8)) . getExtesion($url);
    $data = file_get_contents($url); 

    if ($data) {
        file_put_contents($file_name, $data);

        if (isImage($file_name)) {
            $result->message = $file_name;
            $result->status_code = 200;
        } else {
            $result->message = "File is not an image";
            unlink($file_name);
        }

        die(json_encode($result));
    } else {
        $result->message = "Cannot get file contents";
        die(json_encode($result));
    }
} else {
    $result->message = "Missing params";
    die(json_encode($result));
}
