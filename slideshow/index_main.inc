<?php
/*
*  Slideshow
*
*  This demo illustrates more complex modules that encapsulate HTML, CSS, and
*  JavaScript. It incorporates several of the examples presented in Chapter 7.
*/

require_once($_SERVER["DOCUMENT_ROOT"]."/lgwebapp.inc");
require_once($path_common."/sitepage.inc");
require_once($path_common."/slideshow.inc");
require_once($path_datamgr."/samplepicts.inc");

class SlideshowPage extends SitePage
{
   protected $count;

   public function __construct()
   {
      parent::__construct();

      $this->init();
   }

   public function get_css_linked()
   {
      return array
      (
         "sitewide.css"
      );
   }

   public function get_css()
   {
      return <<<EOD
#picsld
{
   float: left;
}
#picvwr
{
   float: left;
}

EOD;
   }

   public function get_js_linked()
   {
      return array
      (
         "yahoo-dom-event.js",
         "animation.js",
         "sitewide.js"
      );
   }

   public function load_data()
   {
      $dm = new SamplePicturesDataManager();

      $this->load_args = array
      (
         "count"     => $this->count
      );

      $dm->get_data
      (
         $this->load_args,
         $this->load_data["sample_pictures"],
         $this->load_stat
      );

      // Normally you would check the status member for any errors here.
   }

   public function get_header()
   {
      return "";
   }

   public function get_footer()
   {
      return "";
   }

   public function get_content()
   {

      // Create the picture slider and picture viewer for the slideshow.
      $mod = new PictureSlider
      (
         $this,
         $this->load_data["sample_pictures"]
      );

      $slider = $mod->create();

      $mod = new PictureViewer
      (
         $this,
         $this->load_data["sample_pictures"][0]
      );

      $viewer = $mod->create();

      return <<<EOD
$slider
$viewer

EOD;
   }

   public function title()
   {
      $this->title = "Slideshow Page";
   }

   private function init()
   {
      // Support controlling the maximum number of pictures within the URL.
      if (!empty($_GET["count"]) && $_GET["count"] > 0)
         $this->count = $_GET["count"];
      else
         $this->count = 10;
   }
}
?>
