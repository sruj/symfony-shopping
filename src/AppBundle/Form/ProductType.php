<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Nazwa',
            ])
            ->add('description', TextareaType::class, [
                'required' => true,
                'label' => 'Opis',
            ])
            ->add('price', MoneyType::class, [
                'required' => true,
                'label' => 'Cena',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Dodaj',
            ])
        ;
    }
}