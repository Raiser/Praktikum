<?php
/**********************
 * 
 * Errors / Dev
 * 
 **********************/
//
//Force enviroment to Dev ** REMOVE FOR LIVE SITES **
Director::set_environment_type("dev");
//
//Force cache to flush on page load if in Dev mode (prevents needing ?flush=1 on the end of a URL)
if (Director::isDev()) {
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	SSViewer::flush_template_cache();
	Debug::log_errors_to('err.log');
}
//(v2.4) Log errors to an email address
//SS_Log::add_writer(new SS_LogEmailWriter('me@mydomain.com'), SS_Log::ERR); 
//
//(v2.4) Log errors to a file
//SS_Log::add_writer(new SS_LogFileWriter('error_log.txt'), SS_Log::ERR); 
//




/**
 * Extended URL rules for the CMS module
 * 
 * @package cms
 */
Director::addRules(50, array(
	'processes//$Action/$ID/$Batch' => 'BatchProcess_Controller',
	'admin/help//$Action/$ID' => 'CMSHelp',
	'admin/bulkload//$Action/$ID/$OtherID' => 'BulkLoaderAdmin',
	'admin/cms//$Action/$ID/$OtherID' => 'CMSMain', 
	'PageComment//$Action/$ID' => 'PageComment_Controller',
	'dev/buildcache/$Action' => 'RebuildStaticCacheTask',
));

CMSMenu::add_director_rules();

// Default CMS HTMLEditorConfig
HtmlEditorConfig::get('cms')->setOptions(array(
	'friendly_name' => 'Default CMS',
	'priority' => '50',
	'mode' => 'none',
	'language' => i18n::get_tinymce_lang(),

	'body_class' => 'typography',
	'document_base_url' => Director::absoluteBaseURL(),

	'urlconverter_callback' => "nullConverter",
	'setupcontent_callback' => "sapphiremce_setupcontent",
	'cleanup_callback' => "sapphiremce_cleanup",

	'use_native_selects' => true, // fancy selects are bug as of SS 2.3.0
	'valid_elements' => "@[id|class|style|title],#a[id|rel|rev|dir|tabindex|accesskey|type|name|href|target|title|class],-strong/-b[class],-em/-i[class],-strike[class],-u[class],#p[id|dir|class|align|style],-ol[class],-ul[class],-li[class],br,img[id|dir|longdesc|usemap|class|src|border|alt=|title|width|height|align],-sub[class],-sup[class],-blockquote[dir|class],-table[border=0|cellspacing|cellpadding|width|height|class|align|summary|dir|id|style],-tr[id|dir|class|rowspan|width|height|align|valign|bgcolor|background|bordercolor|style],tbody[id|class|style],thead[id|class|style],tfoot[id|class|style],#td[id|dir|class|colspan|rowspan|width|height|align|valign|scope|style],-th[id|dir|class|colspan|rowspan|width|height|align|valign|scope|style],caption[id|dir|class],-div[id|dir|class|align|style],-span[class|align|style],-pre[class|align],address[class|align],-h1[id|dir|class|align|style],-h2[id|dir|class|align|style],-h3[id|dir|class|align|style],-h4[id|dir|class|align|style],-h5[id|dir|class|align|style],-h6[id|dir|class|align|style],hr[class],dd[id|class|title|dir],dl[id|class|title|dir],dt[id|class|title|dir],@[id,style,class]",
	'extended_valid_elements' => "img[class|src|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|usemap],iframe[src|name|width|height|align|frameborder|marginwidth|marginheight|scrolling],object[width|height|data|type],param[name|value],map[class|name|id],area[shape|coords|href|target|alt]"
));

HtmlEditorConfig::get('cms')->enablePlugins('media', 'fullscreen');
HtmlEditorConfig::get('cms')->enablePlugins(array('ssbuttons' => '../../../cms/javascript/tinymce_ssbuttons/editor_plugin_src.js'));
			
HtmlEditorConfig::get('cms')->insertButtonsBefore('formatselect', 'styleselect');
HtmlEditorConfig::get('cms')->insertButtonsBefore('advcode', 'ssimage', 'ssflash', 'sslink', 'unlink', 'anchor', 'separator' );
HtmlEditorConfig::get('cms')->insertButtonsAfter ('advcode', 'fullscreen', 'separator');
			
HtmlEditorConfig::get('cms')->removeButtons('tablecontrols');
HtmlEditorConfig::get('cms')->addButtonsToLine(3, 'tablecontrols');

// Register default side reports
SS_Report::register("SideReport", "SideReport_EmptyPages");
SS_Report::register("SideReport", "SideReport_RecentlyEdited");
SS_Report::register("SideReport", "SideReport_ToDo");
if (class_exists('SubsiteReportWrapper')) SS_Report::register('ReportAdmin', 'SubsiteReportWrapper("BrokenLinksReport")',-20);
else SS_Report::register('ReportAdmin', 'BrokenLinksReport',-20);


?>
