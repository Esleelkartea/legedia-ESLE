<?php

/**
 * Initializes a Rest admin Base Action
 *
 * @package    sfWebRPCPlugin
 * @subpackage Actions
 * @author     Jerome Etienne
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
abstract class BaseWebRPCActions extends sfActions
{
	/**
	 * This is the main handle for the xmlrpc calls
	*/
	public function executeRPC2($request)
	{
		// get all the defined RPC
		$rpc_functions	= $this->getRPCFunctions();
		
		// http POST method is required for modifying the database
		$this->forward404Unless($request->isMethod('post'), "HTTP POST is required");

		// log to debug
		ezDbg::err("enter xmlrpc");

		// get xmlrpc request string posted as a raw
		$xmlrpc_reqstr	= file_get_contents("php://input");

		// parse the xmlrpc_reqstr
		$method_name	= null;
		$xmlrpc_params	= xmlrpc_decode_request($xmlrpc_reqstr, &$method_name);
		ezDbg::err("enter method_name=$method_name xmlrpc param=".print_r($xmlrpc_params, true));

		if( !isset($rpc_functions[$method_name]) ){
			$xmlrpc_resp	= array("faultCode" => 1, "faultString" => "unknown method name (".$method_name.")");
		}else{
			$rpc_function	= $rpc_functions[$method_name];
			$nparam		= $rpc_function['nparam'];
			if( count($xmlrpc_params) < $nparam ){
				$xmlrpc_resp	= array("faultCode" => 1, "faultString" => $method_name." require ".$nparam." parameters.");
			}else{
				try{
					ezDbg::err('trying to call ('.$rpc_function['function'].')', $xmlrpc_params);
					$xmlrpc_resp	= call_user_func_array($rpc_function['function'], $xmlrpc_params);
					//$xmlrpc_resp	= sfWebRPCPluginDemo::superAddFct(2,3);
				}catch(Exception $e){
					$xmlrpc_resp	= array("faultCode" => 1, "faultString" => "".$e->getMessage());
				}
			}
		}

		// encode the xmlrpc_resp
		$xmlrpc_respstr	= xmlrpc_encode($xmlrpc_resp);
		{	// KLUDGE: xmlrpc_encode is unable to add the methodResponse required
			$arr	= split("\n", $xmlrpc_respstr);
			$arr[0]	.="\n<methodResponse>";
			$arr[count($arr)-1]	= "</methodResponse>";
			$xmlrpc_respstr	= implode("\n", $arr);
		}
		ezDbg::err("enter xmlrpc resp=".print_r($xmlrpc_respstr, true));
		
		// disable the web_debug bar
		sfConfig::set('sf_web_debug', false);
		// return the $value in xml
		$this->getResponse()->setHttpHeader('Content-Type', 'text/xml');
		return $this->renderText($xmlrpc_respstr);
	}
	
	
	/**
	 * This is the main handle for the JSON/JSONP calls
	*/
	public function executeJSON(sfWebRequest $request)
	{
		// get all the defined RPC
		$rpc_functions	= $this->getRPCFunctions();
		// try to get jsonp callback - if not present assume it is plain json
		$jsonp_cb	= $request->getParameter('callback');

		// get the method
		$method_name	= $request->getParameter('method');
		$this->forward404Unless($method_name, "method url parameter MUST be specified");
		// gather all the method args
		$method_args	= array();
		for($i = 0; $i < 99; $i++){
			$key	= 'arg'.$i;
			if( !$request->hasParameter($key) )	break;
			// parse the method arg
			// ALGO: try to json_decode the value and if it fails, treat it as a string;
			// NOTE: json_decode return null on error, there is a trick to test explicitly the json "null" using the struct
			$val_json	= json_decode($request->getParameter($key), true);
			if( $request->getParameter($key) == "null" )	$method_args[]	= null;
			else if( $val_json == null )			$method_args[]	= '"'.$request->getParameter($key).'"';
			else						$method_args[]	= $val_json;
		}

		if( !isset($rpc_functions[$method_name]) ){
			$error_str	= "unknown method (".$method_name.")";
			$this->forward404($error_str);
		}else{
			$rpc_function	= $rpc_functions[$method_name];
			$nparam		= isset($rpc_function['nparam']) 	? $rpc_function['nparam'] 	: 99;
			$must_post	= isset($rpc_function['must_post'])	? $rpc_function['must_post']	: false;
			// http POST method is required for modifying the database
			if( $must_post && !$request->isMethod('post') )
				$this->forward404("HTTP POST is required for method=".$method_name);
			if( count($method_args) < $nparam ){
				$this->forward404("Error ".$method_name." requires ".$nparam." parameters (got ".count($method_args).")");
			}else{
				try{
					ezDbg::err('trying to call ('.$rpc_function['function'].')', $method_args);
					$resp_data	= call_user_func_array($rpc_function['function'], $method_args);
				}catch(Exception $e){
					$error_str	= "Error ".$method_name." due to ".$e->getMessage();
					$this->forward404($error_str);
				}
			}
		}
		
		// convert $resp_data into $resp_json
		$resp_json	= json_encode($resp_data);

		// build the response
		if( $jsonp_cb ){
			// build the whole javascript to return
			$js_str		= $jsonp_cb.'("'.$resp_json.'");';
			// return the $iframe_url as text/plain
			$this->getResponse()->setHttpHeader('Content-Type', 'text/javascript');
			return $this->renderText($js_str);
		}else{
			// return the $iframe_url as text/plain
			$this->getResponse()->setHttpHeader('Content-Type', 'application/json');
			return $this->renderText($resp_json.";");
		}
	}
	/**
	 * This is the main handle for the XDOMRPC calls
	 *
	 * - this is ultra private ugly stuff from when i wasnt aware of jsonp :)
	 *   - dont ask im not proud
	*/
	public function executeXDOMRPC(sfWebRequest $request)
	{
		// get all the defined RPC
		$rpc_functions	= $this->getRPCFunctions();
		// get obj_id
		$xdomrpc_obj_id	= $request->getParameter('obj_id');
		$this->forward404Unless($xdomrpc_obj_id);

		// get the method
		$method_name	= $request->getParameter('method_name');
		// gather all the method args
		$method_args	= array();
		for($i = 0; $i < 99; $i++){
			$key	= 'arg'.$i;
			if( !$request->hasParameter($key) )	break;
			// parse the method arg
			// ALGO: try to json_decode the value and if it fails, treat it as a string;
			// NOTE: json_decode return null on error, there is a trick to test explicitly the json "null" using the struct
			$val_json	= json_decode($request->getParameter($key), true);
			if( $request->getParameter($key) == "null" )	$method_args[]	= null;
			else if( $val_json == null )			$method_args[]	= '"'.$request->getParameter($key).'"';
			else						$method_args[]	= $val_json;
		}

		// test if $method_name DOES exists
		if( !isset($rpc_functions[$method_name]) ){
			$error_str	= "unknown method (".$method_name.")";
			$data_resp	= array(
				'fault'		=> $error_str,
				'returned_val'	=> null
			);
		}else{
			$rpc_function	= $rpc_functions[$method_name];
			$nparam		= isset($rpc_function['nparam']) 	? $rpc_function['nparam'] 	: 99;
			$must_post	= isset($rpc_function['must_post'])	? $rpc_function['must_post']	: false;
			// http POST method is required for modifying the database
			if( $must_post && !$request->isMethod('post') )
				$this->forward404("HTTP POST is required for method=".$method_name);
			if( count($method_args) < $nparam ){
				$error_str	= "Error ".$method_name." requires ".$nparam." parameters (got ".count($method_args).")";
				$data_resp	= array(
					'fault'		=> $error_str,
					'returned_val'	=> null
				);				
			}else{
				try{
					ezDbg::err('trying to call ('.$rpc_function['function'].')', $method_args);
					$returned_val	= call_user_func_array($rpc_function['function'], $method_args);
					// wrap the returned_val
					$data_resp	= array(
						'fault'		=> NULL,
						'returned_val'	=> json_encode($returned_val)
					);
				}catch(Exception $e){
					$error_str	= "Error ".$method_name." due to ".$e->getMessage();
					$data_resp	= array(
						'fault'		=> $error_str,
						'returned_val'	=> null
					);
				}
			}
		}
		

		// build the javascript to reply
		// TODO should be js_callback parameter ?
		$data_js	= "neoip_xdomrpc_script_reply_var_".$xdomrpc_obj_id."=".json_encode($data_resp).";";

		// disable the web_debug bar
		sfConfig::set('sf_web_debug', false);
		// return the $data_js
		$this->getResponse()->setHttpHeader('Content-Type', 'text/javascript');
		return $this->renderText($data_js);
	}
}
