<?php

$project_rootdir	= dirname(__FILE__).'/../../../../..';
$project_baseurl	= "http://localhost/~jerome/webwork/api.urfastr.net/web/frontend_dev.php";

// to open the doctrine connection
include($project_rootdir.'/test/bootstrap/functional.php');
// to get all the limetest stuff
include($project_rootdir.'/test/bootstrap/unit.php');

$t	= new lime_test(null, new lime_output_color());
$b	= new sfWebBrowser();

// TODO see sfFormExtraPlugin for test in a plugin

/************************************************************************/
/*		Test handler XMLRPC 					*/
/************************************************************************/
$t->diag('sfWebRPCPlugin XMLRPC');

// build the xmlrpc client
require_once $project_rootdir.'/plugins/sfWebRPCPlugin/lib/vendor/IXR_Library.inc.php';
$client 	= new IXR_Client($project_baseurl."/sfWebRPCPluginDemo/RPC2");

// query remote neoip-casti to pull cast_mdata
$succeed	= $client->query('add', 3, 7);
$t->is($client->query('add', 3, 7)	, true, 'call to sfWebRPCPluginDemo::add succeed'    	);
// if it failed, notify the error
//if(! $succeed )	throw new Exception("Error doing xmlrpc to casti_srv_uri due to ".$client->getErrorMessage());

$t->is($client->getResponse(), 10, 'add 3+7 is 10'    	);

$t->is($client->query('fctnamej_which_doesnt_exist')	, false, 'call to unexisting function fails as expected'    	);

/************************************************************************/
/*		Test handler JSON					*/
/************************************************************************/
$t->diag('sfWebRPCPlugin JSON');

$b->get($project_baseurl."/sfWebRPCPluginDemo/JSON?method=add&arg0=3&arg1=2");
$t->is($b->getResponseCode()			, 200			, 'http code 200 on "add" JSON handler'    	);
$t->is($b->getResponseHeader("Content-Type")	, "application/json"	, "mimetype is application/json on json call"	);
$t->is($b->getResponseText()			, 5			, "response is 5 (as expected for add(3,2))"	);

$b->get($project_baseurl."/sfWebRPCPluginDemo/JSON?method=add&arg0=3");
$t->isnt($b->getResponseCode()			, 200			, 'http code NOT 200 "add" when wrong number of parameters'    	);

/************************************************************************/
/*		Test handler JSONP					*/
/************************************************************************/
$t->diag('sfWebRPCPlugin JSONP');

$b->get($project_baseurl."/sfWebRPCPluginDemo/JSON?callback=cbsample&method=add&arg0=3&arg1=2");
$t->is($b->getResponseCode()			, 200			, 'http code 200 on "add" JSON handler'    	);
$t->like($b->getResponseHeader("Content-Type")	, "/text\/javascript/"	, "mimetype is text/javascript on JSONP call"	);
$t->is($b->getResponseText()			, 'cbsample("5")'	, 'response is cbsample("5")'			);

/************************************************************************/
/*		Test handler XDOMRPC					*/
/************************************************************************/
$t->diag('sfWebRPCPlugin XDOMRPC');

$b->get($project_baseurl."/sfWebRPCPluginDemo/XDOMRPC?obj_id=4242&method=add&arg0=3&arg1=2");
$t->is($b->getResponseCode()			, 200			, 'http code 200 on "add" JSON handler'    	);
$t->like($b->getResponseHeader("Content-Type")	, "/text\/javascript/"	, "mimetype is text/javascript on JSONP call"	);
$t->is($b->getResponseText()			, 'neoip_xdomrpc_script_reply_var_4242={"fault":null,"returned_val":5}'
									, 'response is valid content'			);

$b->get($project_baseurl."/sfWebRPCPluginDemo/XDOMRPC?method=add&arg0=3&arg1=2");
$t->isnt($b->getResponseCode()			, 200			, 'http code NOT 200 on invalid xdomrpc call'  	);


