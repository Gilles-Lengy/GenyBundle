<?php

namespace GenyBundle\Constraint;

use GenyBundle\Entity\Field;
use Symfony\Component\Form\FormBuilderInterface;

interface ConstraintInterface
{
    public function getDefaults(Field $entity);
    public function normalize(Field $entity);
    public function build(FormBuilderInterface $builder, Field $entity, $data = null);
}
