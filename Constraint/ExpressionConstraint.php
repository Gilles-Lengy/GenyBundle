<?php

namespace GenyBundle\Constraint;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class ExpressionConstraint implements ConstraintInterface
{
    public function getDefault(Field $entity)
    {
        return [
            'expression' => null,
        ];
    }

    public function normalize(Field $entity)
    {
        $normalized = [];
        $constraints = $entity->getConstraints();

        if (array_key_exists('expression', $constraints) && $constraints['expression']) {
            $normalized[] = new Assert\Expression($constraints['expression']);
        }

        return $normalized;
    }

    public function getBuilder(FormBuilderInterface $builder, Field $entity, $data = null)
    {
        $builder
           ->add('expression', Type\TextareaType::class, [
               'label'       => 'geny.builders.constraint.expression',
               'constraints' => [
                   new Assert\Callback([
                       'callback' => function ($data, ExecutionContextInterface $context) {
                            if (is_null($data) || '' === $data) {
                                return ;
                            }
                            $eval = new ExpressionLanguage();
                            try {
                                $eval->evaluate($data, [
                                    'value' => 42,
                                ]);
                            } catch (\Exception $ex) {
                                $class = get_class($ex);
                                $context->buildViolation(sprintf("[%s] %s", substr($class, strrpos($class, '\\') + 1), $ex->getMessage()))
                                    ->atPath('expression')
                                    ->addViolation();
                            }
                       },
                   ]),
               ],
               'required'    => false,
               'attr' => [
                   'help_text' => 'geny.builders.constraint.expression.help',
               ],
        ]);

        return $this;
    }
}
