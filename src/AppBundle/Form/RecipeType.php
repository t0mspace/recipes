<?php

namespace AppBundle\Form;


use AppBundle\Entity\KindDish;
use AppBundle\Entity\Picture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Entity\File;


class RecipeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', Type\TextType::class)
                ->add('difficultyLevel', Type\IntegerType::class)
                ->add('peparationTime', Type\TextType::class)
                ->add('cookingTime', Type\TextType::class)
                ->add('cost', Type\MoneyType::class)
                ->add('forNbrePeople', Type\IntegerType::class)
                ->add('howMake', Type\TextareaType::class)
                ->add('picture', PictureType::class)
                ->add('kind_dish', EntityType::class,[
                    'class' => KindDish::class
                    ])
                ->add('save',      Type\SubmitType::class);
//
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Recipe'
        ));
    }


    public function getBlockPrefix()
    {
        return 'appbundle_recipe';
    }


}
