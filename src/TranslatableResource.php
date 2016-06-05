<?php

namespace RemiSan\Intl;

class TranslatableResource
{
    /** @var string */
    private $key;

    /** @var string[] */
    private $parameters;

    /**
     * Constructor.
     *
     * @param string   $key
     * @param string[] $parameters
     */
    public function __construct($key, array $parameters = [])
    {
        $this->key = $key;
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}
