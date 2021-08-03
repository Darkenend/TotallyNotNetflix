<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Movie;
use App\Entity\Rent;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idClient', EntityType::class, ['class' => Client::class])
            ->add('idMovie', EntityType::class, [
                'class' => Movie::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('m')
                        ->where('m.stock > :minstock')
                        ->setParameter('minstock', 0)
                        ->orderBy('m.titleDisplay', 'ASC');
                }
            , 'multiple' => true])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rent::class,
        ]);
    }
}
