<?php

namespace CometCult\BraintreeBundle\Factory;

use CometCult\BraintreeBundle\Exception\InvalidServiceException;
use Braintree\Configuration as BraintreeConfiguration;

/**
 * Factory for creating Braintree services
 */
class BraintreeFactory
{
    /**
     * Constructor with Braintree configuration
     *
     * @param string $environment
     * @param string $merchantId
     * @param string $publicKey
     * @param string $privateKey
     */
    public function __construct($environment, $merchantId, $publicKey, $privateKey)
    {
        BraintreeConfiguration::environment($environment);
        BraintreeConfiguration::merchantId($merchantId);
        BraintreeConfiguration::publicKey($publicKey);
        BraintreeConfiguration::privateKey($privateKey);
    }

    /**
     * Factory method for creating and getting Braintree services
     *
     * @param string $serviceName braintree service name
     * @param array $attributes   attribures for braintree service creation
     *
     * @return mixed
     */
    public function get($serviceName, array $attributes = array())
    {
        $className = '\\Braintree\\' . ucfirst($serviceName);
        if(class_exists($className) && method_exists($className, 'factory')) {
            return $className::factory($attributes);
        } else {
            throw new InvalidServiceException('Invalid service ' . $serviceName);
        }
    }
}
