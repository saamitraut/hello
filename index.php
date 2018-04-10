<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $method = $_SERVER['REQUEST_METHOD']; // Process only when method is POST 
     
    if($method == 'POST'){
        $requestBody = file_get_contents('php://input');
         
        $json = json_decode($requestBody);
         
        if(isset($json->result->parameters->number)){
            $number = $json->result->parameters->number;           
        }
        if(isset($json->result->parameters->text)){
            $text = $json->result->parameters->text;           
        }       
         
        if(isset($text)){
            switch ($text) {
                case 'hi':
                    $speech = "Hi, Nice to meet you";
                    break;
 
                case 'bye':
                    $speech = "Bye, good night";
                    break;
 
                case 'anything':
                    $speech = "Yes, you can type anything here.";
                    break;
                case 'API':
                    $speech = "In computer programming, an application programming interface (API) is a set of subroutine definitions, protocols, and tools for building application software.";
                    break;
                case 'api':
                    $speech = "In computer programming, an application programming interface (API) is a set of subroutine definitions, protocols, and tools for building application software.";
                    break;
                default:
                    $speech = "Sorry, I didnt get that. Please ask me something else.";
                    break;
            }   
        }elseif(isset($number)){
            if($number>=70) {
                    $speech = "Wow, you got the Distinction";
            }else if($number>=60){
                    $speech = "Good, you got the First Class";
            }else if($number>=50){
                    $speech = "Hmm, you got the Second Class";          
            }else if($number>=40){
                    $speech = "Hussh, you passed";          
            }else{
                    $speech = "Oops, you failed";
            }           
        }
         
        $response = new \stdClass();
        $response->speech = $speech;
        $response->displayText = $speech;
        $response->source = "webhook";
        echo json_encode($response);
    }else {
        echo "Method not allowed";
    }
?>
