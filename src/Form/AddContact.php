<?php


namespace App\Form;



use App\Entity\Contact;
use App\Entity\Locality;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\LocaleType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddContact extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('Name')
           ->add('last_name')
           ->add('phone_number',TelType::class)
           ->add('locality', EntityType::class,[
               'class' => Locality::class,'choice_label' => function(Locality $locality){
               return sprintf($locality->getName());
                   },'placeholder'=>'Wybierz miejscowość'])
           ->add('zip_code')
           ->add('street')
           ->add('number_of_the_bulding',NumberType::class)
           ->add('number_apartment', NumberType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class
        ]);
    }


}