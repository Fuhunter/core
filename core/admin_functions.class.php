<?php
 /*
 * Project:		EQdkp-Plus
 * License:		Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:		2002
 * Date:		$Date$
 * -----------------------------------------------------------------------
 * @author		$Author$
 * @copyright	2006-2011 EQdkp-Plus Developer Team
 * @link		http://eqdkp-plus.com
 * @package		eqdkp-plus
 * @version		$Rev$
 *
 * $Id$
 */
if(!class_exists('admin_functions')) {
class admin_functions extends gen_class {
	public static $shortcuts = array('user', 'in', 'core', 'config', 'tpl', 'game', 'jquery', 'pm', 'time', 'pdh', 'db', 'pdc','routing', 'html',
		'xmltools'	=> 'xmltools',
		'puf'		=> 'urlfetcher',
	);

	public function resolve_ip($strIP){
		$out = false;
		if(strlen($strIP)){
			$return = $this->puf->fetch("http://www.geoplugin.net/php.gp?ip=".$this->in->get('ip_resolve'));
			if ($return){
				$unserialized = @unserialize($return);
				if ($unserialized){
					$out = array(
						'city' 			=> $unserialized['geoplugin_city'],
						'regionName'	=> $unserialized['geoplugin_regionName'],
						'countryName'	=> $unserialized['geoplugin_countryName'],
					);

					if (!strlen($out['countryName'])) $out = false; 
				}
			}
		}
		
		return $out;
	}
	
	public function resolve_bots($strUseragent){
		$arrBots = array(
			array( // row #0
				'bot_agent' => 'AdsBot-Google',
				'bot_name' => 'AdsBot [Google]',
			),
			array( // row #1
				'bot_agent' => 'ia_archiver',
				'bot_name' => 'Alexa [Bot]',
			),
			array( // row #2
				'bot_agent' => 'Scooter/',
				'bot_name' => 'Alta Vista [Bot]',
			),
			array( // row #3
				'bot_agent' => 'Ask Jeeves',
				'bot_name' => 'Ask Jeeves [Bot]',
			),
			array( // row #4
				'bot_agent' => 'Baiduspider+(',
				'bot_name' => 'Baidu [Spider]',
			),
			array( // row #5
				'bot_agent' => 'Exabot/',
				'bot_name' => 'Exabot [Bot]',
			),
			array( // row #6
				'bot_agent' => 'FAST Enterprise Crawler',
				'bot_name' => 'FAST Enterprise [Crawler]',
			),
			array( // row #7
				'bot_agent' => 'FAST-WebCrawler/',
				'bot_name' => 'FAST WebCrawler [Crawler]',
			),
			array( // row #8
				'bot_agent' => 'http://www.neomo.de/',
				'bot_name' => 'Francis [Bot]',
			),
			array( // row #9
				'bot_agent' => 'Gigabot/',
				'bot_name' => 'Gigabot [Bot]',
			),
			array( // row #10
				'bot_agent' => 'Mediapartners-Google',
				'bot_name' => 'Google Adsense [Bot]',
			),
			array( // row #11
				'bot_agent' => 'Google Desktop',
				'bot_name' => 'Google Desktop',
			),
			array( // row #12
				'bot_agent' => 'Feedfetcher-Google',
				'bot_name' => 'Google Feedfetcher',
			),
			array( // row #13
				'bot_agent' => 'Googlebot',
				'bot_name' => 'Google [Bot]',
			),
			array( // row #14
				'bot_agent' => 'heise-IT-Markt-Crawler',
				'bot_name' => 'Heise IT-Markt [Crawler]',
			),
			array( // row #15
				'bot_agent' => 'heritrix/1.',
				'bot_name' => 'Heritrix [Crawler]',
			),
			array( // row #16
				'bot_agent' => 'ibm.com/cs/crawler',
				'bot_name' => 'IBM Research [Bot]',
			),
			array( // row #17
				'bot_agent' => 'ICCrawler - ICjobs',
				'bot_name' => 'ICCrawler - ICjobs',
			),
			array( // row #18
				'bot_agent' => 'ichiro/',
				'bot_name' => 'ichiro [Crawler]',
			),
			array( // row #19
				'bot_agent' => 'MJ12bot/',
				'bot_name' => 'Majestic-12 [Bot]',
			),
			array( // row #20
				'bot_agent' => 'MetagerBot/',
				'bot_name' => 'Metager [Bot]',
			),
			array( // row #21
				'bot_agent' => 'msnbot-NewsBlogs/',
				'bot_name' => 'MSN NewsBlogs',
			),
			array( // row #22
				'bot_agent' => 'msnbot/',
				'bot_name' => 'MSN [Bot]',
			),
			array( // row #23
				'bot_agent' => 'msnbot-media/',
				'bot_name' => 'MSNbot Media',
			),
			array( // row #24
				'bot_agent' => 'NG-Search/',
				'bot_name' => 'NG-Search [Bot]',
			),
			array( // row #25
				'bot_agent' => 'http://lucene.apache.org/nutch/',
				'bot_name' => 'Nutch [Bot]',
			),
			array( // row #26
				'bot_agent' => 'NutchCVS/',
				'bot_name' => 'Nutch/CVS [Bot]',
			),
			array( // row #27
				'bot_agent' => 'OmniExplorer_Bot/',
				'bot_name' => 'OmniExplorer [Bot]',
			),
			array( // row #28
				'bot_agent' => 'online link validator',
				'bot_name' => 'Online link [Validator]',
			),
			array( // row #29
				'bot_agent' => 'psbot/0',
				'bot_name' => 'psbot [Picsearch]',
			),
			array( // row #30
				'bot_agent' => 'Seekbot/',
				'bot_name' => 'Seekport [Bot]',
			),
			array( // row #31
				'bot_agent' => 'Sensis Web Crawler',
				'bot_name' => 'Sensis [Crawler]',
			),
			array( // row #32
				'bot_agent' => 'SEO search Crawler/',
				'bot_name' => 'SEO Crawler',
			),
			array( // row #33
				'bot_agent' => 'Seoma [SEO Crawler]',
				'bot_name' => 'Seoma [Crawler]',
			),
			array( // row #34
				'bot_agent' => 'SEOsearch/',
				'bot_name' => 'SEOSearch [Crawler]',
			),
			array( // row #35
				'bot_agent' => 'Snappy/1.1 ( http://www.urltrends.com/ )',
				'bot_name' => 'Snappy [Bot]',
			),
			array( // row #36
				'bot_agent' => 'http://www.tkl.iis.u-tokyo.ac.jp/~crawler/',
				'bot_name' => 'Steeler [Crawler]',
			),
			array( // row #37
				'bot_agent' => 'SynooBot/',
				'bot_name' => 'Synoo [Bot]',
			),
			array( // row #38
				'bot_agent' => 'crawleradmin.t-info@telekom.de',
				'bot_name' => 'Telekom [Bot]',
			),
			array( // row #39
				'bot_agent' => 'TurnitinBot/',
				'bot_name' => 'TurnitinBot [Bot]',
			),
			array( // row #40
				'bot_agent' => 'voyager/1.0',
				'bot_name' => 'Voyager [Bot]',
			),
			array( // row #41
				'bot_agent' => 'W3 SiteSearch Crawler',
				'bot_name' => 'W3 [Sitesearch]',
			),
			array( // row #42
				'bot_agent' => 'W3C-checklink/',
				'bot_name' => 'W3C [Linkcheck]',
			),
			array( // row #43
				'bot_agent' => 'W3C_*Validator',
				'bot_name' => 'W3C [Validator]',
			),
			array( // row #44
				'bot_agent' => 'http://www.WISEnutbot.com',
				'bot_name' => 'WiseNut [Bot]',
			),
			array( // row #45
				'bot_agent' => 'yacybot',
				'bot_name' => 'YaCy [Bot]',
			),
			array( // row #46
				'bot_agent' => 'Yahoo-MMCrawler/',
				'bot_name' => 'Yahoo MMCrawler [Bot]',
			),
			array( // row #47
				'bot_agent' => 'Yahoo! DE Slurp',
				'bot_name' => 'Yahoo Slurp [Bot]',
			),
			array( // row #48
				'bot_agent' => 'Yahoo! Slurp',
				'bot_name' => 'Yahoo [Bot]',
			),
			array( // row #49
				'bot_agent' => 'YahooSeeker/',
				'bot_name' => 'YahooSeeker [Bot]',
			),
			
		);
		
		foreach ($arrBots as $row){
			if (preg_match('#' . str_replace('\*', '.*?', preg_quote($row['bot_agent'], '#')) . '#i', $strUseragent)){
				return $row['bot_name'];
			}
		}
		return false;
	}
	
	/**
	 * Resolve the User Browser
	 *
	 * @param string $member
	 * @return string
	 */
	function resolve_browser($string){
		$string = sanitize($string);
		if( preg_match("/opera/i",$string)){
			return "<img src=\"".$this->root_path."images/glyphs/browser/opera_icon.png\" alt=\"Opera\" class=\"coretip-left\" data-coretip=\"".$string."\" />";
		}else if( preg_match("/msie/i",$string)){
			return "<img src=\"".$this->root_path."images/glyphs/browser/ie_icon.png\" alt=\"Internet Explorer\" class=\"coretip-left\" data-coretip=\"".$string."\" />";
		}else if( preg_match("/chrome/i", $string)){
			return "<img src=\"".$this->root_path."images/glyphs/browser/chrome_icon.png\" alt=\"Google Chrome\" class=\"coretip-left\" data-coretip=\"".$string."\" />";
		}else if( preg_match("/konqueror/i",$string)){
			return "<img src=\"".$this->root_path."images/glyphs/browser/konqueror_icon.png\" alt=\"Konqueror\" class=\"coretip-left\" data-coretip=\"".$string."\" />";
		}else if( preg_match("/safari/i",$string) ){
			return "<img src=\"".$this->root_path."images/glyphs/browser/safari_icon.png\" alt=\"Safari\" class=\"coretip-left\" data-coretip=\"".$string."\" />";
		}else if( preg_match("/lynx/i",$string) ){
			return "<span class=\"coretip-left\" data-coretip=\"".$string."\">Lynx</span>";
		}else if( preg_match("/mozilla/i",$string) ){
			return "<img src=\"".$this->root_path."images/glyphs/browser/firefox_icon.png\" alt=\"Firefox\" class=\"coretip-left\" data-coretip=\"".$string."\" />";
		}else if( preg_match("/w3m/i",$string) ){
			return "<span class=\"coretip-left\" data-coretip=\"".$string."\">w3m</span>";
		}else{
			return "<i class=\"fa fa-question-circle fa-lg fa-fw coretip-left\" data-coretip=\"".$string."\"></i>";
		}
	}
	
	/**
	 * Resolve the EQDKP Page the user is surfing on..
	 *
	 * @param string $member
	 * @return string
	 */
	function resolve_eqdkp_page($strPage){

		$matches = explode('&', $strPage);
		$strPath = $matches[0];

		if (strlen($strPath)){
			$strQuery = $matches[1];
			$arrQuery = array();
			parse_str($strQuery, $arrQuery);
			$arrFolder = explode('/', $strPath);
			$strOut = "";
			
			//Prefixes for Admin, Plugins, Maintenance
			switch($arrFolder[0]){
				case 'admin' : $strPrefix = registry::fetch('user')->lang('menu_admin_panel').': ';
				break;
				case 'plugins' : $strPrefix = registry::fetch('user')->lang('pi_title').': '; $strOut = ((registry::fetch('user')->lang($arrFolder[1])) ? registry::fetch('user')->lang($arrFolder[1]) : ucfirst($arrFolder[1]));
				break;
				case 'maintenance' : $strPrefix = registry::fetch('user')->lang('maintenance'); $strOut = " ";
				break;
				case 'portal': $strPrefix = registry::fetch('user')->lang('portal').': '; $strOut = ((registry::fetch('user')->lang($arrFolder[1])) ? registry::fetch('user')->lang($arrFolder[1]) : ucfirst($arrFolder[1]));
				break;
				default: $strPrefix = '';
			}
			
			//Resolve Admin Pages
			if ($arrFolder[0] == "admin"){
				//First, some admin pages without menu entry
				switch($strPath){
					case 'admin/info_php':
						$strOut = '<a href="'.$this->root_path.'admin/info_php.php'.$this->SID.'">PHP-Info</a>';
					break;
					
					case 'admin/manage_articles':
						$strOut = '<a href="'.$this->root_path.'admin/manage_articles.php'.$this->SID.'&amp;'.$strQuery.'">'.$this->user->lang('manage_articles').'</a>';
					break;
					
					case 'admin/manage_styles':
						$strOut = '<a href="'.$this->root_path.'admin/manage_styles.php'.$this->SID.'&amp;'.$strQuery.'">'.$this->user->lang('styles_title').'</a>';
					break;
					
					case 'admin':
					case 'admin/index':
						$strOut = registry::fetch('user')->lang('menu_admin_panel');
						$strPrefix = "";
					break;
				}
				
				//Now check if there is an menu entry
				if($strOut == ""){
					$admin_menu = $this->adminmenu(false);
					$result = search_in_array($strPath.".php".$this->SID, $admin_menu);
					if ($result){
						$arrMenuEntry = arraykey_for_array($result, $admin_menu);
						if ($arrMenuEntry) $strOut = '<a href="'.$this->root_path.$arrMenuEntry['link'].'">'.$arrMenuEntry['text'].'</a>';
					}				
				}
			}
			
			//Resolve Frontend Page
			if ($strOut == "" && $strPrefix == ""){
				$intArticleID = $intCategoryID = 0;
				
				$arrPath = array_reverse($arrFolder);

				//Suche Alias in Artikeln
				$intArticleID = $this->pdh->get('articles', 'resolve_alias', array(str_replace(".html", "", utf8_strtolower($arrPath[0]))));
				if (!$intArticleID){
					//Suche Alias in Kategorien
					$intCategoryID = $this->pdh->get('article_categories', 'resolve_alias', array(str_replace(".html", "", utf8_strtolower($arrPath[0]))));
					
					//Suche in Artikeln mit nächstem Index, denn könnte ein dynamischer Systemartikel sein
					if (!$intCategoryID && isset($arrPath[1])) {					
						$intArticleID = $this->pdh->get('articles', 'resolve_alias', array(str_replace(".html", "", utf8_strtolower($arrPath[1]))));
					}
				}

				if ($intArticleID){
					$strOut = $this->user->lang('article').': <a href="'.$this->server_path.$this->pdh->get('articles', 'path', array($intArticleID)).'">'.$this->pdh->get('articles', 'title', array($intArticleID)).'</a>';
				} elseif($intCategoryID) {
					$strOut = $this->user->lang('category').': <a href="'.$this->server_path.$this->pdh->get('article_categories', 'path', array($intCategoryID)).'">'.$this->pdh->get('article_categories', 'name', array($intCategoryID)).'</a>';
				} elseif (register('routing')->staticRoute($arrPath[0]) || register('routing')->staticRoute($arrPath[1])) {
					$strPageObject = register('routing')->staticRoute($arrPath[0]);
					if (!$strPageObject) {			
						$strPageObject = register('routing')->staticRoute($arrPath[1]);
					}
					
					if ($strPageObject){

						$strID = str_replace("-", "", strrchr(str_replace(".html", "", $arrPath[0]), "-"));
						$arrMatches = array();
						$myVar = false;
						preg_match_all('/[a-z]+|[0-9]+/', $strID, $arrMatches, PREG_PATTERN_ORDER);
						if (isset($arrMatches[0]) && count($arrMatches[0])){
							if (count($arrMatches[0]) == 2){
								$myVar = $arrMatches[0][1];
							}
						}
						if (strlen($strID) && count($arrMatches[0]) != 2) $myVar = $strID;
						
						switch($strPageObject){
							case 'settings': $strOut = registry::fetch('user')->lang('settings_title');
								break;
							case 'login': $strOut = registry::fetch('user')->lang('login_title');
								break;
							case 'mycharacters': $strOut = registry::fetch('user')->lang('manage_members_titl');
								break;
							case 'search': $strOut = registry::fetch('user')->lang('search');
								break;
							case 'register': $strOut = registry::fetch('user')->lang('register_title');
								break;
							//TODO Add Title
							case 'addcharacter': $strOut = '';
								break;
							case 'editarticle': $strOut = $this->user->lang('manage_articles');
								if (isset($arrQuery['aid']) && $arrQuery['aid']) $strOut .= ': <a href="'.$this->server_path.$this->pdh->get('articles', 'path', array($arrQuery['aid'])).'">'.$this->pdh->get('articles', 'title', array($arrQuery['aid'])).'</a>';
								break;
							case 'user': $strOut = $this->user->lang('user');
								if ($myVar) $strOut .= ': <a href="'.$this->server_path.sanitize($strPage).'">'.$this->pdh->get('user', 'name', array($myVar)).'</a>';
								break;
							case 'usergroup': $strOut = $this->user->lang('usergroup');
								if ($myVar) $strOut .= ': <a href="'.$this->server_path.sanitize($strPage).'">'.$this->pdh->get('user_groups', 'name', array((int)$myVar)).'</a>';
								break;
							case 'rss': $strOut = "RSS";
								break;
							case 'wrapper': {
								if($arrFolder[1] == "board" || $arrFolder[1] == "boardregister" || $arrFolder[1] == "lostpassword") {
									$strOut = '<a href="'.$this->routing->build('External', 'Board').'">'.$this->user->lang('forum').'</a>';
								} elseif($myVar) {
									$strOut = $this->user->lang('viewing_wrapper').': <a href="'.$this->routing->build('External', $this->pdh->get('links', 'name', array(intval($myVar))), intval($myVar)).'">'.$this->pdh->get('links', 'name', array(intval($myVar))).'</a>';
								} else {
									$strOut = $this->user->lang('viewing_wrapper');
								}								
							}
								break;
							case 'tag': $strOut .= $this->user->lang('tag').': <a href="'.$this->routing->build('tag', sanitize($arrFolder[1])).'">'.sanitize($arrFolder[1]).'</a>';
								break;
						}
					}		
				} else {
					//Some special frontend pages
					switch($strPath){
						case "api":
						case "exchange": $strOut = registry::fetch('user')->lang('viewing_exchange');
						break;
					}
				}
				
			}
		}
		
		if ($strOut == '') $strOut = '<span style="font-style:italic;">'.$this->user->lang('unknown').'</span>';
		return $strPrefix.$strOut;
	}
	
	public function adminmenu($blnShowBadges = true, $coreUpdates="", $extensionUpdates=""){
		$admin_menu = array(
			'members' => array(
				'icon'	=> 'fa-user fa-lg fa-fw',
				'name'	=> $this->user->lang('chars'),
				1		=> array('link' => 'admin/manage_members.php'.$this->SID,			'text' => $this->user->lang('manage_members'),	'check' => 'a_members_man',	'icon'	=> 'fa-user fa-lg fa-fw'),
				2		=> array('link' => 'admin/manage_items.php'.$this->SID,			'text' => $this->user->lang('manitems_title'),	'check' => 'a_item_',		'icon' => 'fa-gift fa-lg fa-fw'),
				3		=> array('link' => 'admin/manage_adjustments.php'.$this->SID,		'text' => $this->user->lang('manadjs_title'),		'check' => 'a_indivadj_',	'icon' => 'fa-tag fa-lg fa-fw'),
				4		=> array('link' => 'admin/manage_ranks.php'.$this->SID,			'text' => $this->user->lang('manrank_title'),		'check' => 'a_members_man',	'icon' => 'fa-flag fa-lg fa-fw'),
				5		=> array('link' => 'admin/manage_profilefields.php'.$this->SID,	'text' => $this->user->lang('manage_pf_menue'),	'check' => 'a_config_man',	'icon' => 'fa-sitemap fa-lg fa-fw'),
				6		=> array('link' => 'admin/manage_roles.php'.$this->SID,			'text' => $this->user->lang('rolemanager'),		'check' => 'a_config_man',	'icon' => 'fa-beer fa-lg fa-fw'),
				7		=> array('link' => 'admin/manage_auto_points.php'.$this->SID,		'text' => $this->user->lang('manage_auto_points'),'check' => 'a_config_man',	'icon' => 'fa-magic fa-lg fa-fw'),
			),
			'users' => array(
				'icon'	=> 'fa-group fa-lg fa-fw',
				'name'	=> $this->user->lang('users'),
				1		=> array('link' => 'admin/manage_users.php'.$this->SID,			'text' => $this->user->lang('manage_users'),		'check' => 'a_users_man',	'icon' => 'fa-user fa-lg fa-fw'),
				2		=> array('link' => 'admin/manage_user_groups.php'.$this->SID,		'text' => $this->user->lang('manage_user_groups'),'check' => array('OR', array('a_usergroups_man', 'a_usergroups_grpleader')),	'icon' => 'fa-group fa-lg fa-fw'),
				3		=> array('link' => 'admin/manage_maintenance_user.php'.$this->SID,'text' => $this->user->lang('maintenanceuser_user'),'check' => 'a_maintenance','icon' => 'fa-user-md fa-lg fa-fw'),
				4		=> array('link' => 'admin/manage_massmail.php'.$this->SID,'text' => $this->user->lang('massmail'),'check' => 'a_users_massmail','icon' => 'fa fa-envelope fa-lg fa-fw'),
			),
			'extensions' => array(
				'name'	=> $this->user->lang('extensions').(($blnShowBadges) ? $extensionUpdates : ''),
				'icon' => 'fa-cogs fa-lg fa-fw',
				1		=> array('link' => 'admin/manage_extensions.php'.$this->SID,		'text' => $this->user->lang('extension_repo'),'check' => 'a_config_man',	'icon' => 'fa-cogs fa-lg fa-fw'),
			),
			'portal'	=> array(
				'icon'	=> 'fa-home fa-lg fa-fw',
				'name'	=> $this->user->lang('portal'),
				1		=> array('link' => 'admin/manage_portal.php'.$this->SID,			'text' => $this->user->lang('portalmanager'),		'check' => 'a_config_man',	'icon' => 'fa-columns fa-lg fa-fw'),
				2		=> array('link' => 'admin/manage_article_categories.php'.$this->SID,'text' => $this->user->lang('manage_articles'),		'check' => 'a_articles_man',	'icon' => 'fa-file-text fa-lg fa-fw'),
				3		=> array('link' => 'admin/manage_pagelayouts.php'.$this->SID,		'text' => $this->user->lang('page_manager'),		'check' => 'a_config_man',	'icon' => 'fa-table fa-lg fa-fw'),
				4		=> array('link' => 'admin/manage_menus.php'.$this->SID,				'text' => $this->user->lang('manage_menus'),		'check' => 'a_config_man',	'icon' => 'fa-list fa-lg fa-fw'),
				
			),
			'raids'	=> array(
				'icon'	=> 'fa-trophy fa-lg fa-fw',
				'name'	=> $this->user->lang('raids'),
				1		=> array('link' => 'admin/manage_raids.php'.$this->SID,			'text' => $this->user->lang('manage_raids'),		'check' => 'a_raid_add',	'icon' => 'fa-trophy fa-lg fa-fw'),
				2		=> array('link' => 'admin/manage_events.php'.$this->SID,			'text' => $this->user->lang('manevents_title'),	'check' => 'a_event_upd',	'icon' => 'fa-key fa-lg fa-fw'),
				3		=> array('link' => 'admin/manage_multidkp.php'.$this->SID,		'text' => $this->user->lang('manmdkp_title'),		'check' => 'a_event_upd',	'icon' => 'fa-gavel fa-lg fa-fw'),
				4		=> array('link' => 'admin/manage_itempools.php'.$this->SID,		'text' => $this->user->lang('manitempools_title'),'check' => 'a_event_upd',	'icon' => 'fa-tags fa-lg fa-fw'),
				5		=> array('link' => 'admin/manage_raid_groups.php'.$this->SID,		'text' => $this->user->lang('manage_raid_groups'),'check' => array('OR', array('a_raidgroups_man', 'a_raidgroups_grpleader')),	'icon' => 'fa-users fa-lg fa-fw'),
			),
			'calendar'	=> array(
				'icon'	=> 'fa-calendar fa-lg fa-fw',
				'name'	=> $this->user->lang('calendars'),
				1		=> array('link' => 'admin/manage_calendars.php'.$this->SID,		'text' => $this->user->lang('manage_calendars'),	'check' => 'a_calendars_man',	'icon' => 'fa-calendar fa-lg fa-fw'),
				2		=> array('link' => 'admin/manage_calevents.php'.$this->SID,		'text' => $this->user->lang('manage_calevents'),	'check' => 'a_cal_event_man',	'icon' => 'fa-clock-o fa-lg fa-fw'),
			),
			'general' => array(
				'icon'	=> 'fa-wrench fa-lg fa-fw',
				'name'	=> $this->user->lang('general_admin'),
				1		=> array('link' => 'admin/manage_settings.php'.$this->SID,		'text' => $this->user->lang('configuration'),		'check' => 'a_config_man',	'icon' => 'fa-wrench fa-lg fa-fw'),
				2		=> array('link' => 'admin/manage_logs.php'.$this->SID,			'text' => $this->user->lang('view_logs'),			'check' => 'a_logs_view',	'icon' => 'fa-book fa-lg fa-fw'),
				3		=> array('link' => 'admin/manage_tasks.php'.$this->SID,			'text' => $this->user->lang('mantasks_title'),		'check' => array('OR', array('a_users_man', 'a_members_man')),	'icon' => 'fa-tasks fa-lg fa-fw'),
				4		=> array('link' => 'admin/manage_bridge.php'.$this->SID,		'text' => $this->user->lang('manage_bridge'),	'check' => 'a_config_man',	'icon' => 'fa-link fa-lg fa-fw'),
				5		=> array('link' => 'admin/manage_crons.php'.$this->SID,			'text' => $this->user->lang('manage_cronjobs'),		'check' => 'a_config_man',	'icon' => 'fa-clock-o fa-lg fa-fw'),
				6		=> array('link' => 'admin/manage_media.php'.$this->SID,			'text' => $this->user->lang('manage_media'),		'check' => 'a_files_man',	'icon' => 'fa-picture-o fa-lg fa-fw'),
			),
			'maintenance' => array(
				'icon'	=> 'fa-cog fa-lg fa-fw',
				'name'	=> $this->user->lang('menu_maintenance').(($blnShowBadges) ? $coreUpdates : ''),
				1		=> array('link' => 'maintenance/task_manager.php'.$this->SID,		'text' => $this->user->lang('maintenance'),		'check' => 'a_maintenance',	'icon' => 'fa-cog fa-lg fa-fw'),
				2		=> array('link' => 'admin/manage_live_update.php'.$this->SID,		'text' => $this->user->lang('liveupdate'),		'check' => 'a_maintenance',	'icon' => 'fa fa-refresh fa-lg fa-fw'),
				3		=> array('link' => 'admin/manage_backup.php'.$this->SID,			'text' => $this->user->lang('backup'),			'check' => 'a_backup',		'icon' => 'fa-floppy-o fa-lg fa-fw'),
				4		=> array('link' => 'admin/manage_reset.php'.$this->SID,			'text' => $this->user->lang('reset'),				'check' => 'a_config_man',	'icon' => 'fa-retweet fa-lg fa-fw'),
				5		=> array('link' => 'admin/manage_cache.php'.$this->SID,			'text' => $this->user->lang('pdc_manager'),		'check' => 'a_config_man',	'icon' => 'fa-briefcase fa-lg fa-fw'),
				6		=> array('link' => 'admin/info_database.php'.$this->SID,			'text' => $this->user->lang('mysql_info'),		'check' => 'a_config_man',	'icon' => 'fa-info-circle fa-lg fa-fw'),				
			),
		);

		// Now get plugin hooks for the menu
		$admin_menu = (is_array($this->pm->get_menus('admin'))) ? array_merge_recursive($admin_menu, array('extensions'=>$this->pm->get_menus('admin'))) : $admin_menu;

		//Now get the admin-favorits
		$favs_array = array();
		if($this->config->get('admin_favs')) {
			$favs_array = @unserialize(stripslashes($this->config->get('admin_favs')));
		}
		$admin_menu['favorits']['icon'] = 'fa-star fa-lg fa-fw';
		$admin_menu['favorits']['name'] = $this->user->lang('favorits');
		//Style Management
		$admin_menu['favorits'][1] = array(
			'link'	=> 'admin/manage_extensions.php'.$this->SID.'&tab=1',
			'text'	=> $this->user->lang('styles_title'),
			'check'	=> 'a_extensions_man',
			'icon'	=> 'fa-leaf fa-lg fa-fw',
		);
			
		$i = 2;
		if (is_array($favs_array) && count($favs_array) > 0){
			foreach ($favs_array as $fav){
				$items = explode('|', $fav);
				$adm = $admin_menu;
				foreach ($items as $item){
					$latest = $adm;
					$adm = (isset($adm[$item])) ? $adm[$item] : false;
				}
				if (isset($adm['link'])){
					$admin_menu['favorits'][$i] = array(
						'link'	=> $adm['link'],
						'text'	=> $adm['text'].((count($items) == 3) ? ' ('.$latest['name'].')': ''),
						'check'	=> $adm['check'],
						'icon'	=> $adm['icon'],
					);
				}
				$i++;
			}
		} else { //If there are no links, point to the favorits-management
			$admin_menu['favorits'][2] = array(
				'link'	=> 'admin/manage_menus.php'.$this->SID.'&tab=1',
				'text'	=> $this->user->lang('manage_menus'),
				'check'	=> 'a_config_man',
				'icon'	=> 'fa-list fa-lg fa-fw',
			);
		}
		
		return $admin_menu;
	}
}
}
?>