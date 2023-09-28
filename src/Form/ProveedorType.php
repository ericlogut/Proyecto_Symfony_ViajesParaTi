<?php

namespace App\Form;

use App\Entity\Proveedor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;  


class ProveedorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        // Nombre
        ->add('nombre', TextType::class, [
            
            // Validaciones
            'required' => true,
            'constraints' => [
                new Length([
                    'min' => 2,
                    'max' => 255,
                    'minMessage' => 'El nombre debe tener al menos {{ limit }} carácteres.',
                    'maxMessage' => 'El nombre no debe tener más de {{ limit }} carácteres.',
                ]),
                new Regex([
                    'pattern' => '/^[a-zA-Z\s]+$/',
                    'message' => 'El nombre solo puede contener letras y espacios.',
                ]),
            ],
        ])

        // Correo electrónico
        ->add('email', EmailType::class, [
                        
            // Validaciones
            'required' => true,
            'constraints' => [
                new Email([
                    'message' => 'El correo electrónico "{{ value }}" no es válido.',
                ]),
            ],
        ])

        // Telefono
        ->add('telefono', NumberType::class, [
                        
            // Validaciones
            'constraints' => [
                new Regex([
                    'pattern' => '/^\d{9}$/',
                    'message' => 'Por favor, ingresa un número de teléfono válido de 9 dígitos.',
                ]),
            ],
            'invalid_message' => 'Por favor, ingresa un número válido.',
        ])
        
        // Tipo de proveedor
        ->add('tipoProveedor', ChoiceType::class, [
            'choices'  => [
                'Hotel' => 'Hotel',
                'Pista' => 'Pista',
                'Complementario' => 'Complementario',
            ]
        ])

        // Activo
        ->add('activo', CheckboxType::class, [
            'label' => 'Activo',
            'required' => false,
        ])

        ->add('submit', SubmitType::class, [
            'label' => 'Guardar',
        ]);
    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Identifico de que entidad voy a mapear los datos
            'data_class' => Proveedor::class,

            // Identifico si estoy usando el formulario para editar o crear
            'is_edit' => false,
        ]);
    }
}
