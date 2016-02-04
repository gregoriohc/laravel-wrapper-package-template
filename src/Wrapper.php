<?php

namespace Vendor\Package;

use Illuminate\Config\Repository;

class Wrapper
{
    /**
     * The config instance
     *
     * @var Repository
     */
    public $config;

    /**
     * The wrapped client instance
     *
     * @var \stdClass
     */
    public $client;

    /**
     * Client constructor
     *
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        // Fetch the config data and set up the required url´s
        $this->config = $config;

        // Retrieve the configuration variables
        $apiKey = $this->config->get('packagename::api_key');
        $apiSecret = $this->config->get('packagename::api_secret');

        // Make the client instance
        //$this->client = new WrappedClient($apiKey, $apiSecret);
    }

    /**
     * Handle dynamic calls to the client
     *
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->client, $name], $arguments);
    }
}