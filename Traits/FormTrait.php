<?php

namespace GenyBundle\Traits;

use Symfony\Component\Form\Extension\Core\Type;

trait FormTrait
{
    protected function getBuilder($name, $type, array $options = [], $data = null)
    {
        return $this->get('form.factory')->createNamedBuilder($name, $type, $data, $options);
    }

}