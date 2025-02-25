<?php

namespace App\Services;

class FirebaseService
{
    private $config;

    public function __construct()
    {
        $this->config = config('firebase.credentials');
    }

    public function getConfig()
    {
        return $this->config;
    }
}
