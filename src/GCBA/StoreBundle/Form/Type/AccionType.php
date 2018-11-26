<?php

namespace GCBA\StoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;



class AccionType extends AbstractType
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
      
                    ->add('idSysModulo', 'entity',array(
                        'class' => 'GCBAStoreBundle:SysModulo',
                        'property' => 'nombre',
                    ))
                 //   ->add('captcha','captcha')
                           ->add('idSysControlador', 'entity',array(
                        'class' => 'GCBAStoreBundle:SysControlador',
                        'property' => 'nombre'
                    ))      
                    ->add('nombreRoute', 'text', array(
                    'attr' => array('class' => 'tres'),'required'=> false
                    ))
           
                    ->add('es_menu', 
                    'checkbox', array(
               
                    'required'  => false) )

                    ->add('nombre', 'text', array( 'required'=> false,
                    'attr' => array('class' => 'tres'),
                    ))

                    ->add('nombreMenu', 'text', array('required'=> false,
                    'attr' => array('class' => 'tres')
                    ))
                    ->add('descripcion', 'text', array( 'required'=> false,
                    'attr' => array('class' => 'tres'),
                    ))
                    ->add('orden', 'text', array( 'required'=> false,
                    'attr' => array('class' => 'tres'),
                    ))
                ->add('borrado', 'checkbox', array( 'required'  => false) )
                ->add('logear', 'checkbox', array( 'required'  => false) )
                ->add('validar_phpsessid', 'checkbox', array( 'required'  => false) )
                ->add('es_menu_destacado', 'checkbox', array( 'required'  => false) )

            ->add('Guardar', 'submit',array('attr' => array('class' => 'submit')));
           
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GCBA\StoreBundle\Entity\SysAccion'
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
