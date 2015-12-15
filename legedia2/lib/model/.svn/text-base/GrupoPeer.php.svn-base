<?php

/**
 * Subclass for performing query and update operations on the 'grupo' table.
 *
 * 
 *
 * @package lib.model
 */ 
class GrupoPeer extends BaseGrupoPeer
{
  const ID_GRUPO_INVITADOS = 2;
  const ID_GRUPO_ADMINISTRADORES = 1;
  
  /**
  * Función que devuelve el identificador del grupo invitados.
  * @return id_grupo_invitados
  * @version 04-02-09
  * @author Ana Martín 
  */  
  public static function getIdGrupoInvitados() {
    return self::ID_GRUPO_INVITADOS;  
  }
  
  /**
  * Función que devuelve el identificador del grupo administradores.
  * @return id_grupo_administradores
  * @version 04-02-09
  * @author Ana Martín 
  */  
  public static function getIdGrupoAdministradores() {
    return self::ID_GRUPO_ADMINISTRADORES;  
  }
  
  /**
  * Función que devuelve una lista con los identificadores de los grupos no borrables.
  * @return lista de identificadores de grupos
  * @version 04-02-09
  * @author Ana Martín
  */
  public static function getAllGruposNoBorrables() {
    $lista = array(self::ID_GRUPO_ADMINISTRADORES, self::ID_GRUPO_INVITADOS);
   
    return $lista;
  
  }

  /**
  * Devuelve la lista de usuarios que pertenecen al grupo que pasa como parametro.
  * @param id_grupo, identificador del grupo.
  * @return array, lista de objetos de tipo usuario.
  * @version 17-02-09, 07-04-09
  * @author Ana Martín
  */  
  public static function getAllUsuarios($id_grupo) {
  
    $c = UsuarioPeer::getCriterioNoBorrado(UsuarioPeer::FECHA_BORRADO);
    $c->add(UsuarioGrupoPeer::ID_GRUPO, $id_grupo);
    $c->addJoin(UsuarioGrupoPeer::ID_USUARIO, UsuarioPeer::ID_USUARIO);
    $c->addAscendingOrderBycolumn(UsuarioPeer::USUARIO);
    $lista = UsuarioGrupoPeer::doSelectJoinUsuario($c);
    
    $lista_usuarios = array();
    foreach ($lista as $usuario_grupo) {
    
      $usuario = $usuario_grupo->getUsuario();
      if ($usuario instanceof Usuario){       
        $lista_usuarios[] =  $usuario;
      }
    
    }
   //  print_r($lista_usuarios);
    return $lista_usuarios;

  }
  
  /**
  * Devuelve la lista de usuarios del grupo administradores.
  * @return array, lista de objetos de tipo usuario
  * @version 23-02-09
  * @author Ana Martín
  */
  public static function getAllAdministradores() {
   
     return GrupoPeer::getAllUsuarios(GrupoPeer::getIdGrupoAdministradores());   
    
  }

}
