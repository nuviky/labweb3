<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Эл. почта',
                'constraints' => [
                    new Email([
                        'message' => 'почта не прошла валидацию',
                    ])
                ]
            ])
            ->add('username', TextType::class,[
                'label' => 'Имя пользователя'
            ])
            ->add('password', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'required' => true,
                'first_options' => ['label' => 'Пароль'],
                'second_options' => ['label' => 'Повторите пароль'],
                'invalid_message' => 'Пароли не совпадают',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Введите пароль',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Неправильный пароль, минимальная длина {{ limit }} символов',
                        'max' => 4096,
                    ])
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Согласие на обработку персональных данных',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Вы не соглашены на обработку персональных данных.',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Зарегистрироваться'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
