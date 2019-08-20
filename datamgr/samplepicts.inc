<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/lgwebapp.inc");
require_once($path_datamgr."/datamanager.inc");

class SamplePicturesDataManager extends DataManager
{
   public function __construct()
   {
      parent::__construct();
   }

   public function get_data($load_args, &$load_data, &$load_stat)
   {
      global $path_img;

      $count = ($load_args["count"] > 10) ? 10 : $load_args["count"];

      // Load some sample data for pictures to display in the Slideshow demo.
      for ($i = 1; $i <= $count; $i++)
      {
         $id = ($i < 10) ? "0".$i : $i;

         $load_data[] = array
         (
            "img_t"     => $path_img."/img".$id."_t.gif",
            "img_l"     => $path_img."/img".$id."_l.gif",
            "text"      => "This is the caption for picture ".$i,
            "attr"      => "photographer ".$i
         );
      }
   }
}
?>
