<?php
 
class StaffPage extends Page {
   static $db = array(
   );
   static $has_one = array(
      'Photo' => 'Image'
   );
 
   function getCMSFields() {
      $fields = parent::getCMSFields();
 
      $fields->addFieldToTab("Root.Content.Images", new ImageField('Photo'));
 
      return $fields;
   }
}
 
class StaffPage_Controller extends Page_Controller {
 
}
?>
