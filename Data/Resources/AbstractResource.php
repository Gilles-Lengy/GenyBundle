<?php

namespace Fuz\GenyBundle\Data\Resources;

abstract class AbstractResource implements ResourceInterface
{
    protected $loader;
    protected $resource;
    protected $format;

    protected $loaded       = null;
    protected $unserialized = null;
    protected $type         = null;
    protected $validator    = null;

    public function __construct($loader, $resource, $format)
    {
        $this->loader   = $loader;
        $this->resource = $resource;
        $this->format   = $format;
    }

    public function getLoader()
    {
        return $this->loader;
    }

    public function setLoader($loader)
    {
        $this->loader = $loader;
        return $this;
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function setResource($resource)
    {
        $this->resource = $resource;
        return $this;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    public function getLoaded()
    {
        return $this->loaded;
    }

    public function setLoaded($contents)
    {
        $this->loaded = $contents;

        return $this;
    }

    public function getUnserialized()
    {
        return $this->unserialized;
    }

    public function setUnserialized(array $array)
    {
        $this->unserialized = $array;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getValidator()
    {
        return $this->validator;
    }

    public function setValidator($validator)
    {
        $this->validator = $validator;
        return $this;
    }
}