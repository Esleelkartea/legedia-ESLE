<?php

/**
 * Subclass for representing a row from the 'item' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Item extends BaseItem
{
  public function __toString($to_file = false)
  {
    include_once(SF_ROOT_DIR."/lib/symfony/helper/DateHelper.php");
    
    if (!$this->getPrimaryKey())
    {
      return null;
    }
    
    $campo = $this->getItemBase()->getCampo();
    
    $value = null;
    if (!$campo->esTipoLista())
    {
      if ($campo->esTipoTextoLargo())
      {
        $value = $this->getTextoLargo();
      }
      elseif ($campo->esTipoTextoCorto())
      {
        $value = $this->getTextoCorto();
      }
      elseif ($campo->esTipoDocumento())
      {
        if ($this->getTextoCorto() != ""){
          $fname = explode("_",basename($this->getTextoCorto()));
          if (sizeof($fname) > 1) $fname = substr(basename($this->getTextoCorto()), strlen($fname[0])+1 );
          else $fname = $fname[0];
          
          if ($to_file)
            $value = $fname;
          else 
            $value = "<a href=\"".dirname(UsuarioPeer::getRuta())."/index.php/formularios/download/?id_item=".$this->getIdItem()."&id_formulario=".$this->getIdFormulario()."\" target=\"_NEW\">".$fname."<a>";
        }else {
          $value = "";
        }
      }
      elseif ($campo->esTipoNumero())
      {
        $value = $this->getNumero();
      }
      elseif ($campo->esTipoFecha())
      {
        $value = format_date($this->getFecha(), "D");
      }
      elseif ($campo->esTipoBooleano())
      {
        if ($this->getSiNo())
         $value = sfContext::getInstance()->getI18N()->__("SI");
        else
          $value = sfContext::getInstance()->getI18N()->__("NO");
      }
      elseif ($campo->esTipoSelectPeriodo())
      {
       $value = nombre_periodo($campo->getTipoPeriodo() , $this->getNumero() , $this->getAnio());
      }
      elseif ($campo->esTipoTabla())
      {
        $form = FormularioPeer::retrieveByPk($this->getIdTabla());
        if ($form != null) $value = $form->__toString();
        else $value = "--";
      }
      elseif ($campo->esTipoObjeto())
      {
        eval("\$value = ".$campo->getValorObjeto()."Peer::retrieveByPk(\$this->getIdObjeto());");
        if ($value != null) $value = $value->__toString();
        else $value = "--";
      }
    }else {
      //Obtener los items del mismo formulario cuyo campo id_campo coincida con el de nuestro id_item_base
      $c = new Criteria();
      $c->addAnd(ItemPeer::ID_FORMULARIO, $this->getIdFormulario(), Criteria::EQUAL);
      $c->addAnd(ItemPeer::SI_NO, 1, Criteria::EQUAL);
      $c->addJoin(ItemPeer::ID_ITEM_BASE, ItemBasePeer::ID_ITEM_BASE, Criteria::JOIN);
      $c->addAnd(ItemBasePeer::ID_CAMPO, $this->getItemBase()->getIdCampo(), Criteria::EQUAL);
      $items_base_seleccionados = ItemBasePeer::doSelect($c); 
      
      if (sizeof($items_base_seleccionados))
      {
        $value .= (!$to_file) ? "<ul class=\"sf_admin_checklist\">\n" : "";
        foreach($items_base_seleccionados as $ibs)
        {
          $value .= (!$to_file) ? "<li>" : "";
          /****/
          if ($campo->esListaTipoRangos())
          {
            //lista de rangos
            $desde = null;
            $hasta = null;

            $unidad = CampoPeer::getHtmlTipoUnidad($campo->getUnidadRangos());
            $unidad = $unidad ? "&nbsp;".$unidad : '';
            if ($ibs->getNumeroInferior() && ($ibs->getNumeroInferior() != '') )
            {
              $desde = format_number($ibs->getNumeroInferior()).$unidad;
            }
            if ($ibs->getNumeroSuperior() && ($ibs->getNumeroSuperior() != '') )
            {
              $hasta = format_number($ibs->getNumeroSuperior()).$unidad;
            }
            
            if ($desde && $hasta)
            {
              $value .= __('desde %1% hasta %2%' , array('%1%' => $desde , '%2%' => $hasta));
            }
            else if ($desde)
            {
              $value .= __('más de %1%' , array('%1%' => $desde));
            }
            elseif ($hasta)
            {
              $value .= __('menos de %2%' , array('%2%' => $hasta));
            }
            else
            {
              $value .= null;
            }
          }
          else
          {
            $value .= $ibs->getTexto();
          }
          /****/
          if ($ibs->getTextoAuxiliar())
          {
            $texto_auxiliar = $this->getTextoAuxiliar() ? $this->getTextoAuxiliar() : null;
            $value .= isset($texto_auxiliar) ? "&nbsp;(".$texto_auxiliar.")" : '';
          }
          $value .= (!$to_file) ? "</li>" : " - ";
        }
        $value .= (!$to_file) ? "</ul>\n" : "";
        
        if (!$to_file) $value = substr($value, 0, strlen($value)-3);
      }
    }
    return $value;
  }
}
