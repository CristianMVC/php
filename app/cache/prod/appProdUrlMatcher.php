<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        // gcba_homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'gcba_homepage');
            }

            return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\DefaultController::indexAction',  '_route' => 'gcba_homepage',);
        }

        // gcba_alta_usuario
        if (rtrim($pathinfo, '/') === '/alta_usuario') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'gcba_alta_usuario');
            }

            return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\UsuarioController::AltaUsuarioAction',  '_route' => 'gcba_alta_usuario',);
        }

        if (0 === strpos($pathinfo, '/Usuario')) {
            // gcba_usuario_homepage
            if (rtrim($pathinfo, '/') === '/Usuario') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'gcba_usuario_homepage');
                }

                return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\UsuarioController::listarUsuariosAction',  '_route' => 'gcba_usuario_homepage',);
            }

            // gcba_usuario_addperfil
            if (rtrim($pathinfo, '/') === '/Usuario/addPerfil') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'gcba_usuario_addperfil');
                }

                return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\UsuarioController::addperfilAction',  '_route' => 'gcba_usuario_addperfil',);
            }

            // gcba_usuario_delperfil
            if (rtrim($pathinfo, '/') === '/Usuario/delPerfil') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'gcba_usuario_delperfil');
                }

                return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\UsuarioController::delperfilAction',  '_route' => 'gcba_usuario_delperfil',);
            }

            // gcba_usuario_gcba_listar
            if (rtrim($pathinfo, '/') === '/Usuario/Gcba') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'gcba_usuario_gcba_listar');
                }

                return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\UsuarioGcbaController::listarUsuariosGcbaAction',  '_route' => 'gcba_usuario_gcba_listar',);
            }

        }

        // gcba_log_gcba_listar
        if ($pathinfo === '/Log') {
            return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\LogController::listarLogAction',  '_route' => 'gcba_log_gcba_listar',);
        }

        if (0 === strpos($pathinfo, '/Usuario')) {
            // gcba_usuario_editar
            if (0 === strpos($pathinfo, '/Usuario/Editar') && preg_match('#^/Usuario/Editar/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'gcba_usuario_editar')), array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\UsuarioController::editarUsuarioAction',));
            }

            if (0 === strpos($pathinfo, '/Usuario/Perfil')) {
                // gcba_perfil_alta
                if (rtrim($pathinfo, '/') === '/Usuario/Perfil/Alta') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'gcba_perfil_alta');
                    }

                    return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\PerfilController::altaPerfilAction',  '_route' => 'gcba_perfil_alta',);
                }

                // gcba_perfil_listar
                if (rtrim($pathinfo, '/') === '/Usuario/Perfil') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'gcba_perfil_listar');
                    }

                    return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\PerfilController::listarPerfilesAction',  '_route' => 'gcba_perfil_listar',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/Modulo')) {
            // gcba_modulo_editar
            if (0 === strpos($pathinfo, '/Modulo/Editar') && preg_match('#^/Modulo/Editar/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'gcba_modulo_editar')), array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\ModuloController::editarModuloAction',));
            }

            // gcba_modulo_alta
            if (rtrim($pathinfo, '/') === '/Modulo/Alta') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'gcba_modulo_alta');
                }

                return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\ModuloController::altaModuloAction',  '_route' => 'gcba_modulo_alta',);
            }

            // gcba_modulo_listar
            if (rtrim($pathinfo, '/') === '/Modulo') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'gcba_modulo_listar');
                }

                return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\ModuloController::listarModuloAction',  '_route' => 'gcba_modulo_listar',);
            }

        }

        if (0 === strpos($pathinfo, '/Accion')) {
            // gcba_accion_editar
            if (0 === strpos($pathinfo, '/Accion/Editar') && preg_match('#^/Accion/Editar/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'gcba_accion_editar')), array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\AccionController::editarAccionAction',));
            }

            // gcba_accion_alta
            if (rtrim($pathinfo, '/') === '/Accion/Alta') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'gcba_accion_alta');
                }

                return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\AccionController::altaAccionAction',  '_route' => 'gcba_accion_alta',);
            }

            // gcba_accion_listar
            if (rtrim($pathinfo, '/') === '/Accion') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'gcba_accion_listar');
                }

                return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\AccionController::listarAccionAction',  '_route' => 'gcba_accion_listar',);
            }

        }

        if (0 === strpos($pathinfo, '/Controlador')) {
            // gcba_controlador_editar
            if (0 === strpos($pathinfo, '/Controlador/Editar') && preg_match('#^/Controlador/Editar/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'gcba_controlador_editar')), array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\ControladorController::editarControladorAction',));
            }

            // gcba_controlador_alta
            if (rtrim($pathinfo, '/') === '/Controlador/Alta') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'gcba_controlador_alta');
                }

                return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\ControladorController::altaControladorAction',  '_route' => 'gcba_controlador_alta',);
            }

            // gcba_controlador_listar
            if (rtrim($pathinfo, '/') === '/Controlador') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'gcba_controlador_listar');
                }

                return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\ControladorController::listarControladorAction',  '_route' => 'gcba_controlador_listar',);
            }

        }

        // gcba_usuario_verinfo
        if (rtrim($pathinfo, '/') === '/Usuario/Verinfo') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'gcba_usuario_verinfo');
            }

            return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\UsuarioController::verinfousuarioAction',  '_route' => 'gcba_usuario_verinfo',);
        }

        // gcba_perfil_asignar_accion
        if (rtrim($pathinfo, '/') === '/Perfil/AsignarAccion') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'gcba_perfil_asignar_accion');
            }

            return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\PerfilController::PerfilAccionAction',  '_route' => 'gcba_perfil_asignar_accion',);
        }

        if (0 === strpos($pathinfo, '/Usuario')) {
            // gcba_perfil_addaccion
            if (rtrim($pathinfo, '/') === '/Usuario/addAccion') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'gcba_perfil_addaccion');
                }

                return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\PerfilController::addaccionAction',  '_route' => 'gcba_perfil_addaccion',);
            }

            // gcba_usuario_delaccion
            if (rtrim($pathinfo, '/') === '/Usuario/delAccion') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'gcba_usuario_delaccion');
                }

                return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\PerfilController::delaccionAction',  '_route' => 'gcba_usuario_delaccion',);
            }

            // gcba_usuario_cambiarpassword
            if (rtrim($pathinfo, '/') === '/Usuario/cambiarPassword') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'gcba_usuario_cambiarpassword');
                }

                return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\UsuarioController::cambiarPasswordAction',  '_route' => 'gcba_usuario_cambiarpassword',);
            }

        }

        // gcba_dt_server
        if ($pathinfo === '/DtServer') {
            return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\DtController::serverProcessingAction',  '_route' => 'gcba_dt_server',);
        }

        // gcba_gen_form
        if ($pathinfo === '/Genorm') {
            return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\FormController::generadorAction',  '_route' => 'gcba_gen_form',);
        }

        // gcba_bloqueos
        if ($pathinfo === '/Bloqueo') {
            return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\BloqueoController::listarBloqueoAction',  '_route' => 'gcba_bloqueos',);
        }

        // gcba_root
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'gcba_root');
            }

            return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\DefaultController::IndexAction',  '_route' => 'gcba_root',);
        }

        // gcba_clear
        if ($pathinfo === '/Clear') {
            return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\DefaultController::clearAction',  '_route' => 'gcba_clear',);
        }

        // gcba_syncMenu
        if ($pathinfo === '/SyncMenu') {
            return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\AccionController::syncMenuAction',  '_route' => 'gcba_syncMenu',);
        }

        // gcba_getXml
        if ($pathinfo === '/getXml') {
            return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\AccionController::getXmlAction',  '_route' => 'gcba_getXml',);
        }

        if (0 === strpos($pathinfo, '/a')) {
            // alta_rol
            if ($pathinfo === '/alta_rol') {
                return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\RolController::altaRolAction',  '_route' => 'alta_rol',);
            }

            if (0 === strpos($pathinfo, '/asignar_')) {
                // asignar_rol
                if ($pathinfo === '/asignar_rol') {
                    return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\RolController::asignarRolAction',  '_route' => 'asignar_rol',);
                }

                // asignar_area
                if ($pathinfo === '/asignar_area') {
                    return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\RolController::agregarAreaAction',  '_route' => 'asignar_area',);
                }

            }

            // remito_controller
            if ($pathinfo === '/alta') {
                return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\RemitoController::altaAction',  '_route' => 'remito_controller',);
            }

        }

        // buscar_controller
        if ($pathinfo === '/buscar') {
            return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\RemitoController::buscarAction',  '_route' => 'buscar_controller',);
        }

        // gregwar_captcha.generate_captcha
        if (0 === strpos($pathinfo, '/generate-captcha') && preg_match('#^/generate\\-captcha/(?P<key>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'gregwar_captcha.generate_captcha')), array (  '_controller' => 'Gregwar\\CaptchaBundle\\Controller\\CaptchaController::generateCaptchaAction',));
        }

        if (0 === strpos($pathinfo, '/cache/im')) {
            // snowcap_im_default_index
            if (preg_match('#^/cache/im/(?P<format>[^/]++)/(?P<path>(.+))$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'snowcap_im_default_index')), array (  '_controller' => 'Snowcap\\ImBundle\\Controller\\DefaultController::indexAction',));
            }

            // snowcap_im_default_test
            if ($pathinfo === '/cache/im/test') {
                return array (  '_controller' => 'Snowcap\\ImBundle\\Controller\\DefaultController::testAction',  '_route' => 'snowcap_im_default_test',);
            }

        }

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // login
                if ($pathinfo === '/login') {
                    return array (  '_controller' => 'GCBA\\StoreBundle\\Controller\\SecurityController::loginAction',  '_route' => 'login',);
                }

                // login_check
                if ($pathinfo === '/login_check') {
                    return array('_route' => 'login_check');
                }

            }

            // logout
            if ($pathinfo === '/logout') {
                return array('_route' => 'logout');
            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
