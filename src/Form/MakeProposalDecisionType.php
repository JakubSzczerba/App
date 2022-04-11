<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class MakeProposalDecisionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('decision', ChoiceType::class, [
                'choices' => [
                    'Zaakceptowany' => 'Zaakceptowany',
                    'Odrzucony' => 'Odrzucony',
                    'Wymagana zmiana' => 'Wymagana zmiana'
                ],
                'label' => 'Decyzja'
            ])
            ->add('information', TextType::class,  [
                'label' => 'Informacja dla pracownika'
            ])
        ;
    }

}