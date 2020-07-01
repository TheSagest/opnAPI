<?php

namespace App\Form;

use App\Entity\ClientApiUrl;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientUrlApiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
	    $builder
		->add('URLName', TextType::class,[
		    'label'  => 'List Name.',
		])
		->add('IpAddressList',TextareaType::class,[
		    'label'  => 'IP List.',
            'required' => false
		])
		->add('Notes',TextareaType::class, [
            'required' => false
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ClientApiUrl::class,
        ]);
    }
}
