<?php

class credentials
{
    private $container;

    public function __construct(container $container)
    {
        $this->container = $container;    
    }

    public function getDBCredentials()
    {
        $data = $this->readFileData("../private_html/access.json");
        $this->dbCredentials = array("servername" => $data->servername,"username" => $data->dbUsername, "password" => $data->dbPassword, "dbname" => $data->dbName);
        return $this->dbCredentials;
    }

    public function getMailCredentials()
    {
        $data = $this->readFileData("../private_html/access.json");
        $this->mailCredentials = array("oauthUserEmail" => $data->oauthUserEmail,"oauthClientId" => $data->oauthClientId,"oauthClientSecret" => $data->oauthClientSecret,"oauthRefreshToken" => $data->oauthRefreshToken, "emailReceivers" => $data->emailReceivers, "technicalEmailReceivers" => $data->technicalEmailReceivers);
        return $this->mailCredentials;
    }

    private function readFileData($fileToRead)
    {
        // $fileToRead is the absolute path to the file
        try
        {
            $file = fopen($fileToRead, "r");
            $rawData = fread($file,filesize($fileToRead));
            fclose($file);
    
            $data = json_decode($rawData);
            return $data;
        } 
        catch (Exception $e)
        {
            throw new Exception("Error Gathering Credentials: ".$e->getMessage(), 1);
            return false;
        }

    }
}

?>