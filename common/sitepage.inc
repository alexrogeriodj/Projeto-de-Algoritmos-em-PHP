<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/lgwebapp.inc");
require_once($path_common."/page.inc");

class SitePage extends Page
{
   public function __construct()
   {
      parent::__construct();
   }

   public function get_js_common()
   {
      // Specify an array of JavaScript files to link for every page.
      return array();
   }

   public function get_css_common()
   {
      // Specify an array of stylesheet files to link for every page.
      return array
      (
         "lgwebapp.css"
      );
   }

   public function get_header()
   {
      // Return the HTML markup for the header across the entire site.
      return <<<EOD
<div id="sitehdr">
   Sitewide Header
</div>

EOD;
   }

   public function get_footer()
   {
      // Return the HTML markup for the footer across the entire site.
      return <<<EOD
<div id="siteftr">
   Sitewide Footer
</div>

EOD;
   }

   public function register_links()
   {
      global $path_css;
      global $path_js;

      // Build the data structure for resolving stylesheet filenames.
      $this->css_linked_info = array
      (
         "launcher.css" => array
         (
            "aka_path" => $path_css."/launcher_20091204.css",
            "loc_path" => $path_css."/launcher_20091204.css",
            "media"    => "all"
         ),
         "laydemos.css" => array
         (
            "aka_path" => $path_css."/laydemos_20091204.css",
            "loc_path" => $path_css."/laydemos_20091204.css",
            "media"    => "all"
         ),
         "multisel.css" => array
         (
            "aka_path" => $path_css."/multisel_20091204.css",
            "loc_path" => $path_css."/multisel_20091204.css",
            "media"    => "all"
         ),
         "mvcpanel.css" => array
         (
            "aka_path" => $path_css."/mvcpanel_20091204.css",
            "loc_path" => $path_css."/mvcpanel_20091204.css",
            "media"    => "all"
         ),
         "sitewide.css" => array
         (
            "aka_path" => $path_css."/sitewide_20091204.css",
            "loc_path" => $path_css."/sitewide_20091204.css",
            "media"    => "all"
         )
      );

      // When this member is set to true, stylesheet keys resolve to
      // the loc_path paths; otherwise, the aka_path paths are used.
      $this->css_is_local = false;

      // Build the data structure for resolving JavaScript filenames.
      $this->js_linked_info = array
      (
         "animation.js" => array
         (
            "aka_path" => $path_js."/animation_2.8.0r4.js",
            "loc_path" => $path_js."/animation_2.8.0r4.js"
         ),
         "connection.js" => array
         (
            "aka_path" => $path_js."/connection_2.8.0r4.js",
            "loc_path" => $path_js."/connection_2.8.0r4.js"
         ),
         "json_parse.js" => array
         (
            "aka_path" => $path_js."/json_parse_20091204.js",
            "loc_path" => $path_js."/json_parse_20091204.js"
         ),
         "model-view-cont.js" => array
         (
            "aka_path" => $path_js."/model-view-cont_20091204.js",
            "loc_path" => $path_js."/model-view-cont_20091204.js"
         ),
         "sitewide.js" => array
         (
            "aka_path" => $path_js."/sitewide_20091204.js",
            "loc_path" => $path_js."/sitewide_20091204.js"
         ),
         "yahoo-dom-event.js" => array
         (
            "aka_path" => $path_js."/yahoo-dom-event_2.8.0r4.js",
            "loc_path" => $path_js."/yahoo-dom-event_2.8.0r4.js"
         )
      );

      // When this member is set to true, JavaScript keys resolve to
      // the loc_path paths; otherwise, the aka_path paths are used.
      $this->js_is_local = false;
   }

   // You would likely define a number of other methods here for tasks
   // that are specific to your site and useful across the entire site.
}
?>
