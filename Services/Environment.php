<?php

namespace Fuz\GenyBundle\Services;

use Fuz\GenyBundle\Data\Resource;

class Environment
{
    protected $extension;
    protected $loader;
    protected $unserializer;
    protected $normalizer;
    protected $builder;
    protected $initializer;
    protected $validator;

    public function __construct(
                                Extension    $extension,
                                Loader       $loader,
                                Unserializer $unserializer,
                                Normalizer   $normalizer,
                                Builder      $builder,
                                Validator    $validator,
                                Initializer  $initializer)
    {
        $this->extension    = $extension;
        $this->loader       = $loader;
        $this->unserializer = $unserializer;
        $this->normalizer   = $normalizer;
        $this->builder      = $builder;
        $this->initializer  = $initializer;
        $this->validator    = $validator;
    }

    public function getType(Resource $resource, $data = null)
    {
        if ($resource->getType()) {
            return $resource->getType();
        }

        $converted = $this->convertResource($resource);

        // Loading



    }

    public function getValidator(Resource $resource)
    {

    }

    protected function convertResource(Resource $resource)
    {
        $data = $resource->getData();
        if (is_null($data)) {
            $this->loader->load($resource);
            $this->unserializer->unserialize($resource);

            // todo (create normalizer according to resource type)

            $data = $this->normalizer->normalize($array);
            $resource->setData($data);
        }

        return $data;
    }

    protected function getConfig(array $options)
    {
        $config = $this->container->getParameter('geny');

        return array_merge(array(
            'loader' => $config['default_loader'],
            'format' => $config['default_format'],
           ), $options);
    }

    /*
    protected $normalizer;
    protected $builder;
    protected $validator;
    protected $initializer;

    public function __construct(
                                Normalizer $normalizer,
                                Builder $builder,
                                Validator $validator,
                                Initializer $initializer)
    {
        $this->normalizer   = $normalizer;
        $this->builder      = $builder;
        $this->validator    = $validator;
        $this->initializer  = $initializer;
    }

    public function getType()
    {

    }

    public function load($resource, array $options = array())
    {
        $config = $this->getConfig($options);

        // 1- Content Loader (fs, db, ...)
        $contents = $this->loader->load($config['loader_type'], $resource);

        // 2- Unserializer (json, xml, ...)
        $data = $this->unserializer->unserialize($config['unserializer_type'], $contents);


        // Normalizer
        // TypeNormalizer
        // OptionNormalizer
        // ValidatorNormalizer


        // 3- Geny Normalizer
        $form = $this->normalizer->normalizeForm($resource, $data);

        // 4- Symfony FormType Builder
        $type = $this->builder->build($form);

        // 5- Data Initializer
        $this->initializer->initialize($type, $form);

        return $type;
    }


    */
}
