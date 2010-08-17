<?php
/**
* Defines the ArticlePage page type
*/
class ArticlePage extends Page {
	static $db = array(
		'Date' => 'Date',
		'Author' => 'Text'

		);
	static $has_one = array(
		);

	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$datefield = new DateField('Date');
		$datefield->setConfig('showcalendar', true);
		$datefield->setConfig('showdropdown', true);
		$datefield->setConfig('dateformat', 'dd/MM/YYYY');

		$fields->addFieldToTab('Root.Content.Main', $datefield, 'Content');
		$fields->addFieldToTab('Root.Content.Main', new TextField('Author'), 'Content');

		return $fields;
	}

}

class ArticlePage_Controller extends Page_Controller {

}


