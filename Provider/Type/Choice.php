<?php

namespace GenyBundle\Provider\Type;

class Choice extends AbstractType
{
    public function getName()
    {
        return 'choice';
    }

    public function getDescription()
    {
        return 'geny.field.choice.description';
    }
}

