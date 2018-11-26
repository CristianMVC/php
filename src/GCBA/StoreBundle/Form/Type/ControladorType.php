<?php

namespace GCBA\StoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;



class ControladorType extends AbstractType
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
'attr' => array('class' => 'tres'),
))


->add('borrado', 'choice',array( 'choices' => array('0' => 'No' ,'1'=> 'Sí')) )


->add('Guardar', 'submit',array('attr' => array('class'=>'submit')));


      
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GCBA\StoreBundle\Entity\SysControlador'
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
