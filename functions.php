<?php

function get_block($block) {
    global $node;
    $data = array(
        'jsonrpc' => '2.0',
        'method' => 'condenser_api.get_block',
        'params' => array($block),
        'id' => 1
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $node);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, TRUE);
}

function decode_ops($data) {
    $return = [];
    if(!empty($data['result']['transactions'])) {
	    $var1 = $data['result']['transactions'];
	    for($i=0; $i<=count($var1)-1; $i++) {
        	$var2 = $var1[$i]['operations'];
        	for($j=0; $j<=count($var2)-1; $j++) {
        		array_push($return, $var2[$j]);
        	}
    	    }
    }
    return $return;
}

function last_known_block() {
    global $node;
    $retryCount = 0;
    
    while ($retryCount < 3) {
        $data = array(
            'jsonrpc' => '2.0',
            'method' => 'condenser_api.get_dynamic_global_properties',
            'params' => array(),
            'id' => 1
        );
    
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array('Content-Type: application/json')
        );
    
        $ch = curl_init($node);
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
    
        $response = json_decode($result, true);
        
        if (isset($response['result']['head_block_number'])) {
            return $response['result']['head_block_number'];
        } else {
            $retryCount++;
        }
    }
    
    return null;
}


?>