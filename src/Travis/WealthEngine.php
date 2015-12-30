<?php

namespace Travis;

class WealthEngine
{
	/**
     * Magic method for handling API methods.
     *
     * @param   string  $method
     * @param   array   $args
     * @return  array
     */
    public static function __callStatic($method, $args)
    {
    	// catch args
    	$args = isset($args[0]) ? $args[0] : [];

    	// set apikey
    	$apikey = ex($args, 'apikey');

    	// catch error...
    	if (!$apikey) trigger_error('API key required.');

    	// set type
    	$type = ex($args, 'is_full') ? 'full' : 'basic';

    	// set host
    	$host = ex($args, 'is_sandbox') ? 'api-sandbox.wealthengine.com' : 'api.wealthengine.com';

    	// cleanup
    	unset($args['apikey'], $args['is_full'], $args['is_sandbox']);

    	// set endpoint
		$endpoint = 'https://'.$host.'/v1/profile/find_one/'.$method.'/'.$type;

		// set headers
		$headers = [
        	'Content-Type: application/json',
		    'Authorization: APIKey '.$apikey,
	    ];

		// build payload
        $payload = json_encode($args);

        // setup curl request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        $response = curl_exec($ch);

        // catch error...
        if (curl_errno($ch))
        {
            // report
            #$errors = curl_error($ch);

            // fail
            $result = false;
        }

        // else if no error...
        else
        {
    		// set result
    		$result = json_decode($response);
        }

        // close
        curl_close($ch);

        // return
        return $result;
    }
}