<?php
/**
 * Defines the ArticleHolder page type
 */
class GalleryHolder extends Page {
   static $db = array(
   );
   static $has_one = array(
   );
   static $allowed_children = array('GalleryPage');
}
 
class GalleryHolder_Controller extends Page_Controller {
 
}
 
?>
