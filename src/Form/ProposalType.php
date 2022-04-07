<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProposalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,  [
                'label' => 'Nazwa'
            ])
            ->add('activity', TextType::class,  [
                'label' => 'Aktywnosc'
            ])
            ->add('datetime', DateType::class,  [
                'label' => 'Data',
                'widget' => 'single_text',
            ])
            ->add('cover', FileType::class,  [
                'label' => 'Okladka',
                'mapped' => false,
                'required' => false,
            ])
            ->add('description', TextType::class,  [
                'label' => 'Opis'
            ])
            ->add('value', NumberType::class, [
                'label' => 'Wartosc'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Zapisz',
            ])
        ;
    }
}