<?php
class alcanceFilter extends sfFilter
{
  public function execute($filterChain)
  {  
    $context = $this->getContext();  

    $usuario_actual = $context->getInstance()->getUser()->getAttribute('usuario',null,'usuarios');
    $actualizado = $context->getInstance()->getUser()->getAttribute('updated' , false , 'alcance');
   
   $context->getInstance()->getUser()->getAttributeHolder()->removeNamespace('alcance');
   
    if ($usuario_actual == null or $usuario_actual->getEsInvitado()) //Ana: 13-02-09. El usuario invitado no tiene derecho a nada
    {
      //poner a vacío los campos
      $context->getInstance()->getUser()->getAttributeHolder()->removeNamespace('alcance');
    }
    else
    {
      $alcances = $usuario_actual->getAlcances();
      $c_empresas = new Criteria();
      $c_tablas = new Criteria();
      $c_tareas = new Criteria();
      $c_usuarios = new Criteria();
      $c_formularios = new Criteria();
      $ver_todos_registros = false;
      
      //ordenar
      $c_empresas->addAscendingOrderByColumn(EmpresaPeer::NOMBRE);
      //$c_tablas->addAscendingOrderByColumn(TablaPeer::NOMBRE);

      $criterion_tar = $c_tareas->getNewCriterion(TareaPeer::ID_USUARIO , $usuario_actual->getPrimaryKey(), Criteria::EQUAL);
      $criterion_tar1 = $c_tareas->getNewCriterion(TareaPeer::ID_USUARIO , 0, Criteria::EQUAL);
      $criterion_tar2 = $c_tareas->getNewCriterion(TareaPeer::ID_USUARIO , null, Criteria::EQUAL);
      $c_tareas->addOr($criterion_tar);
      $c_tareas->addOr($criterion_tar1);
      $c_tareas->addOr($criterion_tar2);
      
      if (!sizeof($alcances))
      {
        //definir que no pueda ver nada, algo como id=0
        $c_empresas->add(EmpresaPeer::ID_EMPRESA , 0);
        $c_tablas->add(TablaPeer::ID_TABLA , 0);
        $c_usuarios->add(UsuarioPeer::ID_USUARIO , $usuario_actual->getPrimaryKey());
        $c_formularios->add(FormularioPeer::ID_FORMULARIO, 0);
      }
      else
      {
        $c_usuarios->addJoin(UsuarioPeer::ID_USUARIO , AlcancePeer::ID_USUARIO, Criteria::JOIN);        
        
        $c_usuarios->setDistinct();
        
        foreach($alcances as $alcance)
        {
          //#############################
          //1. empresa
          if ($alcance->getIdEmpresa())
          {
            $criterion_pmt= $c_empresas->getNewCriterion(EmpresaPeer::ID_EMPRESA , $alcance->getIdEmpresa() , Criteria::EQUAL);
          }
          else
          {
            $criterion_pmt = $c_empresas->getNewCriterion(EmpresaPeer::ID_EMPRESA , null , Criteria::NOT_EQUAL);
          }
          
          //#############################
          //2. tablas
          if ($alcance->getIdTabla())
          {
            $criterion_pmc = $c_tablas->getNewCriterion(TablaPeer::ID_TABLA , $alcance->getIdTabla() , Criteria::EQUAL);
          }
          else
          {
            if ($alcance->getIdEmpresa())
            {
              $criterion_pmc = $c_tablas->getNewCriterion(TablaPeer::ID_EMPRESA , $alcance->getIdEmpresa() , Criteria::EQUAL);
            }
            else
            {
              $criterion_pmc = $c_tablas->getNewCriterion(TablaPeer::ID_EMPRESA , null , Criteria::NOT_EQUAL);
            }
          }
          
          //#################################
          //3. Formularios
          $ver_todos_registros = ($ver_todos_registros || $alcance->getVerTodosRegistros());
          
          //#################################
          //4b. De paso defnimos a qué usuarios puede acceder el usuario.
            //solo los de las empresas/tablas indicadas.
            $criterion_tar = null;
            if ($alcance->getIdEmpresa() && !$alcance->getIdTabla())
            {
              $criterion_usu = $c_usuarios->getNewCriterion(AlcancePeer::ID_EMPRESA , $alcance->getIdEmpresa() );
            }
            elseif ($alcance->getIdTabla())
            {
              $criterion_usu = $c_usuarios->getNewCriterion(AlcancePeer::ID_TABLA , $alcance->getIdTabla() );
            }

          
          $c_empresas->addOr($criterion_pmt);
          $c_tablas->addOr($criterion_pmc);
          if (isset($criterion_usu)) $c_usuarios->addOr($criterion_usu);

          
        }//foreach
        
      }//if/else

      //AQUI. introducir los criterios en las variables de contexto del usuario  
      $context->getInstance()->getUser()->setAttribute('empresas' , $c_empresas , 'alcance');
      $context->getInstance()->getUser()->setAttribute('tablas' , $c_tablas , 'alcance');
      $context->getInstance()->getUser()->setAttribute('tareas' , $c_tareas , 'alcance');
      $context->getInstance()->getUser()->setAttribute('usuarios' , $c_usuarios , 'alcance');
      $context->getInstance()->getUser()->setAttribute('ver_todos_registros' , $ver_todos_registros , 'alcance');
      $context->getInstance()->getUser()->setAttribute('updated' , true , 'alcance');
    }//if/else

    // Execute next filter
    if ($filterChain != null) $filterChain->execute();
  }//function
}//class
?>
