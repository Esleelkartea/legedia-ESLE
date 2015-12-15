<?php

/**
 * formulario_modelo actions.
 *
 * @package    Legedia
 * @subpackage formulario_modelo
 * @author     Roberto Martín Huelmo
 * @version    20-04-09
 */
class formulario_modeloActions extends sfActions
{
  
  public function executeEdit()
  {
    $this->empresa = $this->getEmpresaOr404();

    if ($this->getRequestParameter('id_tabla')) {   
       $tabla = TablaPeer::retrievebypk($this->getRequestParameter('id_tabla'));
       $this->id_tabla = $tabla->getPrimaryKey();
       $this->campos = $tabla->getCamposFormularioEmpresaTabla();
    }
    else {     
      $this->campos = $this->empresa->getCamposFormularioOrdenados();
    }
    $this->labels = $this->getLabels();
  }
  
  public function executeCreate_campo()
  {
    $this->forward('formulario_modelo' , 'edit_campo');
  }
  
  public function executeShow_campo()
  {
    if ($this->getRequestParameter('id_tabla')) {
      $this->tabla = TablaPeer::retrievebypk($this->getRequestParameter('id_tabla'));
    }
    $c = $this->getCriterio();
    $c->addAnd(CampoPeer::ID_CAMPO , $this->getRequestParameter('id_campo'));
    $this->campo = CampoPeer::doSelectOne($c);
    $this->forward404Unless($this->campo);
    $this->labels = $this->getLabels();
  }
  
  public function executeEdit_campo()
  {
    $this->campo = $this->getCampoOrCreate();
    if ($this->getRequestParameter('id_tabla')) {
        $this->tabla = TablaPeer::retrievebypk($this->getRequestParameter('id_tabla'));
    }

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateCampoFromRequest();
      //comprobar que se ha cambiado algún dato.
      if (!$this->campo->isNew() && $this->campo->isModified())
      {
        $this->campo->setEsInconsistente(true);
      }
      $this->saveCampo($this->campo);
      
      $this->getUser()->setFlash('notice', 'Las modificaciones se han guardado');

      if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('formulario_modelo/edit?id_empresa='.$this->campo->getIdEmpresa().'&id_tabla='.$this->getRequestParameter('id_tabla'));
      }
      elseif ($this->getRequestParameter('save_and_add'))
      {        
        return $this->redirect('formulario_modelo/create_campo?id_empresa='.$this->campo->getIdEmpresa().'&id_tabla='.$this->getRequestParameter('id_tabla'));
      }
      else
      {
        if ($this->getRequestParameter('id_tabla')) {
          return $this->redirect('formulario_modelo/edit_campo?id_campo='.$this->campo->getIdCampo().'&id_tabla='.$this->getRequestParameter('id_tabla'));
        }
        else {
          return $this->redirect('formulario_modelo/show_campo?id_campo='.$this->campo->getIdCampo());
        }
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }
  
  public function executeDelete_campo()
  {
    $this->campo = $this->getCampoOr404();
    $empresa = $this->campo->getEmpresa();
    $id_tabla = $this->getRequestParameter('id_tabla','');
    if ($id_tabla != "") $txt_tabla = '&id_tabla='.$id_tabla;
    else $txt_tabla = "";
    
    try
    {
      $this->deleteCampo($this->campo);
      $empresa->ordenarCamposFormulario();
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'No ha podido borrarse el campo. Asegúrese de que no tiene ningún objeto asociado.');
      return $this->forward('formulario_modelo', 'edit?id_empresa='.$empresa->getPrimaryKey().$txt_tabla);
    }
    return $this->redirect('formulario_modelo/edit?id_empresa='.$empresa->getPrimaryKey().$txt_tabla);
  }
  
  public function executeUndelete_campo()
  {
    $this->campo = $this->getCampoOr404();
    $empresa = $this->campo->getEmpresa();
    $id_tabla = $this->getRequestParameter('id_tabla','');
    if ($id_tabla != "") $txt_tabla = '&id_tabla='.$id_tabla;
    else $txt_tabla = "";
    
    try
    {
      $this->undeleteCampo($this->campo);
      $empresa->ordenarCamposFormulario();
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('un-delete', 'No ha podido des-borrarse el campo. Asegúrese de que no tiene ningún objeto asociado.');
      return $this->forward('formulario_modelo', 'edit?id_empresa='.$empresa->getPrimaryKey().$txt_tabla);
    }
    return $this->redirect('formulario_modelo/edit?id_empresa='.$empresa->getPrimaryKey().$txt_tabla);
  }
  
  public function executeOrdenar_campo()
  {
    $this->campo = $this->getCampoOr404();
    
    $id_tabla = $this->getRequestParameter('id_tabla','');
    if ($id_tabla != "") $txt_tabla = '&id_tabla='.$id_tabla;
    else $txt_tabla = "";
    
    $op = $this->getRequestParameter('op');
    if (!$op || ($op != "up" && $op != "down"))
    {
       $this->getUser()->setFlash('error', 'Operación incorrecta');
    }
    else
    {
      $c = new Criteria();
      $c->addJoin(CampoPeer::ID_CAMPO,RelCampoTablaPeer::ID_CAMPO);
      $c->addAnd(RelCampoTablaPeer::ID_TABLA, $id_tabla, Criteria::EQUAL);
      
      $empresa = $this->campo->getEmpresa();
      $campos = $empresa->getCamposFormularioOrdenados($c);
      
      //Restablecemos los indices del orden...
      for($i=0; $i< sizeof($campos);$i++){
        $campos[$i]->setOrden($i);
        $campos[$i]->save();
      }
      
      $orden = 1;
      for($i=0; $i< sizeof($campos);$i++)
      {
        $campo = $campos[$i];
        if ($campo->getIdCampo() == $this->campo->getIdCampo())
        {
          if ($op == "down")
          {
            if (isset($campos[$i+1]))
            {
              $campo = $campos[$i+1];
              $this->campo->swapWith($campo);
              break;
            }
          }
          else
          {
            if (isset($campos[$i-1]))
            {
              $campo = $campos[$i-1];
              $this->campo->swapWith($campo);
              break;
            }
          } 
        } 
      }
      $this->getUser()->setFlash('notice', 'Las modificaciones se han guardado');
    }
    return $this->redirect('formulario_modelo/edit?id_empresa='.$this->campo->getIdEmpresa().$txt_tabla);
  }
  
  
  
  
  
  public function executeCreate_item()
  {
    $this->forward('formulario_modelo' , 'edit_item');
  }
  
  
  public function executeEdit_item()
  {
    $this->itemBase = $this->getItemOrCreate();
    if ($this->getRequestParameter('id_tabla')) {
        $this->tabla = TablaPeer::retrievebypk($this->getRequestParameter('id_tabla'));
    }
    
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateItemFromRequest();
      $campo = $this->itemBase->getCampo();
      $es_tipo_lista = ($campo) ? $campo->esTipoLista() : true;
      if (!$this->itemBase->isNew() && $this->itemBase->isModified() && $es_tipo_lista)
      {
        $this->itemBase->setEsInconsistente(true);
        
        if ($campo) $campo->setEsInconsistente(true);
        $campo->save();
      }
      $this->saveItem($this->itemBase);
      
      $this->getUser()->setFlash('notice', 'Las modificaciones se han guardado');

      if ($this->getRequestParameter('save_and_campo'))
      {
        return $this->redirect('formulario_modelo/show_campo?id_campo='.$this->itemBase->getIdCampo()."&id_tabla=".$this->tabla->getPrimaryKey());
      }
      elseif ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('formulario_modelo/show_campo?id_campo='.$this->itemBase->getIdCampo()."&id_tabla=".$this->tabla->getPrimaryKey());
      }
      elseif ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('formulario_modelo/create_item?id_campo='.$this->itemBase->getIdCampo()."&id_tabla=".$this->tabla->getPrimaryKey());
      }
      else
      {
        return $this->redirect('formulario_modelo/edit_item?id_item_base='.$this->itemBase->getIdItemBase()."&id_tabla=".$this->tabla->getPrimaryKey());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }
  
  public function executeDelete_item()
  {
    $this->itemBase = $this->getItemOr404();
    $campo = $this->itemBase->getCampo();
    try
    {
      //$this->deleteCampo($campo);
      $campo->setEsInconsistente(true);
      $campo->save();
      $this->deleteItem($this->itemBase);
      $campo->ordenarItemsBase();
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'No ha podido borrarse el elemento. Asegúrese de que no tiene ningún objeto asociado.');
      return $this->forward('formulario_modelo', 'show_campo?id_campo='.$campo->getIdCampo()."&id_tabla=".$this->getRequestParameter('id_tabla',''));
    }
    return $this->redirect('formulario_modelo/show_campo?id_campo='.$campo->getIdCampo()."&id_tabla=".$this->getRequestParameter('id_tabla',''));
  }
  
  
  public function executeOrdenar_item()
  {
    $this->itemBase = $this->getItemOr404();
    $op = $this->getRequestParameter('op');
    if (!$op || ($op != "up" && $op != "down"))
    {
       $this->getUser()->setFlash('error', 'Operación incorrecta');
    }
    else
    {
      $campo = $this->itemBase->getCampo();
      $items = $campo->getItemsBaseOrdenados();
      
      $orden = 1;
      for($i=0; $i< sizeof($items);$i++)
      {
        
        $item = $items[$i];
        if ($item->getIdItemBase() == $this->itemBase->getIdItemBase())
        {
          if ($op == "down")
          {
            if (isset($items[$i+1]))
            {
              $item = $items[$i+1];
              $this->itemBase->swapWith($item);
              break;
            }
          }
          else
          {
            if (isset($items[$i-1]))
            {
              $item = $items[$i-1];
              $this->itemBase->swapWith($item);
              break;
            }
          } 
        } 
      }
      $this->getUser()->setFlash('notice', 'Las modificaciones se han guardado');
    }
    return $this->redirect('formulario_modelo/show_campo?id_campo='.$this->itemBase->getIdCampo()."&id_tabla=".$this->getRequestParameter('id_tabla',''));
  }
  
  
  public function executeActualizar_formulario_modelo()
  {
    $empresa = $this->getEmpresaOr404();
    $campos = $empresa->getCampos();
    foreach($campos as $campo)
    {
     /*
      if ($campo->getEsInconsistente())
      {
        $campo->setEsInconsistente(false);
        foreach($campo->getItemBases() as $item)
        {
          $item->setBorrado(false);
          $item->setEsInconsistente(false);
          $item->save();
        }
        $campo->save();
      }
      $campo->setBorrado(false);
      $campo->save();
      */
      if ($campo->getEsInconsistente())
      {
        if ($campo->getBorrado())
        {
          $campo->delete(null, true);
        }
        else
        {
          $campo->setEsInconsistente(false);
          foreach($campo->getItemBases() as $item)
          {
            if ($item->getBorrado()){
              $item->delete();
            }
            else {
              $item->setBorrado(false);
              $item->setEsInconsistente(false);
              $item->save();
            }
          }
          
          $campo->save();
          //$campo->ordenarItemsBase();
        }
      }
    }
    $empresa->ordenarCamposFormulario();
    $this->getUser()->setFlash('actualizar_ok', 'Los campos han sido actualizados');
    return $this->redirect('formulario_modelo/edit?id_empresa='.$empresa->getPrimaryKey()."&id_tabla=".$this->getRequestParameter('id_tabla'));
  }
  
  
  
  public function executeConsolidar_formularios()
  {
    $empresa = $this->getEmpresaOr404();
    $campos = $empresa->getCampos();
    foreach($campos as $campo)
    {
      if ($campo->getEsInconsistente())
      {
        //if (!$campo->getBorrado())
        $campo->deleteItemsFormularios();
        //$campo->delete(null, true); => Porque borraba el campo. No tiene logica, si lo he cambiado es por algo.
        
        $campo->setEsInconsistente(false);
      }
    }
    
    $this->getUser()->setFlash('consolidar_ok', 'Los registros se han consolidado con los nuevos campos');
    return $this->redirect('formulario_modelo/edit?id_empresa='.$empresa->getPrimaryKey()."&id_tabla=".$this->getRequestParameter('id_tabla'));
  }
  
  
  public function executeHtml_formulario()
  {
    $this->tabla = $this->getTablaOr404();//esto dejarlo asociado a una tabla.
  }
  
  
  
  
  
  protected function getEmpresaOr404($id_empresa = 'id_empresa')
  {
    if (!$this->getRequestParameter($id_empresa) )
    {     
        $this->forward404();     
    }   
    else
    {
      $c = $this->getCriterioEmpresa();
      $c->addAnd(EmpresaPeer::ID_EMPRESA , $this->getRequestParameter($id_empresa));
      $empresa = EmpresaPeer::doSelectOne($c);
      $this->forward404Unless($empresa);
    }
    return $empresa;
  }
  
  
  protected function getTablaOr404($id_tabla = 'id_tabla')
  {
    if (!$this->getRequestParameter($id_tabla))
    {
      $this->forward404();
    }
    else
    {
      $c = $this->getCriterioTabla();
      $c->addAnd(TablaPeer::ID_TABLA , $this->getRequestParameter($id_tabla));
      $tabla = TablaPeer::doSelectOne($c);
      $this->forward404Unless($tabla);
    }
    return $tabla;
  }
  
  
  protected function getCampoOrCreate($id_campo = 'id_campo')
  {
    if (!$this->getRequestParameter($id_campo))
    {
      $empresa = $this->getEmpresaOr404();
      $campo = new Campo();
      $campo->setIdEmpresa($empresa->getPrimaryKey());      
      $campo->setOrden($empresa->getPosicionSiguienteCampo());
      if($this->getRequestParameter('id_tabla')) {
        $campo->setEsGeneral(false);
      }
      else {
        $campo->setEsGeneral(true);
      }
    }
    else
    {
      $c = $this->getCriterio();
      $c->addAnd(CampoPeer::ID_CAMPO , $this->getRequestParameter($id_campo));
      $campo = CampoPeer::doSelectOne($c);

      $this->forward404Unless($campo);
    }
    return $campo;
  }
  
  protected function getCampoOr404($id_campo = 'id_campo')
  {
    if (!$this->getRequestParameter($id_campo))
    {
      $this->forward404();
    }
    else
    {
      $c = $this->getCriterio();
      $c->addAnd(CampoPeer::ID_CAMPO , $this->getRequestParameter($id_campo));
      $campo = CampoPeer::doSelectOne($c);

      $this->forward404Unless($campo);
    }

    return $campo;
  }
  
  protected function getItemOrCreate($id_item = 'id_item_base')
  {
    if (!$this->getRequestParameter($id_item))
    {
      $campo = $this->getCampoOr404();
      $item = new ItemBase();
      $item->setIdCampo($campo->getIdCampo());
      $item->setOrden($campo->getPosicionSiguienteItem());
    }
    else
    {
      $c = $this->getCriterio();
      $c->addAnd(ItemBasePeer::ID_ITEM_BASE , $this->getRequestParameter($id_item));
      $item = ItemBasePeer::doSelectOne($c);

      $this->forward404Unless($item);
    }
    return $item;
  }
  
  protected function getItemOr404($id_item = 'id_item_base')
  {
    if (!$this->getRequestParameter($id_item))
    {
      $this->forward404();
    }
    else
    {
      $c = $this->getCriterio();
      $c->addAnd(ItemBasePeer::ID_ITEM_BASE , $this->getRequestParameter($id_item));
      $item = ItemBasePeer::doSelectOne($c);

      $this->forward404Unless($item);
    }
    return $item;
  }
  
  protected function updateCampoFromRequest()
  {
    $campo = $this->getRequestParameter('campo');
    
    $this->campo->setEsGeneral(isset($campo['es_general']) ? true : false);
    
    $this->campo->setEsNombre(isset($campo['es_nombre']) ? true : false);
    
    $this->campo->setObligatorio(isset($campo['obligatorio']) ? true : false);
    
    $this->campo->setMismaFila(isset($campo['misma_fila']) ? true : false);
    
    $this->campo->setEnLista(isset($campo['en_lista']) ? true : false);
    
    if (isset($campo['id_empresa']))
    {
      $this->campo->setIdEmpresa($campo['id_empresa'] ? $campo['id_empresa'] : null);
    }
    if (isset($campo['nombre']))
    {
      $this->campo->setNombre($campo['nombre']);
    }
    if (isset($campo['descripcion']))
    {
      $this->campo->setDescripcion($campo['descripcion']);
    }
    if (isset($campo['tipo']))
    {
      $this->campo->setTipo(isset($campo['tipo']) ? $campo['tipo'] : CampoPeer::getDefaultId());
    }
    $this->campo->setSeleccionMultiple(isset($campo['seleccion_multiple']) ? true : false);
    $this->campo->setDesplegable(isset($campo['desplegable']) ? true : false);
        
    if (isset($campo['tipo_items']))
    {
      $this->campo->setTipoItems($campo['tipo_items'] ? $campo['tipo_items'] : CampoPeer::getDefaultIdTipoItems());
    }
    if (isset($campo['unidad_rangos']))
    {
      $this->campo->setUnidadRangos($campo['unidad_rangos'] ? $campo['unidad_rangos'] : null);
    }
    if (isset($campo['tipo_periodo']))
    {
      $this->campo->setTipoPeriodo($campo['tipo_periodo'] ? $campo['tipo_periodo'] : null);
    }
    if (isset($campo['tipo_tabla']))
    {
      $this->campo->setValorTabla($campo['tipo_tabla'] ? $campo['tipo_tabla'] : null);
    }

    //Si el tipo es otra tabla, significa que se ha de mostrar en el padre, si es fecha significa que es ALARMA
    $this->campo->setMostrarEnPadre(isset($campo['mostrar_en_padre']) ? true : false);
    
    if (isset($campo['tipo_objeto']))
    {
      $this->campo->setValorObjeto($campo['tipo_objeto'] ? $campo['tipo_objeto'] : null);
    }
    
    switch ($this->campo->getTipo()){
      case CampoPeer::ID_TEXTO_CORTO:
          $this->campo->setTamano($campo['tamano_texto_corto'] ? $campo['tamano_texto_corto'] : null);
        break;
      case CampoPeer::ID_TEXTO_LARGO:    
        $this->campo->setTamano($campo['tamano_texto_largo'] ? $campo['tamano_texto_largo'] : null);
        break;
      case CampoPeer::ID_NUMERO:
      $this->campo->setTamano($campo['tamano_numero'] ? $campo['tamano_numero'] : null);
       break;
    }
    
    switch ($this->campo->getTipo()){
      case CampoPeer::ID_TEXTO_CORTO:
        $this->campo->setDefecto($campo['defecto_texto_corto']);
        break;
      case CampoPeer::ID_TEXTO_LARGO:
        $this->campo->setDefecto($campo['defecto_texto_largo']);
        break;
      case CampoPeer::ID_BOOLEANO:
        $this->campo->setDefecto($campo['defecto_sino']);
        break;
      case CampoPeer::ID_LISTA:
        $this->campo->setDefecto($campo['defecto_lista']);
        break;
      case CampoPeer::ID_TABLA:
        $this->campo->setDefecto($campo['defecto_tabla']);
        break;
      case CampoPeer::ID_OBJETO:
        $this->campo->setDefecto($campo['defecto_objeto']);
        break;
      case CampoPeer::ID_NUMERO:
        $this->campo->setDefecto($campo['defecto_numero']);
        break;
      case CampoPeer::ID_FECHA:
        $this->campo->setDefecto($campo['defecto_fecha']);
        break;
    }
  }
  
  protected function updateItemFromRequest()
  {
    $campo = $this->getCampoOr404();
    $item = $this->getRequestParameter('item');
    if (!$campo->esTipoLista())
    {
      if (isset($item['ayuda']))
      {
        $this->itemBase->setAyuda($item['ayuda']);
      }
    }
    else
    {
      //recuperar todos los datos del item.
      //según el tipo del campo al que pertenece, guardar los necesarios.
      if (isset($item['id_campo']))
      {
        $this->itemBase->setIdCampo($item['id_campo']);
      }
      if (isset($item['texto']))
      {
        $this->itemBase->setTexto($item['texto']);
      }
      if (isset($item['numero_inferior']))
      {
        $this->itemBase->setNumeroInferior($item['numero_inferior']);
      }
      if (isset($item['numero_superior']))
      {
        $this->itemBase->setNumeroSuperior($item['numero_superior']);
      }
      if (isset($item['ayuda']))
      {
        $this->itemBase->setAyuda($item['ayuda']);
      }
      $this->itemBase->setTextoAuxiliar(isset($item['texto_auxiliar']) ? true : false);
    }
  }
  
  protected function saveCampo($campo)
  {
    if (!$campo->getIdCampo())
    {
      if (!$campo->esTipoLista())
      {
        //un campo "no lista" debe tener un item asociado.
        $item_aux = new ItemBase();
        $item_aux->setOrden(1);
        $campo->addItemBase($item_aux);
      }
    }
    
    // Update many-to-many for "campoTablas"
    $campo->initRelCampoTablas();
    
    $c = new Criteria();
    $c->add(RelCampoTablaPeer::ID_CAMPO, $campo->getPrimaryKey());
    RelCampoTablaPeer::doDelete($c);
    
    if (!$campo->getEsGeneral())
    {
      if ($this->getRequestParameter('id_tabla')) {
          $rel = new RelCampoTabla();
          $rel->setIdTabla($this->getRequestParameter('id_tabla'));
          $campo->addRelCampoTabla($rel);
      }
      else {
        $ids = $this->getRequestParameter('associated_campo_tablas');
        if (is_array($ids))
        {
          foreach ($ids as $id)
          {
            $rel = new RelCampoTabla();
            $rel->setIdTabla($id);
            $campo->addRelCampoTabla($rel);
          }
        }
      }
    }
    $campo->save();
  }
  
  protected function saveItem($item)
  {
    $item->save();
  }
  
  protected function deleteCampo($campo)
  {
    $campo->setEsInconsistente(true);
    $campo->delete();
  }
  
  protected function undeleteCampo($campo)
  {
    $campo->setEsInconsistente(false);
    $campo->undelete();
  }
  
  protected function deleteItem($item)
  {
    $campo = $item->getCampo();
    if ($campo)
    {
      $campo->setEsInconsistente(true);
    }
    $item->delete();
  }
  
  
  protected function getCriterioTabla()
  {
    return TablaPeer::getCriterioAlcance();
  }
  
  protected function getCriterioEmpresa()
  {
    return EmpresaPeer::getCriterioAlcance();
  }
  
  protected function getCriterio()
  {
    return new Criteria();
  }
  
  protected function getLabels()
  {
    return array(
      'campo{id_campo}' => 'campo',
      'campo{id_empresa}' => 'empresa',
      'campo{id_tabla}' => 'tabla',
      'campo{es_general}' => 'es general',
      'campo{nombre}' => 'nombre',
      'campo{descripcion}' => 'descripcion',
      'campo{tipo}' => 'tipo',
      'campo{desplegable}' => 'lista desplegable',
      'campo{seleccion_multiple}' => 'selección múltiple',
      'campo{orden}' => 'orden',
      'campo{tipo_items}' => 'tipo de los elementos',
      'campo{unidad_rangos}' => 'unidad',
      'campo{tipo_periodo}' => 'tipo de periodo',
      'campo{tipo_tabla}' => 'tabla',
      'campo{tipo_objeto}' => 'objeto',
      'campo{es_inconsistente}' => 'estado',
      'campo{es_nombre}' => 'es nombre',
      'campo{obligatorio}' => 'es obligatorio',
      'campo{misma_fila}' => 'En la misma fila',
      'campo{valor_defecto}' => 'Por defecto',
      'campo{en_lista}' => 'En lista',
      'campo{mostrar_en_padre}' => 'Mostrar en padre',
      'campo{tamano}' => 'Tamano',
      'campo{valor_tipos_documentos}' => 'Tipos de documentos aceptados',
       
      'item{ayuda}' => 'ayuda',
      'item{orden}' => 'orden',
      'item{texto}' => 'texto',
      'item{limite_inferior}' => 'límite inferior',
      'item{limite_superior}' => 'límite inferior',
      'item{numero_inferior}' => 'límite inferior',
      'item{numero_superior}' => 'límite superior',
      'item{texto_auxiliar}' => 'texto auxiliar',
      'item{mostrar}' => 'mostrar',
      'item{es_inconsistente}' => 'estado',
    );
  }
  
}
