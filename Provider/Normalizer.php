<?php

namespace Fuz\GenyBundle\Provider;

use Fuz\GenyBundle\Base\BaseService;
use Fuz\GenyBundle\Exception\NormalizerException;
use Fuz\GenyBundle\Data\Resources\ResourceInterface;
use Fuz\GenyBundle\Provider\Normalizer\NormalizerInterface;

class Normalizer extends BaseService
{
    protected $normalizers = array();

    public function normalize(ResourceInterface $resource)
    {
        if (!is_null($resource->getNormalized())) {
            return $resource->getNormalized();
        }

        $class = get_class($resource);

        foreach ($this->normalizers as $normalizer) {
            if ($normalizer->supports($class)) {
                $contents = $normalizer->normalize($resource);
                $resource->setLoaded($contents);

                return $contents;
            }
        }

        throw new NormalizerException("No normalizer found for class '{$class}'.");
    }

    public function hasNormalizer($name)
    {
        return isset($this->normalizers[$name]);
    }

    public function getNormalizer($name)
    {
        if (!isset($this->normalizers[$name])) {
            throw new NormalizerException("Normalizer '{$name}' not found.");
        }

        return $this->normalizers[$name];
    }

    public function addNormalizer(NormalizerInterface $normalizer)
    {
        $this->normalizers[$normalizer->getName()] = $normalizer;
    }

    public function removeNormalizer($name)
    {
        unset($this->normalizers[$name]);
    }

    public function setNormalizers(array $normalizers)
    {
        foreach ($normalizers as $normalizer) {
            $this->addNormalizer($normalizer);
        }
    }

    public function getNormalizers()
    {
        return $this->normalizers;
    }
}