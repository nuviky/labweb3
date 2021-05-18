<?php

namespace App\Form;

use App\Entity\Feedback;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class FeedbackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Text', TextType::class, [
                'label' => 'Текст комментария']
            )
            ->add('Rating', ChoiceType::class, array(
                'label' => 'Оценка товара',
                'choices'  => array(
                    '0' => 0,
                    '0,5' => 0.5,
                    '1' => 1,
                    '1,5' => 1.5,
                    '2' => 2,
                    '2,5' => 2.5,
                    '3' => 3,
                    '3,5' => 3.5,
                    '4' => 4,
                    '4,5' => 4.5,
                    '5' => 5
                    )
                )
                )
            ->add('submit', SubmitType::class, [
                    'label' => 'Оставить коментарий'
                ]);
        $builder->setMethod('GET');
                
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Feedback::class,
        ]);
    }
}
