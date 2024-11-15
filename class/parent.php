<?php

require_once("data.php");

class parentClass
{
    protected $mysqli;

    public function __construct()
    {
        $this->mysqli = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
    }
}
