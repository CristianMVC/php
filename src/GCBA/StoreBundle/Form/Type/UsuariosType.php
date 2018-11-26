<?php

namespace GCBA\StoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;



class UsuariosType extends AbstractType
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
           

$builder->add('nombre', 'text', array(
    'attr' => array('class' => 'tres'),'required' => false
))
->add('apellido', 'text', array(
    'attr' => array('class' => 'tres'),'required' => false
))
            ->add('usuario', 'text', array(
    'attr' => array('class' => 'tres'),'required' => false
))
            
            ->add('correo', 'text', array(
    'attr' => array('class' => 'cuatro'),'required' => false
))

             ->add('activo', 'choice',array( 'choices' => array('1' => 'Sí' ,'0'=> 'No')) )

            ->add('password', 'password',array(
    'attr' => array('class' => 'tres'),'required' => false
))
            ->add('Guardar', 'submit',array('attr' => array('class' => 'submit')))



        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GCBA\StoreBundle\Entity\SysUsuario'
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
