<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * appProdUrlGenerator
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes = array(
        'gcba_homepage' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\DefaultController::indexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/',    ),  ),  4 =>   array (  ),),
        'gcba_alta_usuario' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\UsuarioController::AltaUsuarioAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/alta_usuario/',    ),  ),  4 =>   array (  ),),
        'gcba_usuario_homepage' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\UsuarioController::listarUsuariosAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Usuario/',    ),  ),  4 =>   array (  ),),
        'gcba_usuario_addperfil' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\UsuarioController::addperfilAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Usuario/addPerfil/',    ),  ),  4 =>   array (  ),),
        'gcba_usuario_delperfil' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\UsuarioController::delperfilAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Usuario/delPerfil/',    ),  ),  4 =>   array (  ),),
        'gcba_usuario_gcba_listar' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\UsuarioGcbaController::listarUsuariosGcbaAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Usuario/Gcba/',    ),  ),  4 =>   array (  ),),
        'gcba_log_gcba_listar' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\LogController::listarLogAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Log',    ),  ),  4 =>   array (  ),),
        'gcba_usuario_editar' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\UsuarioController::editarUsuarioAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/Usuario/Editar',    ),  ),  4 =>   array (  ),),
        'gcba_perfil_alta' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\PerfilController::altaPerfilAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Usuario/Perfil/Alta/',    ),  ),  4 =>   array (  ),),
        'gcba_perfil_listar' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\PerfilController::listarPerfilesAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Usuario/Perfil/',    ),  ),  4 =>   array (  ),),
        'gcba_modulo_editar' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\ModuloController::editarModuloAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/Modulo/Editar',    ),  ),  4 =>   array (  ),),
        'gcba_modulo_alta' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\ModuloController::altaModuloAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Modulo/Alta/',    ),  ),  4 =>   array (  ),),
        'gcba_modulo_listar' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\ModuloController::listarModuloAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Modulo/',    ),  ),  4 =>   array (  ),),
        'gcba_accion_editar' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\AccionController::editarAccionAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/Accion/Editar',    ),  ),  4 =>   array (  ),),
        'gcba_accion_alta' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\AccionController::altaAccionAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Accion/Alta/',    ),  ),  4 =>   array (  ),),
        'gcba_accion_listar' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\AccionController::listarAccionAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Accion/',    ),  ),  4 =>   array (  ),),
        'gcba_controlador_editar' => array (  0 =>   array (    0 => 'id',  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\ControladorController::editarControladorAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'id',    ),    1 =>     array (      0 => 'text',      1 => '/Controlador/Editar',    ),  ),  4 =>   array (  ),),
        'gcba_controlador_alta' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\ControladorController::altaControladorAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Controlador/Alta/',    ),  ),  4 =>   array (  ),),
        'gcba_controlador_listar' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\ControladorController::listarControladorAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Controlador/',    ),  ),  4 =>   array (  ),),
        'gcba_usuario_verinfo' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\UsuarioController::verinfousuarioAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Usuario/Verinfo/',    ),  ),  4 =>   array (  ),),
        'gcba_perfil_asignar_accion' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\PerfilController::PerfilAccionAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Perfil/AsignarAccion/',    ),  ),  4 =>   array (  ),),
        'gcba_perfil_addaccion' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\PerfilController::addaccionAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Usuario/addAccion/',    ),  ),  4 =>   array (  ),),
        'gcba_usuario_delaccion' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\PerfilController::delaccionAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Usuario/delAccion/',    ),  ),  4 =>   array (  ),),
        'gcba_usuario_cambiarpassword' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\UsuarioController::cambiarPasswordAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Usuario/cambiarPassword/',    ),  ),  4 =>   array (  ),),
        'gcba_dt_server' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\DtController::serverProcessingAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/DtServer',    ),  ),  4 =>   array (  ),),
        'gcba_gen_form' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\FormController::generadorAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Genorm',    ),  ),  4 =>   array (  ),),
        'gcba_bloqueos' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\BloqueoController::listarBloqueoAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Bloqueo',    ),  ),  4 =>   array (  ),),
        'gcba_root' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\DefaultController::IndexAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/',    ),  ),  4 =>   array (  ),),
        'gcba_clear' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\DefaultController::clearAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/Clear',    ),  ),  4 =>   array (  ),),
        'gcba_syncMenu' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\AccionController::syncMenuAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/SyncMenu',    ),  ),  4 =>   array (  ),),
        'gcba_getXml' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\AccionController::getXmlAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/getXml',    ),  ),  4 =>   array (  ),),
        'alta_rol' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\RolController::altaRolAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/alta_rol',    ),  ),  4 =>   array (  ),),
        'asignar_rol' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\RolController::asignarRolAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/asignar_rol',    ),  ),  4 =>   array (  ),),
        'asignar_area' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\RolController::agregarAreaAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/asignar_area',    ),  ),  4 =>   array (  ),),
        'remito_controller' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\RemitoController::altaAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/alta',    ),  ),  4 =>   array (  ),),
        'buscar_controller' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\RemitoController::buscarAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/buscar',    ),  ),  4 =>   array (  ),),
        'gregwar_captcha.generate_captcha' => array (  0 =>   array (    0 => 'key',  ),  1 =>   array (    '_controller' => 'Gregwar\\CaptchaBundle\\Controller\\CaptchaController::generateCaptchaAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'key',    ),    1 =>     array (      0 => 'text',      1 => '/generate-captcha',    ),  ),  4 =>   array (  ),),
        'snowcap_im_default_index' => array (  0 =>   array (    0 => 'format',    1 => 'path',  ),  1 =>   array (    '_controller' => 'Snowcap\\ImBundle\\Controller\\DefaultController::indexAction',  ),  2 =>   array (    'path' => '(.+)',  ),  3 =>   array (    0 =>     array (      0 => 'variable',      1 => '/',      2 => '(.+)',      3 => 'path',    ),    1 =>     array (      0 => 'variable',      1 => '/',      2 => '[^/]++',      3 => 'format',    ),    2 =>     array (      0 => 'text',      1 => '/cache/im',    ),  ),  4 =>   array (  ),),
        'snowcap_im_default_test' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'Snowcap\\ImBundle\\Controller\\DefaultController::testAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/cache/im/test',    ),  ),  4 =>   array (  ),),
        'login' => array (  0 =>   array (  ),  1 =>   array (    '_controller' => 'GCBA\\StoreBundle\\Controller\\SecurityController::loginAction',  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/login',    ),  ),  4 =>   array (  ),),
        'login_check' => array (  0 =>   array (  ),  1 =>   array (  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/login_check',    ),  ),  4 =>   array (  ),),
        'logout' => array (  0 =>   array (  ),  1 =>   array (  ),  2 =>   array (  ),  3 =>   array (    0 =>     array (      0 => 'text',      1 => '/logout',    ),  ),  4 =>   array (  ),),
    );

    /**
     * Constructor.
     */
    public function __construct(RequestContext $context, LoggerInterface $logger = null)
    {
        $this->context = $context;
        $this->logger = $logger;
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens);
    }
}
