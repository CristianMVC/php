<?php

namespace GCBA\StoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;



class PerfilType extends AbstractType
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
           

$builder->add('nombre', 'text',array('required'=> false))
            ->add('descripcion', 'text',array('required' => false))
            ->add('borrado', 'choice',array(
    'choices'   => array('false' => 'No','true' => 'Sí' ),
    'required'  => true,
))
            ->add('Guardar', 'submit',array('attr' => array('class'=>'submit')));
           
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GCBA\StoreBundle\Entity\SysPerfil'
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
