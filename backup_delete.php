<?php


define('CLI_SCRIPT', true); //enable for command line execution
require_once(dirname(__FILE__) . '/../config.php');
require_once($CFG->dirroot . '/course/lib.php');
   
global $DB;

$sql = <<<SQL
SELECT
  component
, filearea
, itemid
, contextid
, filepath
, filename
FROM mdl_files as f
LIMIT 1
SQL;

$records = $DB->get_records_sql($sql);
//var_dump($records);
//print_r($records);


$fs = get_file_storage();
 
// Prepare file record object
$fileinfo = array(
    'component' => $records['course']->component,
    'filearea' =>  $records['course']->filearea,     // usually = table name
    'itemid' =>    $records['course']->itemid,          // usually = ID of row in table
    'contextid' => $records['course']->contextid, // ID of context
    'filepath' =>  $records['course']->filepath,    // any path beginning and ending in /
    'filename' =>  $records['course']->filename,); // any filename
 
// Get file
$file = $fs->get_file($fileinfo['contextid'], $fileinfo['component'], $fileinfo['filearea'], 
        $fileinfo['itemid'], $fileinfo['filepath'], $fileinfo['filename']);
 
if(empty($file))
{
	echo "empty";
}
else {
	print_r($file);
	
//$file->delete();
//echo "Deleted";	
}
?>