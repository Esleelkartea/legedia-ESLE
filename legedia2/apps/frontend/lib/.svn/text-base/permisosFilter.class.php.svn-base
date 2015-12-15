<?php
/**
 * permisosFilter class.
 *
 * @package    NeoCRM
 * @subpackage usuario
 * @author     Roberto Martín Huelmo
 * @version    16-02-09
 */
class permisosFilter extends sfFilter
{
  /**
    * Execute this filter.
    *
    * @param FilterChain The filter chain.
    *
    * @return void
    * @throws <b>FilterException</b> If an error occurs during execution.
    */
    
  public function execute($filterChain)
  {
    $context = $this->getContext();
         
    $usuario_actual = $context->getInstance()->getUser()->getAttribute('usuario',null,'usuarios');
    
     
    if (!$context->getInstance()->getUser()->isAuthenticated())
    {
        $usuario_actual = UsuarioPeer::retrieveByPk(UsuarioPeer::getIdUsuarioInvitado());
        $usuario_actual->cargarOtrosDatos();
        $usuario_actual->registrarVisita(); 
        $context->getInstance()->getUser()->setAttribute('usuario',$usuario_actual,'usuarios');
     
    }
    
    $modulo = $context->getModuleName();
    $accion = $context->getActionName();
	  
    if (isset($usuario_actual))
    {
      $usuario_actual->guardarVisita();
    }
 
    if (!$usuario_actual->tienePermiso($modulo,$accion))
    {
            $context->getInstance()->getUser()->setAttribute('sinPermisos', true, 'fallos');
            $context->getInstance()->getUser()->setAttribute('modulo', $modulo, 'fallos');
            $context->getInstance()->getUser()->setAttribute('accion', $accion, 'fallos');
            if ($context->getInstance()->getUser()->isAuthenticated())
            {
            //Ana: 04-02-09   $context->getController()->forward('login' , 'secure');
              
              
              $context->getController()->forward('login', 'index');
              throw new sfStopException();// Rober 14-01-09
              $filterChain->execute();//?
            }
            else
            {
            
              $context->getInstance()->getUser()->setAttribute('usuario',null,'usuarios');
              
              $context->getController()->forward('login', 'index');
              throw new sfStopException();// Rober 14-01-09
              $filterChain->execute();//?
            }
    }
    
	  
    // Execute next filter*/
    $filterChain->execute();
    
  }
}
?>
