<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/lgwebapp.inc");
require_once($path_common."/module.inc");

class PictureSlider extends Module
{
   var $gallery;
   var $type;
   var $picture_width;
   var $slider_frames;

   public function __construct($page, $gallery)
   {
      parent::__construct($page);

      $this->gallery = $gallery;
      $this->type = "default";
      $this->picture_width = 65;
      $this->slider_frames = 8;
   }

   public function get_css_linked()
   {
      // Specify the file in which the CSS for the module is provided.
      return array("sitewide.css");
   }

   public function get_js_linked()
   {
      // Specify the JavaScript files that must be included on the page
      // where this module is created. The JavaScript for this module
      // needs YUI libraries for managing the DOM and doing animation.
      // Presumably, the module's own JavaScript resides in sitewide.js.
      return array
      (
         "yahoo-dom-event.js",
         "animation.js",
         "sitewide.js"
      );
   }

   public function get_js()
   {
      global $path_img;

      // The JavaScript here is dynamically generated. We're using PHP
      // to create some JavaScript that is parameterized by the module.
      // For instance, the total width depends on the number of slides,
      // calculated from the slides passed to the module's constructor.
      $strip_width = $this->picture_width * $this->slider_frames;
      $count = count($this->gallery);
      $total_width = $this->picture_width * $count;

      return <<<EOD
PictureSlider.prototype.update = function()
{
   var pos;

   pos = parseInt(YAHOO.util.Dom.getStyle(this.tab, "left"));

   // Switch images to indicate which buttons are enabled or disabled.
   if (pos >= 0)
      this.lb.src = "{$path_img}/slide_arrow_off_l.gif";
   else
      this.lb.src = "{$path_img}/slide_arrow_l.gif";

   if (pos <= -this.totalWidth + this.stripWidth)
      this.rb.src = "{$path_img}/slide_arrow_off_r.gif";
   else
      this.rb.src = "{$path_img}/slide_arrow_r.gif";
};

var picsld = new PictureSlider();

picsld.init = function()
{
   this.stripWidth = $strip_width;
   this.totalCount = $count;
   this.totalWidth = $total_width;

   this.update();

   // Show the slider only after the JavaScript it needs is loaded. If
   // we're placing JavaScript at the bottom of the page for performance
   // reasons, we must ensure that no interactions take place before the
   // JavaScript has been loaded to handle them.
   this.loaded();
}

picsld.init();

EOD;
   }

   public function get_content()
   {
      global $path_img;

      $strip = $this->get_strip();
      $count = count($this->gallery);

      if ($count > 0)
      {
         $showing = <<<EOD
      Showing picture <strong>1</strong> of $count

EOD;
      }
      else
         $showing = "";

      return <<<EOD
<div id="picsld" class="{$this->type}">
   <div class="sldpos">
$showing
   </div>
   <div class="sldtab">
      <img class="btnl" src="{$path_img}/slide_arrow_l.gif" width="14" onclick="picsld.slideL();" />
      <div class="vwpt">
$strip
      </div>
      <img class="btnr" src="{$path_img}/slide_arrow_r.gif" width="14" onclick="picsld.slideR();" />
   </div>
</div>

EOD;
   }

   protected function get_strip()
   {
      global $path_img;

      // Initialize the HTML that lays out the pictures and the number
      // to assign each picture.
      $items = "";
      $i = 0;

      foreach ($this->gallery as $picture)
      {
         $item_id = "picslditm".$i;

         // Prepare the strings for insertion later between the single
         // quotes in the picsld.select method.
         $img = str_replace("'", "\'", $picture["img_l"]);
         $text = str_replace("'", "\'", $picture["text"]);
         $attr = str_replace("'", "\'", $picture["attr"]);
         $n = $i + 1;

         // At the start, the leftmost slide is selected; therefore, it
         // is shown in the picture viewer.
         if ($i == 0)
            $sel = " selected";
         else
            $sel = "";

         // Create the HTML for one picture. The HTML will be added to
         // the module's HTML after all the pictures have been created.
         $items .= <<<EOD
            <td>
               <div id="$item_id" class="item{$sel}">
                  <img src="{$picture["img_t"]}" alt="{$picture["text"]}"
                     width="55" height="55" onmousedown="picsld.select
                     ('$item_id', $n, '$img', '$text','$attr');" />
               </div>
            </td>

EOD;

         $i++;
      }

      // Add blank slides to fill frames when the number of pictures is
      // not evenly divisible by the frames that appear in the slider.
      while ($i % $this->slider_frames != 0)
      {
         $items .= <<<EOD
            <td>
               <div class="item">
                  <img src="{$path_img}/slide_blank_bg.gif" width="55"
                     height="55" />
               </div>
            </td>

EOD;
         $i++;
      }

      return <<<EOD
      <table cellspacing="0" cellpadding="0" border="0">
         <tr>
$items
         </tr>
      </table>

EOD;
   }
}

class PictureViewer extends Module
{
   var $picture;
   var $type;

   public function __construct($page, $picture)
   {
      parent::__construct($page);

      $this->picture = $picture;
      $this->type = "default";
   }

   public function get_css_linked()
   {
      // Specify the file in which the CSS for the module is provided.
      return array("sitewide.css");
   }

   public function get_content()
   {
      // The content for this module consists of a single image, along
      // with text for the caption and the attribution.
      $attr = "";

      if (!empty($this->picture["attr"]))
      {
         $attr = <<<EOD
   <cite>
      courtesy of {$this->picture["attr"]}
   </cite>

EOD;
      }

      if (empty($this->picture["img_l"]))
         $img = "";
      else
      {
         $img = <<<EOD
      <img src="{$this->picture["img_l"]}" alt="{$this->picture["text"]}"
         width="600" />

EOD;
      }

      return <<<EOD
<div id="picvwr" class="{$this->type}">
   <div class="vwrimg">
$img
   </div>
$attr
   <div class="vwrcap">
      {$this->picture["text"]}
   </div>
</div>

EOD;
   }
}
?>
