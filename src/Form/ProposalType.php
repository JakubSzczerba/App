<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Przeniesienie środków z kafeterii' => 'Przeniesienie środków z kafeterii',
                    'Dodatkowe zasilenie kafeterii' => 'Dodatkowe zasilenie kafeterii',
                    'Potrącenie z wynagrodzenia' => 'Potrącenie z wynagrodzenia',
                    'Dodatek do wynagrodzenia' => 'Dodatek do wynagrodzenia',
                    'Obieg dokumentów (akceptacja)' => 'Obieg dokumentów (akceptacja)',
                    'Inne (dowolne)' => 'Inne (dowolne)'
                ],
                'label' => 'Rodzaj'
            ])
            ->add('activity', ChoiceType::class, [
                'choices' => [
                    'Aktywny' => true,
                    'Nieaktywny' => false
                ],
                'label' => 'Status'
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
        ;
    }
}