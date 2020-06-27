<?php

include 'apiRequest.php';


class BreachModel{
    // Defines attributes of a Breach
    // Details are from https://haveibeenpwned.com/API/v3#BreachesForAccount

    private $Name;
    private $Title;
    private $Domain;
    private $AddedDate;
    private $ModifiedDate;
    private $PwnCount;
    private $Description;
    private $DataClasses;
    private $IsVerified;
    private $IsFabricated;
    private $IsSensitive;
    private $IsRetired;
    private $IsSpamList;
    private $LogoPath;

    public function __construct($name)
    {
        $newRequest = new apiRequest('domain',$name);
        // Decode the JSON response
        $breach_detail =  json_decode($newRequest->getResult(), true);

        //populate the data

        $this->Name = $breach_detail['Name'];
        $this->Title = $breach_detail['Title'];
        $this->Domain = $breach_detail['Domain'];
        $this->AddedDate = $breach_detail['AddedDate'];
        $this->ModifiedDate = $breach_detail['ModifiedDate'];
        $this->PwnCount = $breach_detail['PwnCount'];
        $this->Description = $breach_detail['Description'];
        $this->DataClasses = $breach_detail['DataClasses'];
        $this->IsVerified = $breach_detail['IsVerified'];
        $this->IsFabricated = $breach_detail['IsFabricated'];
        $this->IsSensitive = $breach_detail['IsSensitive'];
        $this->IsRetired = $breach_detail['IsRetired'];
        $this->IsSpamList = $breach_detail['IsSpamList'];
        $this->LogoPath = $breach_detail['LogoPath'];

    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->Domain;
    }

    /**
     * @return mixed
     */
    public function getBreachDate()
    {
        return $this->BreachDate;
    }

    /**
     * @return mixed
     */
    public function getAddedDate()
    {
        return $this->AddedDate;
    }

    /**
     * @return mixed
     */
    public function getModifiedDate()
    {
        return $this->ModifiedDate;
    }

    /**
     * @return mixed
     */
    public function getPwnCount()
    {
        return $this->PwnCount;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @return mixed
     */
    public function getDataClasses()
    {
        return $this->DataClasses;
    }

    /**
     * @return mixed
     */
    public function getIsVerified()
    {
        return $this->IsVerified;
    }

    /**
     * @return mixed
     */
    public function getIsFabricated()
    {
        return $this->IsFabricated;
    }

    /**
     * @return mixed
     */
    public function getIsSensitive()
    {
        return $this->IsSensitive;
    }

    /**
     * @return mixed
     */
    public function getIsRetired()
    {
        return $this->IsRetired;
    }

    /**
     * @return mixed
     */
    public function getIsSpamList()
    {
        return $this->IsSpamList;
    }

    /**
     * @return mixed
     */
    public function getLogoPath()
    {
        return $this->LogoPath;
    }
    private $BreachDate;



}