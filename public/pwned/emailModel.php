<?php

include 'apiRequest.php';

class EmailModel{
    // Defines attributes of an Email Address
    // Details are from https://haveibeenpwned.com/API/v3
    // Returns an array of Strings, representing Domains Pwned by email address

    private $domains ;

    public function __construct($name)
    {
        $newRequest = new apiRequest('email', $name);
        // Decode the JSON response

        $this->domains = json_decode($newRequest->getResult(), true);
    }

    /**
     * @return mixed
     */
    public function getDomains()
    {
        // Return Array of Site Names Pwned
        return $this->domains;
    }
}