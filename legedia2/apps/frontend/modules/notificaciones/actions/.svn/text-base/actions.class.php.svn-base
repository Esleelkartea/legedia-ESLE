<?php

/**
 * notificaciones actions.
 *
 * @package    legedia
 * @subpackage notificaciones
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
 
class notificacionesActions extends sfActions {
    
    public function executeIndex(sfWebRequest $request) { $this->forward('default', 'module'); }

    private function akzioak($request, $que = false) {
        $this->yafirmado = $request->getParameter('yafirmado',0);
        $this->sinatuta = $request->getParameter('sinatuta',0);

        $id_fichero = $request->getParameter('id_fichero');
        $id_notificacion = $request->getParameter('id_notificacion', null);
        if (!is_null($id_notificacion)) {
            $notificacion_anterior = NotificacionesPeer::retrieveByPK($id_notificacion);
            $this->id_notificacion = $id_notificacion;
        } else    $notificacion_anterior = null;

        if (!$que && $notificacion_anterior->getSoporte() == 'Internet firmado con certificado digital'){
            $pos = strrpos(UsuarioPeer::getRuta(), "https://");
            if ($pos === false) {
              header("location: ".str_replace("http://","https://",UsuarioPeer::getRuta()).'/notificaciones/enviar/id_notificacion/'.$notificacion_anterior->getNotId().'/id_fichero/'.$notificacion_anterior->getIdFichero());

              exit();
            }
        }

        if ($que) {
            $con = Propel::getConnection();
            $query = "SELECT `notificaciones`.* FROM `notificaciones` WHERE `notificaciones`.`notid` != '".$id_notificacion."' AND `notificaciones`.`id_fichero` = '".$id_fichero."';";
            $statement = $con->prepare($query);
            $statement->execute();
            $anteriores_tipo = array();
            $anteriores_procesado = array();
            while ($notificaciones_anteriores = $statement->fetch(PDO::FETCH_OBJ)) {
                $anteriores_tipo[] = $notificaciones_anteriores->tipo;
                $anteriores_procesado[] = $notificaciones_anteriores->procesado;
            }
        }

        if ($que && in_array($que, $anteriores_tipo) && array_search($que, $anteriores_tipo) !== false && $anteriores_procesado[array_search($que, $anteriores_tipo)] == '0')    return sfView::ERROR;
        else {
            $c = new Criteria();
            $c->addJoin(ItemPeer::ID_ITEM_BASE, ItemBasePeer::ID_ITEM_BASE, Criteria::JOIN);
            $c->addAnd(ItemPeer::ID_FORMULARIO, $id_fichero, Criteria::EQUAL);
            $c->addAnd(ItemBasePeer::ES_RESPONSABLE_FICHERO, true, Criteria::EQUAL);
            $item_encargado = ItemPeer::doSelectOne($c);
            if (is_null($item_encargado))   return sfView::ERROR;
            else {
                $this->id_fichero = $id_fichero;
                $this->empresa_actual = EmpresaPeer::retrieveByPK(sfContext::getInstance()->getUser()->getAttribute('idempresa', 0));
                $this->encargado = UsuarioPeer::retrieveByPk($item_encargado->getIdObjeto());
                $this->user_id = Usuario::getUsuarioActual()->getIdUsuario();
                $this->user = UsuarioPeer::retrieveByPk($this->user_id);
                return sfView::SUCCESS;
            }
        }
    }

    public function executeConsultar(sfWebRequest $request) { $this->gorde($request); }

    public function executeInscribir(sfWebRequest $request) { return $this->akzioak($request, 'Inscripcion'); }

    public function executeModificar(sfWebRequest $request) { return $this->akzioak($request, 'Modificacion'); }

    public function executeSuprimir(sfWebRequest $request) { return $this->akzioak($request, 'Supresion'); }

    public function executeEnviar(sfWebRequest $request) {
        require_once('xmlResponse.class.php');
        require_once('xmlseclibs.class.php');
        return $this->akzioak($request);
    }

    private function gorde($request) {
        $id_fichero = $request->getParameter('id_fichero');
        $c = new Criteria();
        $c->addJoin(ItemPeer::ID_ITEM_BASE, ItemBasePeer::ID_ITEM_BASE, Criteria::JOIN);
        $c->addAnd(ItemPeer::ID_FORMULARIO, $id_fichero, Criteria::EQUAL);
        $c->addAnd(ItemBasePeer::ES_RESPONSABLE_FICHERO, true, Criteria::EQUAL);
        $item_encargado = ItemPeer::doSelectOne($c);
        if ($item_encargado != null)    $this->encargado = UsuarioPeer::retrieveByPk($item_encargado->getIdObjeto());
        else    $this->encargado = Usuario::getUsuarioActual()->getUsuario();
    }

    public function executeGuardar_empezar_proceso(sfWebRequest $request) { $this->gorde($request); }

    public function executeGuardar_modificacion(sfWebRequest $request) { $this->gorde($request); }

    public function executeGuardar_supresion(sfWebRequest $request) { $this->gorde($request); }

    public function executeParar(sfWebRequest $request) {
        $id_fichero = $request->getParameter('id_fichero');
        $id_notificacion = $request->getParameter('id_notificacion',null);
        if ($id_notificacion != null)   $notificacion = NotificacionesPeer::retrieveByPK($id_notificacion);
        else    $notificacion = null;
        if ($notificacion instanceof Notificaciones){
            $notificacion->setHayQueParar(true);
            $notificacion->save();
            //ESTO LO HAGO ASI PORQUE NO HAY UN PROCESO BACKGROUND QUE TRATE LAS NOTIFICACIONES.
            //CUANDO LO HAYA ESTO HAY QUE QUITARLO YA QUE LA BORRARA EL OTRO PROCESO
            sleep(5);
            $notificacion->delete();
        }
        return $this->redirect('formularios/edit?id_formulario='.$id_fichero);
    }

}