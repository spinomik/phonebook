<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('searchType', ChoiceType::class, [
                'choices'  => [
                    'ID' => 'id',
                    'Imię' => 'name',
                    'Nazwisko' => 'last_name',
                    'Numer telefonu'=> 'phone_number',
                    'Lokalizacja' => 'locality',
                    'Kod Pocztowy' => 'zip_code',
                    'Nazwa ulicy' => 'street',
                    'Numer budynku' =>'number_of_the_bulding',
                    'Numer mieszkania'=>'number_apartment'
                ],
            ])
            ->add('searchData');

    }
}