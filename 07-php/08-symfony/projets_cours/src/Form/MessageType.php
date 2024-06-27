<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Message;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Content')
            // ->add('createdAt', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('editedAt', null, [
            //     'widget' => 'single_text',
            // ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                "multiple"=>false,
                "expanded"=>false
            ])
            ->add("imageFile", FileType::class,[
                "mapped"=>false,
                "required"=>false,
                "label"=>"Image pour accompagner votre post :",
                "constraints"=>[
                    new File([
                        "maxSize"=> "1024k",
                        "mimeTypes"=>["image/jpeg", "image/png", "image/gif"],
                        "mimeTypesMessage"=>"Seul les images jpg, png ou gif sont acceptés"
                    ])
                ]
            ])
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
