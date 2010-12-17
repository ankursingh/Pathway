<?php 		
		//------------- Start Company Part -------------------------------------------------------
		$path_parts = pathinfo($_SERVER['REQUEST_URI']);

		if($path_parts['dirname'] == "/" && ($path_parts['basename'] == "" || $path_parts['basename'] == "index.php"))
		{
			$strTitle 		= HOME_TITLE;
			$strDesc 		= HOME_META_DESC;
			$strKeywords 	= HOME_META_KEYWORDS;
			$strKeyphrases 	= HOME_META_KEYPHRASES;									
		}		
		else if($path_parts['dirname'] == "/company" && $path_parts['basename'] == "index.php")
		{
			$strTitle 		= COMPANY_TITLE;
			$strDesc 		= COMPANY_META_DESC;
			$strKeywords 	= COMPANY_META_KEYWORDS;
			$strKeyphrases 	= COMPANY_META_KEYPHRASES;									
		}		
		else if($path_parts['dirname'] == "/company" && $path_parts['basename'] == "why_pathway.php")		
		{
			$strTitle 		= COMPANY_WHY_PATHWAY_TITLE;
			$strDesc 		= COMPANY_WHY_PATHWAY_META_DESC;
			$strKeywords 	= COMPANY_WHY_PATHWAY_META_KEYWORDS;
			$strKeyphrases 	= COMPANY_WHY_PATHWAY_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/company" && $path_parts['basename'] == "news.php")
		{
			$strTitle 		= COMPANY_NEWS_TITLE;
			$strDesc 		= COMPANY_NEWS_META_DESC;
			$strKeywords 	= COMPANY_NEWS_META_KEYWORDS;
			$strKeyphrases 	= COMPANY_NEWS_META_KEYPHRASES;									
		}
		//------------- start careers Part---------------------------------------------
		else if($path_parts['dirname'] == "/company" && $path_parts['basename'] == "careers.php")
		{
			$strTitle 		= COMPANY_CAREERS_TITLE;
			$strDesc 		= COMPANY_CAREERS_META_DESC;
			$strKeywords 	= COMPANY_CAREERS_META_KEYWORDS;
			$strKeyphrases 	= COMPANY_CAREERS_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/company" && $path_parts['basename'] == "account-mgr.php")
		{
			$strTitle 		= COMPANY_CAREERS_ACC_MGR_TITLE;
			$strDesc 		= COMPANY_CAREERS_ACC_MGR_META_DESC;
			$strKeywords 	= COMPANY_CAREERS_ACC_MGR_META_KEYWORDS;
			$strKeyphrases 	= COMPANY_CAREERS_ACC_MGR_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/company" && $path_parts['basename'] == "careers_network_technician.php")
		{
			$strTitle 		= COMPANY_CAREERS_NW_TECH_TITLE;
			$strDesc 		= COMPANY_CAREERS_NW_TECH_META_DESC;
			$strKeywords 	= COMPANY_CAREERS_NW_TECH_META_KEYWORDS;
			$strKeyphrases 	= COMPANY_CAREERS_NW_TECH_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/company" && $path_parts['basename'] == "antispam.php")
		{
			$strTitle 		= COMPANY_ANTISPAM_TITLE;
			$strDesc 		= COMPANY_ANTISPAM_META_DESC;
			$strKeywords 	= COMPANY_ANTISPAM_META_KEYWORDS;
			$strKeyphrases 	= COMPANY_ANTISPAM_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/company" && $path_parts['basename'] == "quarantine_spam.php")
		{
			$strTitle 		= COMPANY_QUARANTINE_TITLE;
			$strDesc 		= COMPANY_QUARANTINE_META_DESC;
			$strKeywords 	= COMPANY_QUARANTINE_META_KEYWORDS;
			$strKeyphrases 	= COMPANY_QUARANTINE_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/company" && $path_parts['basename'] == "spam_control_faq.php")
		{
			$strTitle 		= COMPANY_SPAM_CTRL_FAQ_TITLE;
			$strDesc 		= COMPANY_SPAM_CTRL_FAQ_META_DESC;
			$strKeywords 	= COMPANY_SPAM_CTRL_FAQ_META_KEYWORDS;
			$strKeyphrases 	= COMPANY_SPAM_CTRL_FAQ_META_KEYPHRASES;									
		}
		//------------- end careers Part---------------------------------------------

		//------------- End company Part---------------------------------------------
		//------------- start services Part---------------------------------------------
		else if($path_parts['dirname'] == "/products" && $path_parts['basename'] == "index.php")
		{
			$strTitle 		= PRODUCT_TITLE;
			$strDesc 		= PRODUCT_META_DESC;
			$strKeywords 	= PRODUCT_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/products" && $path_parts['basename'] == "fiber_optic.php")
		{
			$strTitle 		= PRODUCT_FIBRE_OPTIC_TITLE;
			$strDesc 		= PRODUCT_FIBRE_OPTIC_META_DESC;
			$strKeywords 	= PRODUCT_FIBRE_OPTIC_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_FIBRE_OPTIC_META_KEYPHRASES;		
		}
		else if($path_parts['dirname'] == "/products" && $path_parts['basename'] == "t1_dedicated.php")
		{
			$strTitle 		= PRODUCT_T1_TITLE;
			$strDesc 		= PRODUCT_T1_META_DESC;
			$strKeywords 	= PRODUCT_T1_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_T1_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/products" && $path_parts['basename'] == "business_ADSL.php")
		{
			$strTitle 		= PRODUCT_BUSSI_ADSL_TITLE;
			$strDesc 		= PRODUCT_BUSSI_ADSL_META_DESC;
			$strKeywords 	= PRODUCT_BUSSI_ADSL_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_BUSSI_ADSL_META_KEYPHRASES;
		}
		else if($path_parts['dirname'] == "/products" && $path_parts['basename'] == "wireless_internet.php")
		{
			$strTitle 		= PRODUCT_WIRELESS_TITLE;
			$strDesc 		= PRODUCT_WIRELESS_META_DESC;
			$strKeywords 	= PRODUCT_WIRELESS_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_WIRELESS_META_KEYPHRASES;
		}
		else if($path_parts['dirname'] == "/products" && $path_parts['basename'] == "isdn.php")
		{
			$strTitle 		= PRODUCT_ISDN_TITLE;
			$strDesc 		= PRODUCT_ISDN_META_DESC;
			$strKeywords 	= PRODUCT_ISDN_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_ISDN_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/products" && $path_parts['basename'] == "global_connect.php")
		{
			$strTitle 		= PRODUCT_GLOBAL_CONNECT_TITLE;
			$strDesc 		= PRODUCT_GLOBAL_CONNECT_META_DESC;
			$strKeywords 	= PRODUCT_GLOBAL_CONNECT_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_GLOBAL_CONNECT_META_KEYPHRASES;
		}
		else if($path_parts['dirname'] == "/products" && $path_parts['basename'] == "global_phone_finder.php")
		{
			$strTitle 		= PRODUCT_GLOBAL_PHONE_TITLE;
			$strDesc 		= PRODUCT_GLOBAL_PHONE_META_DESC;
			$strKeywords 	= PRODUCT_GLOBAL_PHONE_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_GLOBAL_PHONE_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/products" && $path_parts['basename'] == "troubleshoot_guide.php")
		{
			$strTitle 		= PRODUCT_TROUBLE_SHOOT_TITLE;
			$strDesc 		= PRODUCT_TROUBLE_SHOOT_META_DESC;
			$strKeywords 	= PRODUCT_TROUBLE_SHOOT_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_TROUBLE_SHOOT_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/products" && $path_parts['basename'] == "server_colocation.php")
		{
			$strTitle 		= PRODUCT_SERV_COLO_TITLE;
			$strDesc 		= PRODUCT_SERV_COLO_META_DESC;
			$strKeywords 	= PRODUCT_SERV_COLO_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_SERV_COLO_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/products" && $path_parts['basename'] == "managed_colocation_services.php")
		{
			$strTitle 		= PRODUCT_MGD_COLO_TITLE;
			$strDesc 		= PRODUCT_MGD_COLO_META_DESC;
			$strKeywords 	= PRODUCT_MGD_COLO_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_MGD_COLO_META_KEYPHRASES;
		}
		else if($path_parts['dirname'] == "/products" && $path_parts['basename'] == "hosting.php")
		{
			$strTitle 		= PRODUCT_HOSTING_TITLE;
			$strDesc 		= PRODUCT_HOSTING_META_DESC;
			$strKeywords 	= PRODUCT_HOSTING_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_HOSTING_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/products" && $path_parts['basename'] == "residential_internet.php")
		{
			$strTitle 		= PRODUCT_RESI_INT_TITLE;
			$strDesc 		= PRODUCT_RESI_INT_META_DESC;
			$strKeywords 	= PRODUCT_RESI_INT_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_RESI_INT_META_KEYPHRASES;
		}
		else if($path_parts['dirname'] == "/products" && ($path_parts['basename'] == "highspeed_fastpath_secure.php" || $path_parts['basename'] == "highspeed_fastpath_homenet.php" ) )
		{
			$strTitle 		= PRODUCT_FASTPATH_TITLE;
			$strDesc 		= PRODUCT_FASTPATH_META_DESC;
			$strKeywords 	= PRODUCT_FASTPATH_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_FASTPATH_META_KEYPHRASES;
		}
		else if($path_parts['dirname'] == "/products" && $path_parts['basename'] == "highspeed_lightpath.php")
		{
			$strTitle 		= PRODUCT_LIGHTPATH_TITLE;
			$strDesc 		= PRODUCT_LIGHTPATH_META_DESC;
			$strKeywords 	= PRODUCT_LIGHTPATH_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_LIGHTPATH_META_KEYPHRASES;
		}		
		else if($path_parts['dirname'] == "/products" && $path_parts['basename'] == "highspeed_faq.php")
		{
			$strTitle 		= PRODUCT_HIGHSPEED_FAQ_TITLE;
			$strDesc 		= PRODUCT_HIGHSPEED_FAQ_META_DESC;
			$strKeywords 	= PRODUCT_HIGHSPEED_FAQ_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_HIGHSPEED_FAQ_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/products" && $path_parts['basename'] == "minimum_req.php")
		{
			$strTitle 		= PRODUCT_MINI_REQ_TITLE;
			$strDesc 		= PRODUCT_MINI_REQ_META_DESC;
			$strKeywords 	= PRODUCT_MINI_REQ_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_MINI_REQ_META_KEYPHRASES;									
		}		
		else if($path_parts['dirname'] == "/products" && $path_parts['basename'] == "dialup_internet.php")
		{
			$strTitle 		= PRODUCT_DIALUP_INTERNET_TITLE;
			$strDesc 		= PRODUCT_DIALUP_INTERNET_META_DESC;
			$strKeywords 	= PRODUCT_DIALUP_INTERNET_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_DIALUP_INTERNET_META_KEYPHRASES;
		}		
		else if($path_parts['dirname'] =="services/connectivity")
		{
			$strTitle 		= PRODUCT_CONNECTIVITY_TITLE;
			$strDesc 		= PRODUCT_CONNECTIVITY_META_DESC;
			$strKeywords 	= PRODUCT_CONNECTIVITY_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_CONNECTIVITY_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] =="services/datahosting")
		{
			$strTitle 		= PRODUCT_DATAHOSTING_TITLE;
			$strDesc 		= PRODUCT_DATAHOSTING_META_DESC;
			$strKeywords 	= PRODUCT_DATAHOSTING_META_KEYWORDS;
			$strKeyphrases 	= PRODUCT_DATAHOSTING_META_KEYPHRASES;									
		}
		//------------- end services Part---------------------------------------------
		//------------- start legal Part---------------------------------------------
		else if($path_parts['dirname'] == "/" && $path_parts['basename'] == "legal_notice.php")
		{
			$strTitle 		= HOME_LEGAL_NOTICE_TITLE;
			$strDesc 		= HOME_LEGAL_NOTICE_META_DESC;
			$strKeywords 	= HOME_LEGAL_NOTICE_META_KEYWORDS;
			$strKeyphrases 	= HOME_LEGAL_NOTICE_META_KEYPHRASES;									
		}
		//------------- end legal Part---------------------------------------------
		//------------- start sitemap Part---------------------------------------------
		else if($path_parts['dirname'] == "/" && $path_parts['basename'] == "site_map.php")
		{
			$strTitle 		= HOME_SITEMAP_TITLE;
			$strDesc 		= HOME_SITEMAP_META_DESC;
			$strKeywords 	= HOME_SITEMAP_META_KEYWORDS;
			$strKeyphrases 	= HOME_SITEMAP_META_KEYPHRASES;									
		}
		//------------- end sitemap Part---------------------------------------------
		//------------- start contact Part---------------------------------------------
		else if($path_parts['dirname'] == "/contactus" && $path_parts['basename'] == "index.php")
		{
			$strTitle 		= CONTACT_TITLE;
			$strDesc 		= CONTACT_META_DESC;
			$strKeywords 	= CONTACT_META_KEYWORDS;
			$strKeyphrases 	= CONTACT_META_KEYPHRASES;
		}
		//------------- end sitemap Part---------------------------------------------
		//------------- start resellers Part---------------------------------------------
		else if($path_parts['dirname'] == "/resellers" && $path_parts['basename'] == "index.php")
		{
			$strTitle 		= RESELLER_TITLE;
			$strDesc 		= RESELLER_META_DESC;
			$strKeywords 	= RESELLER_META_KEYWORDS;
			$strKeyphrases 	= RESELLER_META_KEYPHRASES;
		}
		//------------- end resellers Part---------------------------------------------
		//------------- start customer support Part---------------------------------------------
		else if($path_parts['dirname'] == "/customer" && $path_parts['basename'] == "index.php")
		{
			$strTitle 		= CUSTOMER_TITLE;
			$strDesc 		= CUSTOMER_META_DESC;
			$strKeywords 	= CUSTOMER_META_KEYWORDS;
			$strKeyphrases 	= CUSTOMER_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/customer" && $path_parts['basename'] == "internet_access.php")
		{
			$strTitle 		= CUSTOMER_INT_ACCESS_TITLE;
			$strDesc 		= CUSTOMER_INT_ACCESS_META_DESC;
			$strKeywords 	= CUSTOMER_INT_ACCESS_META_KEYWORDS;
			$strKeyphrases 	= CUSTOMER_INT_ACCESS_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/customer" && $path_parts['basename'] == "smart_desk.php")
		{
			$strTitle 		= CUSTOMER_SMART_DESK_TITLE;
			$strDesc 		= CUSTOMER_SMART_DESK_META_DESC;
			$strKeywords 	= CUSTOMER_SMART_DESK_META_KEYWORDS;
			$strKeyphrases 	= CUSTOMER_SMART_DESK_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/customer" && $path_parts['basename'] == "smartdesk_faq.php")
		{
			$strTitle 		= CUSTOMER_SMART_DESK_FAQ_TITLE;
			$strDesc 		= CUSTOMER_SMART_DESK_FAQ_META_DESC;
			$strKeywords 	= CUSTOMER_SMART_DESK_FAQ_META_KEYWORDS;
			$strKeyphrases 	= CUSTOMER_SMART_DESK_FAQ_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/customer" && $path_parts['basename'] == "smartdesk_user_guide.php")
		{
			$strTitle 		= CUSTOMER_SMART_DESK_GUIDE_TITLE;
			$strDesc 		= CUSTOMER_SMART_DESK_GUIDE_META_DESC;
			$strKeywords 	= CUSTOMER_SMART_DESK_GUIDE_META_KEYWORDS;
			$strKeyphrases 	= CUSTOMER_SMART_DESK_GUIDE_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/customer" && $path_parts['basename'] == "live_chat.php")
		{
			$strTitle 		= CUSTOMER_LIVE_CHAT_TITLE;
			$strDesc 		= CUSTOMER_LIVE_CHAT_META_DESC;
			$strKeywords 	= CUSTOMER_LIVE_CHAT_META_KEYWORDS;
			$strKeyphrases 	= CUSTOMER_LIVE_CHAT_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/customer" && $path_parts['basename'] == "live_faq.php")
		{
			$strTitle 		= CUSTOMER_LIVE_CHAT_FAQ_TITLE;
			$strDesc 		= CUSTOMER_LIVE_CHAT_FAQ_META_DESC;
			$strKeywords 	= CUSTOMER_LIVE_CHAT_FAQ_META_KEYWORDS;
			$strKeyphrases 	= CUSTOMER_LIVE_CHAT_FAQ_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/customer" && $path_parts['basename'] == "livechat_user_guide.php")
		{
			$strTitle 		= CUSTOMER_LIVE_CHAT_GUIDE_TITLE;
			$strDesc 		= CUSTOMER_LIVE_CHAT_GUIDE_META_DESC;
			$strKeywords 	= CUSTOMER_LIVE_CHAT_GUIDE_META_KEYWORDS;
			$strKeyphrases 	= CUSTOMER_LIVE_CHAT_GUIDE_META_KEYPHRASES;									
		}
		
		//------------- end customer support Part---------------------------------------------
		//------------- Spam and Virus Control ---------------------------------------------
		else if($path_parts['dirname'] == "/customer" && $path_parts['basename'] == "virus_faq.php")
		{
			$strTitle 		= CUSTOMER_VIRUS_FAQ_TITLE;
			$strDesc 		= CUSTOMER_VIRUS_FAQ_META_DESC;
			$strKeywords 	= CUSTOMER_VIRUS_FAQ_META_KEYWORDS;
			$strKeyphrases 	= CUSTOMER_VIRUS_FAQ_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/customer" && $path_parts['basename'] == "inbound_register.php")
		{
			$strTitle 		= CUSTOMER_INBOUND_REG_TITLE;
			$strDesc 		= CUSTOMER_INBOUND_REG_META_DESC;
			$strKeywords 	= CUSTOMER_INBOUND_REG_META_KEYWORDS;
			$strKeyphrases 	= CUSTOMER_INBOUND_REG_META_KEYPHRASES;									
		}
		else if($path_parts['dirname']  =="virus/virus-alerts")		
		{
			$strTitle 		= CUSTOMER_VIRUS_ALERT_TITLE;
			$strDesc 		= CUSTOMER_VIRUS_ALERT_META_DESC;
			$strKeywords 	= CUSTOMER_VIRUS_ALERT_META_KEYWORDS;
			$strKeyphrases 	= CUSTOMER_VIRUS_ALERT_META_KEYPHRASES;									
		}
		else if($path_parts['dirname']  =="virus/virus-stats")		
		{
			$strTitle 		= CUSTOMER_VIRUS_STATS_TITLE;
			$strDesc 		= CUSTOMER_VIRUS_STATS_META_DESC;
			$strKeywords 	= CUSTOMER_VIRUS_STATS_META_KEYWORDS;
			$strKeyphrases 	= CUSTOMER_VIRUS_STATS_META_KEYPHRASES;									
		}
		else if($path_parts['dirname'] == "/customer" && $path_parts['basename'] == "dryloop_faq.php")
		{
			$strTitle 		= CUSTOMER_DRYLOOP_FAQ_TITLE;
			$strDesc 		= CUSTOMER_DRYLOOP_FAQ_META_DESC;
			$strKeywords 	= CUSTOMER_DRYLOOP_FAQ_META_KEYWORDS;
			$strKeyphrases 	= CUSTOMER_DRYLOOP_FAQ_META_KEYPHRASES;									
		}
		//------------- End Spam and Virus Control-------------------------------------------------------
		
		//------------- Else Set Default Title ---------------------------------------------
		else
		{		
			$strTitle 		= DEFAULT_TITLE;
			$strDesc 		= DEFAULT_META_DESC;
			$strKeywords 	= DEFAULT_META_KEYWORDS;
			$strKeyphrases 	= DEFAULT_META_KEYPHRASES;									
		}			
		
		$message = "<title>$strTitle</title>\n";
		$message .= "<META NAME=\"Description\" CONTENT=\"$strDesc\">\n";
		$message .= "<META NAME=\"Keywords\" CONTENT=\"$strKeywords\">\n";
		$message .= "<META NAME=\"Keyphrases\" CONTENT=\"$strKeyphrases\">";
			
		echo ($message); 
		
		//------------- End - Default Title Part -------------------------------------------------------
?>	
<META NAME="ROBOTS" CONTENT="INDEX,FOLLOW">
<META NAME="ROBOTS" CONTENT="INDEX,ALL">
<META NAME="resource-type" CONTENT="document">
<META NAME="classification" CONTENT="Internet Connectivity | Hosting | Network Management | Internet Security solutions">
<META NAME="distribution" CONTENT="Global">
<META NAME="rating" CONTENT="Pathway Communications">
<META NAME="doc-type" CONTENT="Public">
<META NAME="doc-class" CONTENT="Published">
<META NAME="doc-rights" CONTENT="Private">
<META NAME="doc-publisher" CONTENT="Pathway Communications">
<META NAME="author" CONTENT="Pathway Communications">
<META NAME="language" CONTENT="English">
<META NAME="copyright" CONTENT="Pathway Communications">
<META NAME="idg-url" CONTENT="http://www.pathcom.com">
<meta http-equiv="Pragma" CONTENT="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<noscript>
  <META HTTP-EQUIV="Refresh" CONTENT="0;URL='/disabled_js.php'">
</noscript>