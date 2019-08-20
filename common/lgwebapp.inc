<?php
// If you expand the tar file of examples directly within the document root,
// you shouldn't need to change things here; otherwise, set with your paths.

// Set up the path to the document root.
$path_root = $_SERVER["DOCUMENT_ROOT"]."/lgwebapp";

// Set up the path to the start of URLs.
$path_base = "http://".$_SERVER["SERVER_NAME"]."/lgwebapp";

// Set this to $path_base without the server name.
$path_ajax = "/lgwebapp";

// This is the path to common include files.
$path_common = $path_root."/common";

// This is the path to layout include files.
$path_layout = $path_root."/common/layout";

// This is the path to data manager include files.
$path_datamgr = $path_root."/datamgr";

// This is the path for all JavaScript files.
$path_js = $path_base."/js";

// This is the path for all stylesheet files.
$path_css = $path_base."/css";

// This is the path for a few images used in the examples.
$path_img = $path_base."/images";
?>
