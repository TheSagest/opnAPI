<?php

class apiRequest {
    // Handles the API request and returns JSON response
    private $result;
    private $resultCode;

    public function __construct($type, $name)
    {
        // Change this to HIBP API
        $api = "0eef96ce909a466881b38da3f312f100";

        $ch = curl_init();

        // set url
        // type dependant
        // Search Individual account -> EMAIL
        // Search Breach Domain -> domain
        switch($type){
            case "email":
                $URL = "breachedaccount/"  . urlencode($name)  ;
                break;

            case "domain":
                $URL = "breach/"  . $name  ;
                break;
        }

        curl_setopt($ch, CURLOPT_URL, "https://haveibeenpwned.com/api/v3/" . $URL );
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "hibp-api-key:" . $api  ,
            "user-agent:SageLink "
        ));

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $this->setResult(curl_exec($ch));
        $this->setResultCode( curl_getinfo($ch, CURLINFO_HTTP_CODE));

        // close curl resource to free up system resources
        curl_close($ch);

    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }
    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }
    /**
     * @return mixed
     */
    public function getResultCode()
    {
        return $this->resultCode;
    }
    /**
     * @param mixed $resultCode
     */
    public function setResultCode($resultCode)
    {
        $this->resultCode = $resultCode;
    }
}

