<?php
    

namespace GCBA\StoreBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use GCBA\StoreBundle\Entity\SysAccion;

class LoadAccionData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
   /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $accion = new SysAccion();
 
                        
 $perfil=$this->getReference('admin-perfil');
$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Usuario');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('1');
$accion->setNombre('ListarUsuarios');
$accion->setNombreMenu('Usuarios');
$accion->setDescripcion('ListarUsuarios');
$accion->setOrden('1');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_usuario_homepage');
$manager->persist($accion); 
$perfil->addIdSysAccion($accion);  
$manager->persist($perfil);

 
$accion=new SysAccion();      


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('UsuarioGcba');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('1');
$accion->setNombre('ListarUsuariosGcba');
$accion->setNombreMenu('Usuarios Gcba');
$accion->setDescripcion('ListarUsuariosGcba');
$accion->setOrden('2');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_usuario_gcba_listar');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);

 

$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Perfil');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('1');
$accion->setNombre('ListarPerfiles');
$accion->setNombreMenu('Perfiles');
$accion->setDescripcion('ListarPerfiles');
$accion->setOrden('3');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_perfil_listar');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
 
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Perfil');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('1');
$accion->setNombre('AltaPerfil');
$accion->setNombreMenu('Alta Perfil');
$accion->setDescripcion('AltaPerfil');
$accion->setOrden('4');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_perfil_alta');
$manager->persist($accion); 
$perfil->addIdSysAccion($accion);  
$manager->persist($perfil);
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Modulo');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('1');
$accion->setNombre('ListarModulo');
$accion->setNombreMenu('Modulo');
$accion->setDescripcion('Modulo');
$accion->setOrden('5');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_modulo_listar');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Modulo');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('1');
$accion->setNombre('AltaModulo');
$accion->setNombreMenu('Alta Modulo');
$accion->setDescripcion('AltaModulo');
$accion->setOrden('6');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_modulo_alta');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);

$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Controlador');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('1');
$accion->setNombre('ListarControlador');
$accion->setNombreMenu('Controladores');
$accion->setDescripcion('ListarControlador');
$accion->setOrden('7');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_controlador_listar');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Controlador');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('1');
$accion->setNombre('AltaControlador');
$accion->setNombreMenu('Alta Controlador');
$accion->setDescripcion('AltaControlador');
$accion->setOrden('8');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_controlador_alta');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Accion');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('1');
$accion->setNombre('ListarAccion');
$accion->setNombreMenu('Acción');
$accion->setDescripcion('ListarAccion');
$accion->setOrden('9');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_accion_listar');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Accion');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('1');
$accion->setNombre('AltaAccion');
$accion->setNombreMenu('Alta Acción');
$accion->setDescripcion('AltaAccion');
$accion->setOrden('10');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_accion_alta');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Perfil');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('1');
$accion->setNombre('PerfilAccion');
$accion->setNombreMenu('Perfil Acción');
$accion->setDescripcion('PerfilAccion');
$accion->setOrden('11');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_perfil_asignar_accion');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Usuario');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('1');
$accion->setNombre('AltaUsuario');
$accion->setNombreMenu('Alta Usuario');
$accion->setDescripcion('AltaUsuario');
$accion->setOrden('12');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_alta_usuario');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Accion');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('0');
$accion->setNombre('EditarAccion');
$accion->setNombreMenu('EditarAccion');
$accion->setDescripcion('EditarAccion');
$accion->setOrden('17');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_accion_editar');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Controlador');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('0');
$accion->setNombre('EditarControlador');
$accion->setNombreMenu('EditarControlador');
$accion->setDescripcion('EditarControlador');
$accion->setOrden('18');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_controlador_editar');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
$accion=new SysAccion();

 
$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Modulo');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('0');
$accion->setNombre('EditarModulo');
$accion->setNombreMenu('EditarModulo');
$accion->setDescripcion('EditarModulo');
$accion->setOrden('19');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_modulo_editar');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Accion');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('0');
$accion->setNombre('delaccion');
$accion->setNombreMenu('delaccion');
$accion->setDescripcion('delaccion');
$accion->setOrden('20');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_usuario_delaccion');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Accion');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('0');
$accion->setNombre('addaccion');
$accion->setNombreMenu('addaccion');
$accion->setDescripcion('addaccion');
$accion->setOrden('21');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_perfil_addaccion');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Usuario');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('0');
$accion->setNombre('EditarUsuario');
$accion->setNombreMenu('EditarUsuario');
$accion->setDescripcion('EditarUsuario');
$accion->setOrden('22');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_usuario_editar');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Usuario');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('0');
$accion->setNombre('addperfil');
$accion->setNombreMenu('addperfil');
$accion->setDescripcion('addperfil');
$accion->setOrden('23');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_usuario_addperfil');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Usuario');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('0');
$accion->setNombre('delperfil');
$accion->setNombreMenu('delperfil');
$accion->setDescripcion('delperfil');
$accion->setOrden('24');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_usuario_delperfil');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Usuario');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('0');
$accion->setNombre('CambiarPassword');
$accion->setNombreMenu('Cambiar Password');
$accion->setDescripcion('CambiarPassword');
$accion->setOrden('25');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_usuario_cambiarpassword');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       


$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Log');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('1');
$accion->setNombre('ListarLog');
$accion->setNombreMenu('Ver Log');
$accion->setDescripcion('ListarLog');
$accion->setOrden('50');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_log_gcba_listar');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);

/**
* put your comment there...
* 
* @var mixed
*/

/**
* put your comment there...
* 
* @var mixed
*/


$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Usuario');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('0');
$accion->setNombre('login');
$accion->setNombreMenu('login');
$accion->setDescripcion('login');
$accion->setOrden('58');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('login');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);
$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Modulo');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('0');
$accion->setNombre('logout');
$accion->setNombreMenu('logout');
$accion->setDescripcion('logout');
$accion->setOrden('57');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('logout');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);





$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Usuario');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('1');
$accion->setNombre('listarBloqueo');
$accion->setNombreMenu('Listar Bloqueos');
$accion->setDescripcion('listarBloqueo');
$accion->setOrden('26');
$accion->setBorrado('0');
$accion->setLogear('1');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_bloqueos');
$manager->persist($accion); $perfil->addIdSysAccion($accion);  $manager->persist($perfil);

$accion=new SysAccion();


$modulo=$this->getReference('ABM Usuarios-modulo');       
$accion->setIdSysModulo($modulo);


$controlador=$this->getReference('Accion');       
$accion->setIdSysControlador($controlador);
$accion->setEsMenu('1');
$accion->setNombre('SyncMenu');
$accion->setNombreMenu('Sync Menu');
$accion->setDescripcion('SyncMenu');
$accion->setOrden('67');
$accion->setBorrado('0');
$accion->setLogear('0');
$accion->setValidarPhpsessid('0');
$accion->setEsMenuDestacado('0');
$accion->setNombreRoute('gcba_syncMenu');
$manager->persist($accion); 
$perfil->addIdSysAccion($accion);  
$manager->persist($perfil);
   $manager->flush();
                                
     
       

     
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 5; // the order in which fixtures will be loaded
    }
}