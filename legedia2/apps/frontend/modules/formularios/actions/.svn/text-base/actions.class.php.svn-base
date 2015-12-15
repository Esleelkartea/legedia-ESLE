<?php

/**
 * formularios actions.
 *
 * @package    NeoCRM
 * @subpackage formularios
 * @author     Roberto Martín Huelmo
 * @version    19-02-09
 */
class formulariosActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('formularios', 'list');
  }

  public function executeList()
  {
    $this->processFilters();
    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf/formulario/filters');
    
    $tabla_actual = $this->getUser()->getAttribute('tabla_actual',null);
    if (isset($this->filters['id_tabla']) && $tabla_actual != $this->filters['id_tabla']) {
      $tabla_actual = $this->filters['id_tabla'];
      $this->getUser()->setAttribute('tabla_actual',$tabla_actual);
      $cambiado_tabla = true;
    }else {
      $cambiado_tabla = false;
    }
    
    $this->processSort($cambiado_tabla);
     
    $this->pager = new sfPropelPager('Formulario', sfConfig::get('app_listas_formularios'));
    $c = $this->getCriterio();
    
    $this->addFiltersCriteria($c);
    
    $this->addSortCriteria($c);
    $c->setDistinct();
    
    $this->pager->setCriteria($c);
    //$this->pager->setPeerMethod('doSelectJoinAll');
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  }

  public function executePopup()
  {
    $this->valor_sel = $this->getRequestParameter("valor_sel",0);
    $this->control_name = $this->getRequestParameter("control_name",0);
    $this->processFilters();
    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf/formulario/filters');
    
    $tabla_actual = $this->getUser()->getAttribute('tabla_actual',null);
    if (isset($this->filters['id_tabla']) && $tabla_actual != $this->filters['id_tabla']) {
      $tabla_actual = $this->filters['id_tabla'];
      $this->getUser()->setAttribute('tabla_actual',$tabla_actual);
      $cambiado_tabla = true;
    }else {
      $cambiado_tabla = false;
    }

    $this->processSort($cambiado_tabla);
     
    $this->pager = new sfPropelPager('Formulario', sfConfig::get('app_listas_formularios'));
    $c = $this->getCriterio();
    
    $this->addFiltersCriteria($c);
    
    $this->addSortCriteria($c);
    $c->setDistinct();
    
    $this->pager->setCriteria($c);
    //$this->pager->setPeerMethod('doSelectJoinAll');
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
  }
  
  public function executeCsv()
  {
    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf/formulario/filters');
    $c = $this->getCriterio();
    $this->addFiltersCriteria($c);
    $this->addSortCriteria($c);
    $c->setDistinct();
    $datos = FormularioPeer::doSelect($c);
    
    foreach ($datos as $formulario) break;
    if (!isset($formulario)){
      $id_tabla = isset($this->filters['id_tabla']) ? $this->filters['id_tabla'] : null;
      if (isset($id_tabla) && ($id_tabla!=''))
      {
        $tabla = TablaPeer::retrievebypk($id_tabla);
        $formulario = $tabla->getFormulario();
      }
      else $formulario = new Formulario();
    }
  
    if ($formulario->getTabla()) $nombre_hoja = utf8_decode($formulario->getTabla()->getNombreyEmpresa());
    else $nombre_hoja = utf8_decode("--");
    
    error_reporting(E_ALL);
    
   
    $lista_campos_extra = $formulario->getTabla()->getCamposFormularioOrdenados();

    //CABECERA
    $fila = 1;
    $col = 0;
    $txt = "";
    foreach ($lista_campos_extra as $campo) {
      if (!$campo->getBorrado()){
      
        if ($campo->esTipoLista()) $campo_txt = "id_item_base";
        if ($campo->esTipoTextoCorto()) $campo_txt = "texto_corto";
        if ($campo->esTipoTextoLargo()) $campo_txt = "texto_largo";
        if ($campo->esTipoNumero()) $campo_txt = "numero";
        if ($campo->esTipoFecha()) $campo_txt = "fecha";
        if ($campo->esTipoBooleano()) $campo_txt = "si_no";
        if ($campo->esTipoSelectPeriodo()) $campo_txt = "id_item_base";
        if ($campo->esTipoTabla()) $campo_txt = "numero";
        if ($campo->esTipoObjeto()) $campo_txt = "numero";
        
        $txt .= "\"".$campo->__toString()."\";";
      }
    }
    
    $txt .= "\n";
    
    //FILAS
    foreach ($datos as $formulario) {
      $col = 0;
      $fila ++;
      
      $items_formulario = $formulario->getArrayItems();
      foreach ($lista_campos_extra as $campo) {
        if (!$campo->getBorrado()){
          if (!$campo->esTipoLista()){
            $item_base = $campo->getElementoUnico();
            $item = isset($items_formulario[$item_base->getIdItemBase()]) ? $items_formulario[$item_base->getIdItemBase()] : null;
          }else {
            $item = null;
            $lista = $campo->getItemBases();
            foreach ($lista as $ib){
              if (isset($items_formulario[$ib->getIdItemBase()])){
               $item = $items_formulario[$ib->getIdItemBase()];
                break;
              }
            }
          }

          if ($item)
          {
             $txt .= "\"".$item->__toString(true)."\";";  
          }
          
          $col ++;
        }
      }
      $txt .= "\n";
    }
    
    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename=\"Registros de ".$nombre_hoja.".csv\"");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
    header("Pragma: public");
    echo $txt;
    
    exit();
  }
  
  public function executeExcel()
  {
    $formato = $this->getRequestParameter("formato","CSV");
    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf/formulario/filters');
    $c = $this->getCriterio();
    $this->addFiltersCriteria($c);
    $this->addSortCriteria($c);
    $c->setDistinct();
    $datos = FormularioPeer::doSelect($c);
    
    foreach ($datos as $formulario) break;
    if (!isset($formulario)){
      $id_tabla = isset($this->filters['id_tabla']) ? $this->filters['id_tabla'] : null;
      if (isset($id_tabla) && ($id_tabla!=''))
      {
        $tabla = TablaPeer::retrievebypk($id_tabla);
        $formulario = $tabla->getFormulario();
      }
      else $formulario = new Formulario();
    }
  
    $nombre_archivo_tmp = tempnam(sfConfig::get('app_directorio_tmp'), "datos_");
    rename($nombre_archivo_tmp , $nombre_archivo_tmp.".xls");
    $nombre_archivo = $nombre_archivo_tmp.".xls";
    
    error_reporting(E_ALL);
    $libro_campania = new Spreadsheet_Excel_Writer($nombre_archivo);
    
    $cabecera =& $libro_campania->addFormat();//
    $cabecera->setBold();
    $titulo =& $libro_campania->addFormat();//
    $titulo->setBold();
    $titulo->setSize(15);
    
    if ($formulario->getTabla()) $nombre_hoja = utf8_decode($formulario->getTabla()->getNombreyEmpresa());
    else $nombre_hoja = utf8_decode("--");
    
    $hoja =& $libro_campania->addWorksheet($nombre_hoja);
    
    $hoja->writeString(0, 0, "Registros de ".$nombre_hoja, $titulo);
    
    $lista_campos_extra = $formulario->getTabla()->getCamposFormularioOrdenados();

    //CABECERA
    $fila = 1;
    $col = 0;
    foreach ($lista_campos_extra as $campo) {
      if (!$campo->getBorrado()){
      
        if ($campo->esTipoLista()) $campo_txt = "id_item_base";
        if ($campo->esTipoTextoCorto()) $campo_txt = "texto_corto";
        if ($campo->esTipoTextoLargo()) $campo_txt = "texto_largo";
        if ($campo->esTipoNumero()) $campo_txt = "numero";
        if ($campo->esTipoFecha()) $campo_txt = "fecha";
        if ($campo->esTipoBooleano()) $campo_txt = "si_no";
        if ($campo->esTipoSelectPeriodo()) $campo_txt = "id_item_base";
        if ($campo->esTipoTabla()) $campo_txt = "numero";
        if ($campo->esTipoObjeto()) $campo_txt = "numero";
        
        $hoja->writeString($fila, $col, $campo->__toString(), $cabecera);
        $col ++;
      }
    }
    
    //FILAS
    foreach ($datos as $formulario) {
      $col = 0;
      $fila ++;
      
      $items_formulario = $formulario->getArrayItems();
      foreach ($lista_campos_extra as $campo) {
        if (!$campo->getBorrado()){
          if (!$campo->esTipoLista()){
            $item_base = $campo->getElementoUnico();
            $item = isset($items_formulario[$item_base->getIdItemBase()]) ? $items_formulario[$item_base->getIdItemBase()] : null;
          }else {
            $item = null;
            $lista = $campo->getItemBases();
            foreach ($lista as $ib){
              if (isset($items_formulario[$ib->getIdItemBase()])){
               $item = $items_formulario[$ib->getIdItemBase()];
                break;
              }
            }
          }

          if ($item)
          {
             $hoja->write($fila, $col, utf8_decode($item->__toString(true)));  
          }
          
          $col ++;
        }
      }
    }
    
    $libro_campania->send("Registros de ".$nombre_hoja.".xls");//cabeceras HTTP
  
    $libro_campania->close();
    $gestor = fopen($nombre_archivo, "rb");
    fpassthru($gestor);
    fclose($gestor);
    @unlink($nombre_archivo);
    
    exit();
  }

  public function executeDownload(){
    $item = ItemPeer::retrieveByPK($this->getRequestParameter('id_item',''), $this->getRequestParameter('id_formulario',''));

    if ($item instanceof Item){
        if ($item->getTextoCorto() != ""){
            $filename = sfConfig::get('app_directorio_upload').'docs/'.$item->getTextoCorto();
            //echo $filename."::".file_exists($filename);
            if (file_exists($filename)){
                $fname = explode("_",basename($filename));
                if (sizeof($fname) > 1) $fname = substr(basename($filename), strlen($fname[0])+1 );
                else $fname = $fname[0];

                header("Content-Type: application/force-download");
                header("Content-Type: application/octet-stream");
                header("Content-Type: application/download");
                header('Content-Disposition: attachment; filename="' . $fname . '"');
                header('Content-Length: '.filesize($filename));
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');

                $fp = fopen($filename, "r");
                fpassthru($fp);
                flush();
                fclose($fp);
            }
        }
    }

    die("EL FICHERO NO EXISTE");
  }

  public function executeCreate()
  {
    return $this->forward('formularios', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('formularios', 'edit');
  }

  public function executeEditPopup()
  {
    return $this->forward('formularios', 'edit');
  }
  
  public function executeCreatePopup()
  {
    return $this->forward('formularios', 'edit');
  }
  
  public function executeEdit()
  {
    if ($this->getRequestParameter('layout','')) $this->setLayout('popup');

    $this->tablaFicheros = TablaPeer::getTablaFicheros();
    $this->id_formulario_proviene = $this->getRequestParameter('id_formulario_proviene',null);
    $this->id_tabla_proviene = $this->getRequestParameter('id_tabla_proviene',null);
    
    $this->formulario = $this->getFormularioOrCreate();
    $this->items = $this->formulario->getArrayItems();
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      //GENERAMOS EL ID DEL FORMULARIO PARA QUE LO PUEDA COGER LA TAREA AL GUARDALA
       if ($this->formulario->getIdFormulario() == 0)
       {
           $this->saveFormulario($this->formulario);
       }
       
      $this->updateFormularioFromRequest();

      $this->saveFormulario($this->formulario);
      $this->getUser()->setFlash('notice', 'Las modificaciones se han guardado');
      if ($this->getRequestParameter('save_and_add'))
      {
        if ($this->id_formulario_proviene != null)
          return $this->redirect('formularios/create/?id_tabla='.$this->formulario->getIdTabla()."&id_formulario_proviene=".$this->id_formulario_proviene);
        else
          return $this->redirect('formularios/create/?id_tabla='.$this->formulario->getIdTabla());
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        /*$ruta=sfContext::getInstance()->getUser()->getAttribute('ruta_legedia',null);*/
        $ruta = UsuarioPeer::getRuta();
        if ($this->id_formulario_proviene != null){
          return $this->redirect('formularios/edit?id_formulario='.$this->id_formulario_proviene);
        }else {
          $dir = $ruta."/formularios/list/?filters[id_empresa]=".$this->formulario->getTabla()->getIdEmpresa()."&filters[id_tabla]=".$this->formulario->getIdTabla()."&filter=filter";
          header("location: $dir");
        }
        
        exit();
        //return $this->redirect('formularios/list');
      }
      else
      {
        if ($this->id_formulario_proviene != null)
          return $this->redirect('formularios/edit?id_formulario='.$this->id_formulario_proviene);
        else {
          $pre = str_replace('formularios/edit', 'notificaciones/inscribir/id_fichero/', Notificaciones::selfURL());
          if (isset($_POST['modelo']) && isset($_POST['sistema']) && isset($_POST['tip']))
            header('Location: '.$pre.$this->formulario->getIdFormulario().'?model='.$_POST['modelo'].'&type='.$_POST['tip'].'&system='.$_POST['sistema'].'&redirect=1');
          elseif (isset($_POST['modelo']) && isset($_POST['sistema']))
            header('Location: '.$pre.$this->formulario->getIdFormulario().'?model='.$_POST['modelo'].'&system='.$_POST['sistema'].'&redirect=1');
          else{
            //echo "--".$this->formulario->getIdFormulario();exit();
            return $this->redirect('formularios/edit?id_formulario='.$this->formulario->getIdFormulario());
          }
        }
      }
    }
    else
    {
      $this->tablas_auxiliares = array();
      
      if ($this->formulario->getIdFormulario() != 0){
        //Obtengo si hay un campo de tipo Tabla cuya tabla sea esta y tenga el mostrar_en_padre
        $c = new Criteria();
        $c->AddJoin(CampoPeer::ID_CAMPO, RelCampoTablaPeer::ID_CAMPO, Criteria::JOIN);
        $c->AddJoin(RelCampoTablaPeer::ID_TABLA, TablaPeer::ID_TABLA, Criteria::JOIN);
        $id_empresa = sfContext::getInstance()->getUser()->getAttribute('idempresa',0);
        $c->addAnd(TablaPeer::ID_EMPRESA, $id_empresa,Criteria::EQUAL);
        $c->addAnd(CampoPeer::TIPO, CampoPeer::ID_TABLA , Criteria::EQUAL);
        $c->addAnd(CampoPeer::MOSTRAR_EN_PADRE, 1, Criteria::EQUAL);
        $c->addAnd(CampoPeer::VALOR_TABLA, $this->formulario->getIdTabla(), Criteria::EQUAL);
        $campos_rel = CampoPeer::doSelect($c);

        foreach ($campos_rel as $campo_rel){
          //DEL CAMPO OBTENEMOS LA TABLA    
          $tablas_rel = $campo_rel->getRelCampoTablas();
          $tabla_rel = $tablas_rel[0];
          unset($tablas_rel);
          
          
          $c = $this->getCriterio();
    
          $c->addJoin(FormularioPeer::ID_FORMULARIO, ItemPeer::ID_FORMULARIO, Criteria::JOIN);
          $c->addJoin(ItemPeer::ID_ITEM_BASE, ItemBasePeer::ID_ITEM_BASE, Criteria::JOIN);
          $c->addAnd(ItemBasePeer::ID_CAMPO, $campo_rel->getIdCampo(), Criteria::EQUAL);
          $c->addAnd(ItemPeer::ID_TABLA, $this->formulario->getIdFormulario(), Criteria::EQUAL);
          
          $c->addAnd(FormularioPeer::ID_TABLA, $tabla_rel->getIdTabla(), Criteria::EQUAL);
          
          $this->processSort(false);
          $this->addSortCriteria($c);
          
          $c->setDistinct();
          
          $pager = new sfPropelPager('Formulario', sfConfig::get('app_listas_formularios'));
          $pager->setPeerMethod('doSelectJoinTabla');
          $pager->setCriteria($c);
          $pager->setPage($this->getRequestParameter('page', 1));
          $pager->init();
          
          $this->tablas_auxiliares[] = array("forms" => $pager/*FormularioPeer::doSelectJoinTabla($c)*/, "id_tabla" => $tabla_rel->getIdTabla());
        }
        
      }
      
      $this->labels = $this->getLabels();
    }
  }

  public function executeDelete()
  {
    $id_formulario_proviene = $this->getRequestParameter('id_formulario_proviene',null);
    
    $this->formulario = FormularioPeer::retrieveByPk($this->getRequestParameter('id_formulario'));

    $this->forward404Unless($this->formulario);
    
    $id_empresa = $this->formulario->getTabla()->getIdEmpresa();
    $id_tabla = $this->formulario->getIdTabla();
    try
    {
      $this->deleteFormulario($this->formulario);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'No ha podido borrarse la formulario. Asegúrese de que no tiene ningún objeto asociado.');
      return $this->forward('formularios', 'list');
    }

    if ($id_formulario_proviene != null)
      return $this->redirect('formularios/edit?id_formulario='.$id_formulario_proviene);
    else {
        //return $this->redirect('formularios/list');
        /*$ruta=sfContext::getInstance()->getUser()->getAttribute('ruta_legedia',null);*/
        $ruta = UsuarioPeer::getRuta();
        $dir = $ruta."/formularios/list/?filters[id_empresa]=".$id_empresa."&filters[id_tabla]=".$id_tabla."&filter=filter";
        header("location: $dir");
    }
    exit();
  }
  

  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->formulario = $this->getFormularioOrCreate();
    $this->items = $this->formulario->getArrayItems();
    $this->updateFormularioFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  protected function saveFormulario($formulario)
  {
    $formulario->save();
  }

  protected function deleteFormulario($formulario)
  {
    $formulario->delete();
  }
  
  protected function processSort($cambiado_tabla)
  {
    if ($cambiado_tabla){
      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/formulario/sort');
    }
    
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/formulario/sort');
      
      if ($this->getRequestParameter('sort_campo')) $this->getUser()->setAttribute('sort_campo', $this->getRequestParameter('sort_campo'), 'sf_admin/formulario/sort');
      else $this->getUser()->setAttribute('sort_campo', null, 'sf_admin/formulario/sort');
      
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/formulario/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/formulario/sort'))
    {
    }
  }
  
  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/formulario/sort'))
    {
      //if ($sort_column_campo = $this->getUser()->getAttribute('sort_campo', null, 'sf_admin/formulario/sort')){
      if ($sort_column != "fecha_form"){
        $c->addAlias("Item2", ItemPeer::TABLE_NAME);
        $c->addAlias("ItemBase2", ItemBasePeer::TABLE_NAME);

        $c->addJoin(FormularioPeer::ID_FORMULARIO, "Item2.ID_FORMULARIO", Criteria::JOIN);
        $c->addJoin("Item2.ID_ITEM_BASE", "ItemBase2.ID_ITEM_BASE", Criteria::JOIN);
        //$sort_column = ItemPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
        $sort_column = "Item2.".$sort_column;
        
        $sort_column_campo = $this->getUser()->getAttribute('sort_campo', null, 'sf_admin/formulario/sort');
        if ($sort_column_campo != null)
          $c->addAnd("ItemBase2.ID_CAMPO", $sort_column_campo, Criteria::EQUAL);
      }else{
        $sort_column = FormularioPeer::translateFieldName("fecha", BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      }
      
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/formulario/sort') == 'asc')
      {
        $c->addAscendingOrderByColumn($sort_column);
      }
      else
      {
        $c->addDescendingOrderByColumn($sort_column);
      }
    }
  }

  protected function updateFormularioFromRequest()
  {
    $formulario = $this->getRequestParameter('formulario'); 
    //datos por defecto de la formulario
    if (isset($formulario['id_tabla']))
    {
      $this->formulario->setIdTabla($formulario['id_tabla'] ? $formulario['id_tabla'] : null);
    }
    
    /*
    if (isset($formulario['fecha']['date']))
    {
      if ($formulario['fecha']['date'])
      {
        $this->formulario->setFecha($this->getFechaFromRequest($formulario['fecha']['date'] , $formulario['fecha']['hour'] , $formulario['fecha']['minute']));
      }
      else
      {
        $this->formulario->setFecha(null);
      }
    }
    */
    //PONEMOS LOS VALORES DE LA FECHA Y USUARIO AUTOMATICAMENTE
    $this->formulario->setFecha(time());
    $usuario_actual = $this->getUser()->getAttribute('usuario',null,'usuarios');
    $this->formulario->setIdUsuario($usuario_actual->getIdUsuario());
    if ($this->formulario->getIdFormulario() == 0) $this->formulario->setIdUsuarioCreador($usuario_actual->getIdUsuario());
    
    if (isset($formulario['id_empresa'])) $empresa = EmpresaPeer::retrieveByPk($formulario['id_empresa']);
    else $empresa = new Empresa();
    $this->updateItemsFormularioFromRequest($empresa, $formulario['id_tabla']);
  }
  


  protected function updateItemsFormularioFromRequest($empresa, $id_tabla = null)
  {

    //parametros obtenidos de la formulario_modelo.
    if (!$empresa) return null;
    
    $campos = $empresa->getCamposFormularioOrdenadosAlcancetablas($id_tabla);
    
    foreach($campos as $campo)
    {
      $name_campo = "campo_".$campo->getIdCampo();
      $datos_campo = $this->getRequestParameter($name_campo);

      if (!$campo->esTipoLista())
      {
        $item_base = $campo->getElementoUnico();
        $name_item = "item_base_".$item_base->getIdItemBase()."";
        $item = $this->getItemOrCreate($item_base->getIdItemBase());
        $item->setIdFormulario($this->formulario->getIdFormulario());
        if ($campo->esTipoTextoCorto())
        {
          $item->setTextoCorto((isset($datos_campo[$name_item])&&$datos_campo[$name_item]!='')? $datos_campo[$name_item] : null);
        }
        elseif ($campo->esTipoTextoLargo())
        {  
          $item->setTextoLargo((isset($datos_campo[$name_item])&&$datos_campo[$name_item]!='')? $datos_campo[$name_item] : null);
        }
        elseif ($campo->esTipoNumero())
        {  
          $item->setNumero((isset($datos_campo[$name_item])&&$datos_campo[$name_item]!='')? $datos_campo[$name_item] : null);
        }
        elseif ($campo->esTipoFecha())
        {
         if (isset($datos_campo[$name_item]) && $datos_campo[$name_item] != ""){
            $value = sfContext::getInstance()->getI18N()->getTimestampForCulture($datos_campo[$name_item], $this->getUser()->getCulture());
            $mi_date = new Date($value);
            
            $item->setFecha($mi_date->getTimestamp());

            //BORRAMOS LAS TAREAS QUE EXISTAN PARA ESTE ITEM, AUNQUE SEA UN CAMPO SIN ALARMA, POR SI ACASO
            if ($item->getIdItem() != 0){
                $c = new Criteria();
                $c->addAnd(TareaPeer::ID_CAMPO, $campo->getIdCampo(), Criteria::EQUAL);
                $c->addAnd(TareaPeer::ID_FORMULARIO, $this->formulario->getIdFormulario(), Criteria::EQUAL);
                TareaPeer::doDelete($c);
            }

            //CAMPOS CON ALARMA
            if ($campo->getMostrarEnPadre() && isset($datos_campo["tiene_alarma"])){
                $item->setSiNo(true);
                $item->setNumero($datos_campo['usuario_avisar']);

                if (!isset($datos_campo['cuando_alarma'])) $datos_campo['cuando_alarma'] = array();
                if (!is_array($datos_campo['cuando_alarma'])){
                    $datos_campo['cuando_alarma'] = array($datos_campo['cuando_alarma']);
                }
                $cuando = implode("##",$datos_campo['cuando_alarma']);
                $item->setTextoCorto($cuando);

                //CREAMOS TAREAS
                foreach ($datos_campo['cuando_alarma'] as $cu){

                   if ($cu == "1"){
                       $fecha_avisar = new Date($mi_date->getTimestamp());
                       $fecha_avisar->addMonths(-1);
                       $txt_avisar = "Falta un mes para";
                   }else if ($cu == "2"){
                       $fecha_avisar = new Date($mi_date->getTimestamp());
                       $fecha_avisar->addWeeks(-2);
                       $txt_avisar = "Faltan dos semanas para";
                   }else if ($cu == "3"){
                       $fecha_avisar = new Date($mi_date->getTimestamp());
                       $fecha_avisar->addWeeks(-1);
                       $txt_avisar = "Falta una semana para";
                   }else if ($cu == "4"){
                       $fecha_avisar = new Date($mi_date->getTimestamp());
                       $fecha_avisar->addDays(-1);
                       $txt_avisar = "Falta un día para";
                   }else if ($cu == "5"){
                       $fecha_avisar = new Date($mi_date->getTimestamp());
                       //$fecha_avisar->addMonths(-1);
                       $txt_avisar = "";
                   }

                   $hoy = new Date();
                   if ($fecha_avisar->getTimestamp() < $hoy->getTimestamp()) continue;
                   
                   $tarea = new Tarea();
                   $tarea->setIdCampo($campo->getIdCampo());
                   $tarea->setIdFormulario($this->formulario->getIdFormulario());

                   $tarea->setIdEmpresa(sfContext::getInstance()->getUser()->getAttribute('idempresa'));
                   if ($item->getNumero() != "" || $item->getNumero() != "0"){
                    $tarea->setAvisarEmail(true);
                    $tarea->setIdUsuario($item->getNumero());
                   }else {
                       $tarea->setAvisarEmail(false);
                   }

                   $mtabla = TablaPeer::retrieveByPK($id_tabla);
                   if (!$mtabla instanceof Tabla) $mtabla = new Tabla();
                   
                   $txt = $txt_avisar." el ".$item->__toString().", '".strtolower($campo->getNombre())."' de '".strtolower($mtabla->getNombre())."' para '".$this->formulario->__toString()."'";
                   $tarea->setResumen($txt);

                   $tarea->setEsEvento(false);
                   $tarea->setIdEstadoTarea(TareaPeer::ID_ESTADO_TAREA_PLANEADO);
                       
                   $fecha_avisar->setHours(8); $fecha_avisar->setMinutes(0);
                   $tarea->setFechaInicio($fecha_avisar->getTimestamp());

                   $fecha_avisar->setHours(20); $fecha_avisar->setMinutes(0);
                   $tarea->setFechaVencimiento($fecha_avisar->getTimestamp());

                   $tarea->save();

                   //$mis_tareas[] = $tarea->getIdTarea();
                }
            }else {
                $item->setSiNo(false);
                $item->setTextoCorto("");
            }
          } else {
            $item->setFecha(null);
          }

        }
        elseif($campo->esTipoBooleano())
        {
          $item->setSiNo(isset($datos_campo[$name_item]) ? true : false);
        }
        elseif ($campo->esTipoSelectPeriodo())
        {
          $name_item_year = "item_base_year_".$item_base->getIdItemBase();
          //hace falta nuevo campo en "item", para almacenar el tipo de periodo.
          $item->setNumero(isset($datos_campo[$name_item]) ? $datos_campo[$name_item] : null);
          $item->setAnio((isset($datos_campo[$name_item_year])&&$datos_campo[$name_item_year] != '') ? $datos_campo[$name_item_year] : null);
        }
        elseif ($campo->esTipoTabla())
        {  
          $item->setIdTabla((isset($datos_campo[$name_item])&&$datos_campo[$name_item]!='')? $datos_campo[$name_item] : null);
        }
        elseif ($campo->esTipoObjeto())
        {  
          $item->setIdObjeto((isset($datos_campo[$name_item])&&$datos_campo[$name_item]!='')? $datos_campo[$name_item] : null);
        }
        elseif ($campo->esTipoDocumento())
        {
           $fileName = $this->getRequest()->getFileName($name_campo);
           if (isset($fileName) && $fileName!='')
           {
                $filePath       = $this->getRequest()->getFilePath($name_campo);
                if (is_uploaded_file($filePath))
                {
                    if (!file_exists(sfConfig::get('app_directorio_upload').'/docs/')){
                      mkdir(sfConfig::get('app_directorio_upload').'/docs/');
                    } 
                    if ($item->getTextoCorto() != ""){
                        @unlink(sfConfig::get('app_directorio_upload').'/docs/'.$item->getTextoCorto());
                    }

                    move_uploaded_file ($filePath, sfConfig::get('app_directorio_upload').'/docs/'.$item->getIdItem()."_".$fileName);
                    $item->setTextoCorto($item->getIdItem()."_".$fileName);
                }
           }
        }
        else
        {
          //?
        }

        if (!$item->isDeleted()){
          //$this->formulario->addItem($item)
          $item->save();
        }
      }
      
      else
      {
        //es una lista
        $id_item_base_radio_seleccionado = isset($datos_campo['item_base']) ? $datos_campo['item_base'] : null;
        $items_base = $campo->getItemsBaseOrdenados();
        foreach($items_base as $item_base)
        {
          $name_item = "item_base_".$item_base->getIdItemBase()."";
          $name_item_texto_auxiliar = "item_base_texto_".$item_base->getIdItemBase();
          if ($campo->getSeleccionMultiple())
          {
            $item = $this->getItemOrCreate($item_base->getIdItemBase());
            $item->setIdFormulario($this->formulario->getIdFormulario());
            if (isset($datos_campo[$name_item]))
            {
              $item->setSiNo(true);
              $item->setTextoAuxiliar(isset($datos_campo[$name_item_texto_auxiliar]) ? $datos_campo[$name_item_texto_auxiliar] : '');
            }
            else
            {
              if (!$item->isNew())
              {
                $item->setSiNo(false);
                $item->setTextoAuxiliar(null);
              }//anteriormente lo borraba.
            }
            if (!$item->isDeleted())
            {
              //$this->formulario->addItem($item);
              $item->save();
            }
          }
          else
          {
            //solo puede haber uno.
            $item_radio = $this->getItemOrCreate($item_base->getIdItemBase());
            $item_radio_anterior = $item_radio;
            
            if ($item_base->getIdItemBase() == $id_item_base_radio_seleccionado)
            {
              $item_radio_seleccionado = $this->getItemOrCreate($item_base->getIdItemBase());
              $item_radio_seleccionado->setIdFormulario($this->formulario->getIdFormulario());
              $item_radio_seleccionado->setSiNo(true);
              $item_radio_seleccionado->setTextoAuxiliar(isset($datos_campo[$name_item_texto_auxiliar]) ? $datos_campo[$name_item_texto_auxiliar] : '');
              //$this->formulario->addItem($item_radio_seleccionado);
              $item_radio_seleccionado->save();
            }
            else
            {
              $item_radio_no_seleccionado = $this->getItemOrCreate($item_base->getIdItemBase());
              if ($item_radio_no_seleccionado->getIdItem())
              {
                $item_radio_no_seleccionado->delete();
              }
            }
            
          }
          
        }
        
        
      }
      //fin lista
    }

    //die();
  }

  protected function getFormularioOrCreate($idformulario = 'id_formulario')
  {
    if (!$this->getRequestParameter($idformulario))
    {
      //los campos deben venir de la empresa, no?
      $id_tabla = $this->getRequestParameter('id_tabla');
      $c_dem = TablaPeer::getCriterioAlcance();
      $c_dem->addAnd(TablaPeer::ID_TABLA , $id_tabla);
      $tabla = TablaPeer::doSelectOne($c_dem);
      $this->forward404unless($tabla);
      
      //Vamos a crear un formulario nuevo
      //$formulario = $tabla->getFormulario();
      //if (!isset($formulario))
      //{

        $formulario = new Formulario();

        $formulario->setIdTabla($id_tabla);
      //}
      //$formulario = isset($formulario) ? $formulario : new Formulario();
      //$formulario->setIdTabla($id_tabla ? $id_tabla : null);
    }
    else
    {
      $formulario = FormularioPeer::retrieveByPk($this->getRequestParameter($idformulario));
      $this->forward404Unless($formulario);
    }
    return $formulario;
  }
  
  
  protected function processFilters($pre_filter = false)
  {
    
    if ($this->getRequest()->hasParameter('filter'))
    {
      $filters = $this->getRequestParameter('filters');
      
      $reset_filter = $this->getRequestParameter('reset_filter',null);
      if ($reset_filter != null){
        $this->getUser()->getAttributeHolder()->removeNamespace('sf/formulario/filters');
      }
      
      //Si no tenemos filtro de empresa y talba=> lo ponemos nosotros
      if (!isset($filters['id_empresa']) && $filters['id_empresa'] == ''){
        $id_empresa_sel = sfContext::getInstance()->getUser()->getAttribute('idempresa',null);
        
        if ($id_empresa_sel == null || $id_empresa_sel == ""){
          $c1 = EmpresaPeer::getCriterioAlcance();
          $empresa = EmpresaPeer::doSelectOne($c1);
          $id_empresa_sel = $empresa->getPrimaryKey();
        }
        
        $filters['id_empresa'] = $id_empresa_sel;
      }
      if (!isset($filters['id_tabla']) && $filters['id_tabla'] == ''){
        $c1= TablaPeer::getCriterioAlcance();
        $c1->add(TablaPeer::ID_EMPRESA, $filters['id_empresa']);
        $tabla = TablaPeer::doSelectOne($c1);
      
        if ($tabla != null) {
          $filters['id_tabla'] = $tabla->getPrimaryKey();
        }
      }

      if (!isset($filters['no_realizacion'])){
        $filters['no_realizacion'] = 1;
      }
      
      if (sizeof($filters) == 2 && isset($filters['id_empresa']) && isset($filters['id_tabla'])){
        //SOLO VIENE FILTRADOR POR EMPRESA Y TABLA => ENTONCES CARGAMOS POR SI ACASO LOS FILTROS ANTERIORES
        $filters_temp = $this->getUser()->getAttributeHolder()->getAll('sf/formulario/filters');
        $filters_temp['id_empresa'] = $filters['id_empresa'];
        $filters_temp['id_tabla'] = $filters['id_tabla'];
        
        $filters = $filters_temp;
      }
      
      if (isset($filters['ultimo_contacto']['from']) && $filters['ultimo_contacto']['from'] !== '')
      {
        $filters['ultimo_contacto']['from'] = sfContext::getInstance()->getI18N()->getTimestampForCulture($filters['ultimo_contacto']['from'], $this->getUser()->getCulture());
      }
      if (isset($filters['ultimo_contacto']['to']) && $filters['ultimo_contacto']['to'] !== '')
      {
        $filters['ultimo_contacto']['to'] = sfContext::getInstance()->getI18N()->getTimestampForCulture($filters['ultimo_contacto']['to'], $this->getUser()->getCulture());
      }
      
      //Buscamos los posibles filtros de los campos de fechas.
      foreach ($filters as $key=>$campo){
        if (is_array($campo)){
         foreach ($campo as $key2 => $campo2){
           if ( (is_array($filters[$key][$key2])) && (isset($filters[$key][$key2]['from'])) && (isset($filters[$key][$key2]['to'])) ){
            $filters[$key][$key2]['from'] = sfContext::getInstance()->getI18N()->getTimestampForCulture($filters[$key][$key2]['from'], $this->getUser()->getCulture());
            $filters[$key][$key2]['to'] = sfContext::getInstance()->getI18N()->getTimestampForCulture($filters[$key][$key2]['to'], $this->getUser()->getCulture());
           }
         }
        }
      }
      
      $this->getUser()->getAttributeHolder()->removeNamespace('sf/formulario/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf/formulario/filters');
    }
    elseif ($pre_filter)
    {
      //marcar todas las casillas checkbox, ¿no?
      $filters = array();
      if ($this->getRequestParameter('id_empresa') && $this->getRequestParameter('id_empresa')!='')
      {
        $filters['id_empresa'] = $this->getRequestParameter('id_empresa');
      }
      $this->getUser()->getAttributeHolder()->removeNamespace('sf/formulario/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf/formulario/filters');
    }else {
      //filtros por defecto.
      $id_empresa_sel = sfContext::getInstance()->getUser()->getAttribute('idempresa',null);
      $filters = array();
      
      if ($id_empresa_sel == null || $id_empresa_sel == ""){
        $c1 = EmpresaPeer::getCriterioAlcance();
        $empresa = EmpresaPeer::doSelectOne($c1);
        $id_empresa_sel = $empresa->getPrimaryKey();
      }
      
      $filters['id_empresa'] = $id_empresa_sel;
      
      $c1= TablaPeer::getCriterioAlcance();
      $c1->add(TablaPeer::ID_EMPRESA, $id_empresa_sel);
      $tabla = TablaPeer::doSelectOne($c1);
    
      if ($tabla != null) {
        $filters['id_tabla'] = $tabla->getPrimaryKey();
      }

      $this->getUser()->getAttributeHolder()->removeNamespace('sf/formulario/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf/formulario/filters');
    }
    
  }
  
  protected function addFiltersCriteria($c)
  {
    //$c->addJoin(FormularioPeer::ID_TABLA, TablaPeer::ID_TABLA, Criteria::JOIN);

    //problemos aqui.
    $id_empresa = isset($this->filters['id_empresa']) ? $this->filters['id_empresa'] : "";
    $id_tabla = isset($this->filters['id_tabla']) ? $this->filters['id_tabla'] : null;
    if (($id_empresa !== "") && ($id_tabla != ""))
    {
      $c->addAnd(TablaPeer::ID_EMPRESA , $id_empresa, Criteria::EQUAL );
    }
    //id_tabla
    
    if ($id_tabla)
    {
      //NO CAMBIAR AQUI FormularioPeer::ID_TABLA por TablaPeer::ID_TABLA porque entonces no funciona para alguien que tienen permisos solo para algunas tablas
      $c->addAnd(FormularioPeer::ID_TABLA , $id_tabla, Criteria::EQUAL );
    }
    
    //fecha
    if (isset($this->filters['ultimo_contacto']))
    {
      if (isset($this->filters['ultimo_contacto']['from']) && $this->filters['ultimo_contacto']['from'] !== '')
      {
        $criterion = $c->getNewCriterion(FormularioPeer::FECHA, $this->filters['ultimo_contacto']['from'], Criteria::GREATER_EQUAL);
      }
      if (isset($this->filters['ultimo_contacto']['to']) && $this->filters['ultimo_contacto']['to'] !== '')
      {
        if (isset($criterion))
        {
          $criterion->addAnd($c->getNewCriterion(FormularioPeer::FECHA, $this->filters['ultimo_contacto']['to'], Criteria::LESS_EQUAL));
        }
        else
        {
          $criterion = $c->getNewCriterion(FormularioPeer::FECHA, $this->filters['ultimo_contacto']['to'], Criteria::LESS_EQUAL);
        }
      }
      if (isset($criterion))
      {
        $c->add($criterion);
      }
    }
    
    if (isset($this->filters['id_empresa']) && $this->filters['id_empresa'] != '') {
         $empresa = EmpresaPeer::retrieveByPk($this->filters['id_empresa']);
    }
    else {
        $id_empresa=sfContext::getInstance()->getUser()->getAttribute('idempresa',null);
        $empresa = EmpresaPeer::retrieveByPk($id_empresa);
    }
    
    //filtrar según campos personalizados.
    $campos = $empresa->getCamposFormularioOrdenadosAlcancetablas($id_tabla);

    if ($id_tabla == 63 && $this->filters['no_realizacion'] == 1){
        $c->addAnd(ItemPeer::ID_ITEM_BASE, 316, Criteria::EQUAL);
        $c->addAnd(ItemPeer::FECHA, null, Criteria::EQUAL);
    }
    elseif ($id_tabla == 63 && $this->filters['no_realizacion'] == 2){
         $c->addAnd(ItemPeer::FECHA, null, Criteria::NOT_EQUAL);
    }

    $filtros = new Filtros($campos , $this->filters);
    $filtros->updateCriteria($c);
  }
  
  
  protected function getFechaFromRequest($param_fecha , $param_horas = null, $param_minutos = null, $param_segundos = null)
  {
    $value = null;
    if (isset($param_fecha))
    {
      if ($param_fecha)
      {
        try
        {
          $timestamp_fecha = sfContext::getInstance()->getI18N()->getTimestampForCulture($param_fecha, $this->getUser()->getCulture());
          $fecha = new Date($timestamp_fecha);
          if (isset($param_horas))
          {
            $fecha->setHours($param_horas);
          }
          if (isset($param_minutos))
          {
            $fecha->setMinutes($param_minutos);
          }
          if (isset($param_segundos))
          {
            $fecha->setSeconds($param_segundos);
          }
          $value = $fecha->getTimestamp();
        }
        catch (sfException $e)
        {
          //no es una fecha
          $value = null;
        }
      }
    }
    return $value;
  }
  
  
  protected function getCriterio()
  {
    return FormularioPeer::getCriterioAlcance();
  }
  
  
  protected function getItemOrCreate($id_item_base = null)
  {
    $item = null;
    if (isset($this->items[$id_item_base]))
    {
      $item = $this->items[$id_item_base];
    }
    else
    {
      $item = new Item();
      $item->setIdItemBase($id_item_base);
    }
    return $item;
  }
  
  protected function getItemOrNull($id_item_base = null)
  {
    $item = null;
    if (isset($this->items[$id_item_base]))
    {
      $item = $this->items[$id_item_base];
    }
    else
    {
      $item = null;
    }
    return $item;
  }
  
  
  protected function getTablaOrNull($id_tabla = 'id_tabla')
  {
    $c_pr = TablaPeer::getCriterioAlcance();
    $c_pr->add(TablaPeer::ID_TABLA , $this->getRequestParameter($id_tabla));
    $tabla = TablaPeer::doSelectOne($c_pr);
    return $tabla ? $tabla : null;
  }
  
  
  protected function getCriterioEmpresas()
  {
    return EmpresaPeer::getCriterioAlcance();
  }
  
  protected function getCriteriotablas()
  {
    return TablaPeer::getCriterioAlcance();
  }
  

  protected function getLabels()
  {
    return array(
      'formulario{id_formulario}' => 'id',
      'formulario{id_empresa}' => 'empresa',
      'formulario{fecha}' => 'fecha',
      'formulario{created_at}' => 'fecha creación',
      'formulario{updated_at}' => 'última actualización',
    );
  }
}