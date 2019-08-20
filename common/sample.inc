<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/lgwebapp.inc");
require_once($path_common."/module.inc");

class SampleModule extends Module
{
   protected $class;
   protected $ident;
   protected $height;

   public function __construct($page, $ident, $height = 0)
   {
      parent::__construct($page);

      // This is a sample module for demonstration purposes. It's simply a
      // block of color with a label just to show where the module exists.
      $this->height = $height;

      // This is also a simple example of a module with multiple instances.
      $this->class = "smpmod";
      $this->ident = $this->class.$ident;
   }

   public function get_css_linked()
   {
      return array("lgwebapp.css");
   }

   public function get_content()
   {
      $style = "";

      // If a height is specified, let that override the default stylesheet.
      if ($this->height != 0)
      {
         $style = "style=\"height: ".$this->height."px\"";
      }

      return <<<EOD
<div id="$this->ident" class="$this->class"$style>
   Sample Module ($this->ident)
</div>

EOD;
   }
}
?>
