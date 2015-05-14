<?php
	// Request Post Variable
	$name = $_REQUEST['Name'];

    // Validation
    if($name != 'CNN') {
    echo json_error($_REQUEST['Name']);
    } else {
    echo json_success($_REQUEST['Name']);
    };

    // Return Success Function
    function json_success($msg) {
	
		$string = file_get_contents($msg.".json");
		$json_a = json_decode($string, true);
		
        return json_encode($json_a);
    }

    // Return Error Function
    function json_error($msg) {
        $return = array();
        $return['error'] = TRUE;
        $return['msg'] = $msg;
        return json_encode($return);
    }
 
?>