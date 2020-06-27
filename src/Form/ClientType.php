<?php

namespace App\Form;

use App\Entity\Client;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
		->add('clientName', TextType::class)
            ->add('ipAddress', TextType::class, [
                'required' => false
            ])
            ->add('scanForUp')
            ->add( 'localNetworkAliasName', TextType::class,[
                'empty_data'  => "network_AllowAll_INT",
                    'required' => false
                ])
            ->add('port', IntegerType::class, [
                'required' => false
            ])
            ->add('https')
            ->add('localIP', TextType::class)
            ->add('apiKey' , TextType::class, [
                'required' => false
            ])
            ->add('apiSecret', TextType::class, [
                'required' => false
            ])
		->add('notes', TextareaType::class, [
		        'required' => false
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
