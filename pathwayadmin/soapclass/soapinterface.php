<?php
class SoapInterface
{
	var $client;
	var $response;
	function SoapInterface()
	{
		global $soap_webservice, $active_group;
		include('./soapclass/soap_webservice.php');
		if (!isset($soap_webservice) OR count($soap_webservice) == 0)
		{
			//show_error('No soap webservice settings were found in the soap webservice config file.');
		}
		
		if(!isset($active_group) OR ! isset($soap_webservice[$active_group]))
		{
			//show_error('You have specified an invalid soap webservice connection group.');
		}
		$url = $soap_webservice[$active_group]['webservice_url'];
		try
		{
			$this->client = @new SoapClient($url, array('exceptions' => 1));
		}
		catch(SoapFault $e)
		{
			//show_error('Some error occured while interacting to the internal webservice.');
			//log_message('error', $e->faultstring);
			die();
		}
	}
	
	function fetchData($command, $parameters)
	{
		if($this->client != null)
		{
			if(($command = $this->__generateXML($command, $parameters)) !== false)
			{
				$answer = $this->client->callMethod($command);
				try
				{
					if($this->response = @simplexml_load_string($answer))
					{
						return true;
					}
					else
					{
						return false;
					}					
				}
				catch(Exception $e)
				{
					//show_error('Some error occured while loading the soap webservice response.');
					//log_message('error', $e->faultstring);
					die();
				}
				
			}
		}
		return false;
	}
	
	function getResponse()
	{
		if($this->response == null)
		{
			return false;
		}
		return $this->response;
	}
	
	function getStatus()
	{
		if($this->response == null)
		{
			return false;
		}
		return (string)$this->response->status;
	}

	function getMessage()
	{
		if($this->response == null)
		{
			return false;
		}
		return $this->response->message;
	}

	function getResult()
	{
		if($this->response == null)
		{
			return false;
		}
		return $this->response->parameter;
	}

	function getProcessedResult($method, $parameter, $param = null)
	{
		$result = $this->fetchData($method, $parameter);
		if($result == true)
		{
			$result = $this->getResponse();
			$status = (string)$result->status;
			$message = (string)$result->message;			
			if($status == "OK" && $message == "Success")
			{
				if($param == null || (is_array($param) && sizeOf($param)==0) || (is_string($param) && $param != "all"))
				{
					return true;
				}
				
				$returndata = array();
				if(is_array($param))
				{
					foreach($param as $key => $value)
					{
						if($result->parameter[$key] != null)
						{
							$returndata[$value] =  (string)$result->parameter[$key];
						}
					}
				}
				else
				{
					foreach($result->parameter as $servicekey => $servicevalue)
					{
						$returndata[] = (string)$servicevalue;
					}
				}
				return $returndata;
			}
		}
		return false;			
	}

	protected function __generateXML($command, $parameters)
	{
		if($command != "" && is_array($parameters) && sizeOf($parameters) > 0)
		{
			$xmlstr = "<?xml version='1.0' standalone='yes' ?>\n";
			$xmlstr .= "<request>\n";
			$xmlstr .= "\t<command>$command</command>\n";
			foreach($parameters as $key => $value)
			{
				//$xmlstr .="\t<parameter name=\"$key\"><![CDATA[$value]]></parameter>\n";
				$xmlstr .="\t<parameter name=\"$key\">$value</parameter>\n";
			}
			$xmlstr .= "</request>";		
			return $xmlstr;
		}
		return false;
	}
}
?>
