<?php

namespace GCBA\StoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;



class PasswordType extends AbstractType
{
       
    public function __construct($request,$em,$tipo="",$datos=array()) 
    {
     
      $this->request=$request;
      $this->em=$em;
      $this->tipo=$tipo;
      $this->datos=$datos;
   
    }
    
    /**
     * 
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
           
       
$builder

                                    ->add('claveant', 'password',array(
                            'attr' => array('class' => 'tres'),'mapped' => false
                        ))
                                    ->add('clavenueva', 'password',array(
                            'attr' => array('class' => 'tres'), 'mapped' => false
                        ))
                                    ->add('clavenueva2', 'password',array(
                            'attr' => array('class' => 'tres'), 'mapped' => false
                        ))
                                    ->add('usuario', 'hidden',array(
                            'attr' => array('class' => 'tres'), 'mapped' => false,'data'=> $this->datos["usuario"]
                        ))
                                    ->add('Guardar', 'submit',array('attr'=> array('class' => 'submit')))



        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => null
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'form';
    }
}
