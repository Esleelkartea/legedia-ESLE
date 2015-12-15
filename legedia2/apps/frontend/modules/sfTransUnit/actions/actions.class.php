<?php

/**
 * trans_unit actions.
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Gareth James <symfony@bemused.org>
 * @version    SVN: $Id$
 */
require_once(dirname(__FILE__).'/../lib/BasesfTransUnitActions.class.php');

class sfTransUnitActions extends sfActions
{
  public function executeIndex()
  {
  	
    return $this->forward('sfTransUnit', 'list');
  }

  public function executeList()
  {
   
    $this->processSort();

    $this->processFilters();

    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/trans_unit/filters');

    // pager
    $this->pager = new sfPropelPager('TransUnit', sfConfig::get('app_listas_default'));
    $c = new Criteria();
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/trans_unit')));
    $this->pager->init();
    // save page
    if ($this->getRequestParameter('page')) {
        $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/trans_unit');
    }
    $this->labels = $this->getLabels();
  }

  public function executeCreate()
  {
  	
    return $this->forward('sfTransUnit', 'edit');
  }

  public function executeSave()
  {
  
    return $this->forward('sfTransUnit', 'edit');
  }

public function executeEdit()
  {
    $this->trans_unit = $this->getTransUnitOrCreate();
    $catalogues = CataloguePeer::getCatalogues();
    foreach ($catalogues as $catalogue) {
      $trans_unit_string = 'trans_unit_' . $catalogue->getCatId();
      $cat_id = $catalogue->getCatId();
      ${$trans_unit_string} = $this->getRequestParameter("trans_unit_$cat_id");
      if (isset(${$trans_unit_string}['msg_id'])) {
        $msg_id = ${$trans_unit_string}['msg_id'];
        $c = new Criteria();
        $c->add(TransUnitPeer::MSG_ID, $msg_id);
        $c->add(TransUnitPeer::CAT_ID, $catalogue->getCatId());
        $c->add(TransUnitPeer::SOURCE, $this->trans_unit->getSource());
        $trans_unit_cat = TransUnitPeer::doSelectOne($c);
      }
      if (isset($trans_unit_cat) && is_object($trans_unit_cat)) {
        $this->$trans_unit_string = $this->getTransUnitByMsgIdOrCreate($trans_unit_cat->getMsgId());
      } else {
        $this->$trans_unit_string = $this->getTransUnitOrCreate();
      }
    }

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      foreach ($catalogues as $catalogue) {
        $this->updateTransUnitCatIdFromRequest($catalogue->getCatId());
        $trans_unit_string = 'trans_unit_' . $catalogue->getCatId();
        $this->saveTransUnit($this->$trans_unit_string);
      }

      $this->getUser()->setFlash('notice', 'Your modifications have been saved');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('sfTransUnit/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('sfTransUnit/list');
      }
      else
      {
        return $this->redirect('sfTransUnit/edit?msg_id='.$this->$trans_unit_string->getMsgId());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  public function executeDelete()
  {
  	
    $this->trans_unit = TransUnitPeer::retrieveByPk($this->getRequestParameter('msg_id'));
    $this->forward404Unless($this->trans_unit);

    try
    {
      $this->deleteTransUnit($this->trans_unit);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected Trans unit. Make sure it does not have any associated items.');
      return $this->forward('sfTransUnit', 'list');
    }

    return $this->redirect('sfTransUnit/list');
  }

  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->trans_unit = $this->getTransUnitOrCreate();
    $this->updateTransUnitFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  protected function saveTransUnit($trans_unit)
  {
    $trans_unit->save();

  }

  protected function deleteTransUnit($trans_unit)
  {
    $trans_unit->delete();
  }

  protected function updateTransUnitFromRequest()
  {
    $trans_unit = $this->getRequestParameter('trans_unit');

    if (isset($trans_unit['source']))
    {
      $this->trans_unit->setSource($trans_unit['source']);
    }
    if (isset($trans_unit['target']))
    {
      $this->trans_unit->setTarget($trans_unit['target']);
    }
  }

  protected function updateTransUnitCatIdFromRequest($cat_id)
  {
    $trans_unit = $this->getRequestParameter('trans_unit');
    $trans_unit_string = 'trans_unit_' . $cat_id;
    ${$trans_unit_string} = $this->getRequestParameter("trans_unit_$cat_id");

    $this->$trans_unit_string->setDateAdded(time());
    $this->$trans_unit_string->setDateModified(time());
    
    $this->$trans_unit_string->setCatId($cat_id);
    if (isset($trans_unit['source']))
    {
      $this->$trans_unit_string->setSource($trans_unit['source']);
    }

    if (isset(${$trans_unit_string}['target']) && (${$trans_unit_string}['target'] != $this->$trans_unit_string->getTarget())) {
      $this->$trans_unit_string->setTranslated(1);
    } else if (! isset(${$trans_unit_string}['translated']))
    {
      $this->$trans_unit_string->setTranslated(0);
    } else if (isset(${$trans_unit_string}['translated']))
    {
      $this->$trans_unit_string->setTranslated(1);
    }

    if (isset(${$trans_unit_string}['default']) ) {
      $this->$trans_unit_string->setTarget($this->$trans_unit_string->getSource());
      $this->$trans_unit_string->setTranslated(1);
    } else if (isset(${$trans_unit_string}['target']))
    {
      $this->$trans_unit_string->setTarget(${$trans_unit_string}['target']);
    }
    if (isset(${$trans_unit_string}['comments']))
    {
      $this->$trans_unit_string->setComments(${$trans_unit_string}['comments']);
    }
  }
  
  protected function getTransUnitOrCreate($msg_id = 'msg_id')
  {
    if (!$this->getRequestParameter($msg_id))
    {
      $trans_unit = new TransUnit();
    }
    else
    {
      $trans_unit = TransUnitPeer::retrieveByPk($this->getRequestParameter($msg_id));

      $this->forward404Unless($trans_unit);
    }

    return $trans_unit;
  }
  
    protected function getTransUnitByMsgIdOrCreate($msg_id = NULL)
  {
    if (is_null($msg_id))
    {
      $trans_unit = new TransUnit();
    }
    else
    {
      $trans_unit = TransUnitPeer::retrieveByPk($msg_id);

      $this->forward404Unless($trans_unit);
    }
    return $trans_unit;
  }

  protected function processFilters()
  {
    if ($this->getRequest()->hasParameter('filter'))
    {
      $filters = $this->getRequestParameter('filters');

      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/trans_unit');
      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/trans_unit/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/trans_unit/filters');
    }
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/trans_unit/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/trans_unit/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/trans_unit/sort'))
    {
      $this->getUser()->setAttribute('sort', 'source', 'sf_admin/trans_unit/sort');
      $this->getUser()->setAttribute('type', 'asc', 'sf_admin/trans_unit/sort');
    }
  }
/*
  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['source_is_empty']))
    {
      $criterion = $c->getNewCriterion(TransUnitPeer::SOURCE, '');
      $criterion->addOr($c->getNewCriterion(TransUnitPeer::SOURCE, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['source']) && $this->filters['source'] !== '')
    {
      $c->add(TransUnitPeer::SOURCE, strtr($this->filters['source'], '*', '%'), Criteria::LIKE);
    }
    if (isset($this->filters['translated_is_empty']))
    {
      $criterion = $c->getNewCriterion(TransUnitPeer::TRANSLATED, '');
      $criterion->addOr($c->getNewCriterion(TransUnitPeer::TRANSLATED, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['translated']) && $this->filters['translated'] !== '')
    {
      $c->add(TransUnitPeer::TRANSLATED, $this->filters['translated']);
    }
    if (isset($this->filters['catfilter_is_empty']))
    {
      $criterion = $c->getNewCriterion(TransUnitPeer::CATFILTER, '');
      $criterion->addOr($c->getNewCriterion(TransUnitPeer::CATFILTER, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['catfilter']) && $this->filters['catfilter'] !== '')
    {
      $c->add(TransUnitPeer::CATFILTER, $this->filters['catfilter']);
    }
  }
*/
 protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['source_is_empty']))
    {
      $criterion = $c->getNewCriterion(TransUnitPeer::SOURCE, '');
      $criterion->addOr($c->getNewCriterion(TransUnitPeer::SOURCE, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['source']) && $this->filters['source'] !== '')
    {
      $c->add(TransUnitPeer::SOURCE, '%' . $this->filters['source']. '%', Criteria::LIKE);
    }
    if (isset($this->filters['translated_is_empty']))
    {
      $criterion = $c->getNewCriterion(TransUnitPeer::TRANSLATED, '');
      $criterion->addOr($c->getNewCriterion(TransUnitPeer::TRANSLATED, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['translated']) && $this->filters['translated'] !== '')
    {
      $c->add(TransUnitPeer::TRANSLATED, $this->filters['translated']);
    }
    if (isset($this->filters['cat_is_empty']))
    {
      $criterion = $c->getNewCriterion(TransUnitPeer::CAT_ID, '');
      $criterion->addOr($c->getNewCriterion(TransUnitPeer::CAT_ID, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['cat_id']) && $this->filters['cat_id'] !== '')
    {
      $c->add(TransUnitPeer::CAT_ID, $this->filters['cat_id']);
    }
  }
  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/trans_unit/sort'))
    {
      $sort_column = TransUnitPeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/trans_unit/sort') == 'asc')
      {
        $c->addAscendingOrderByColumn($sort_column);
      }
      else
      {
        $c->addDescendingOrderByColumn($sort_column);
      }
    }
  }

  protected function getLabels()
  {
    return array(
      'trans_unit{source}' => 'Texto original',
      'trans_unit{target}' => 'Texto traducido',
      'trans_unit{idioma}' => 'Idioma',
      'trans_unit{comments}' => 'Comentarios',
      'trans_unit{translated}' => 'Traducido',
      'trans_unit{catfilter}' => 'Catfilter', 
    );
  }
}
?>