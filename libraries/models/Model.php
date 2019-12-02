<?php

require_once('libraries/database.php');

class Model
{
    protected $pdo;

    public function __construct()
    {

        $this->pdo = getPdo();
    }
}
