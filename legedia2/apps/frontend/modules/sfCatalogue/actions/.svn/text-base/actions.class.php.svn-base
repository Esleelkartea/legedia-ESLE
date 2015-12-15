<?php

/**
 * catalogue actions.
 *
 * @package    oubouffer
 * @subpackage catalogue
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2288 2006-10-02 15:22:13Z fabien $
 */

class sfCatalogueActions extends sfActions
{
public function executeIndex()
  {
  
    return $this->forward('sfCatalogue', 'list');
  }

  public function executeList()
  {
  
    $this->processSort();

    $this->processFilters();


    // pager
    $this->pager = new sfPropelPager('Catalogue', 20);
    $c = new Criteria();
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/catalogue')));
    $this->pager->init();
    // save page
    if ($this->getRequestParameter('page')) {
        $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/catalogue');
    }
    $this->labels = $this->getLabels();
  }

  public function executeCreate()
  {
  	
    return $this->forward('sfCatalogue', 'edit');
  }

  public function executeSave()
  {
  	
    return $this->forward('sfCatalogue', 'edit');
  }

  public function executeEdit()
  {
  	
    $this->catalogue = $this->getCatalogueOrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateCatalogueFromRequest();

      $this->saveCatalogue($this->catalogue);

      $this->getUser()->setFlash('notice', 'Your modifications have been saved');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('sfCatalogue/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('sfCatalogue/list');
      }
      else
      {
        return $this->redirect('sfCatalogue/edit?cat_id='.$this->catalogue->getCatId());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  public function executeDelete()
  {
  
    $this->catalogue = CataloguePeer::retrieveByPk($this->getRequestParameter('cat_id'));
    $this->forward404Unless($this->catalogue);

    try
    {
      $this->deleteCatalogue($this->catalogue);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected Catalogue. Make sure it does not have any associated items.');
      return $this->forward('sfCatalogue', 'list');
    }

    return $this->redirect('sfCatalogue/list');
  }

  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->catalogue = $this->getCatalogueOrCreate();
    $this->updateCatalogueFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  protected function saveCatalogue($catalogue)
  {
    $catalogue->save();

  }

  protected function deleteCatalogue($catalogue)
  {
    $catalogue->delete();
  }

  protected function updateCatalogueFromRequest()
  {
    $catalogue = $this->getRequestParameter('catalogue');

    if (isset($catalogue['nvisible']))
    {
      $this->catalogue->setNvisible($catalogue['nvisible']);
    }
    if (isset($catalogue['name']))
    {
      $this->catalogue->setName($catalogue['name']);
    }
    if (isset($catalogue['source_lang']))
    {
      $this->catalogue->setSourceLang($catalogue['source_lang']);
    }
    if (isset($catalogue['target_lang']))
    {
      $this->catalogue->setTargetLang($catalogue['target_lang']);
    }
    if (isset($catalogue['date_created']))
    {
      if ($catalogue['date_created'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($catalogue['date_created']))
          {
            $value = $dateFormat->format($catalogue['date_created'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $catalogue['date_created'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->catalogue->setDateCreated($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->catalogue->setDateCreated(null);
      }
    }
    if (isset($catalogue['date_modified']))
    {
      if ($catalogue['date_modified'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($catalogue['date_modified']))
          {
            $value = $dateFormat->format($catalogue['date_modified'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $catalogue['date_modified'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->catalogue->setDateModified($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->catalogue->setDateModified(null);
      }
    }
    if (isset($catalogue['author']))
    {
      $this->catalogue->setAuthor($catalogue['author']);
    }
  }

  protected function getCatalogueOrCreate($cat_id = 'cat_id')
  {
    if (!$this->getRequestParameter($cat_id))
    {
      $catalogue = new Catalogue();
    }
    else
    {
      $catalogue = CataloguePeer::retrieveByPk($this->getRequestParameter($cat_id));

      $this->forward404Unless($catalogue);
    }

    return $catalogue;
  }

  protected function processFilters()
  {
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/catalogue/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/catalogue/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/catalogue/sort'))
    {
    }
  }

  protected function addFiltersCriteria($c)
  {
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/catalogue/sort'))
    {
      $sort_column = CataloguePeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/catalogue/sort') == 'asc')
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
      'catalogue{cat_id}' => 'Id',
      'catalogue{nvisible}' => 'Nombre',
      'catalogue{name}' => 'Código',
      'catalogue{source_lang}' => 'Idioma original',
      'catalogue{target_lang}' => 'Idioma destino',
      'catalogue{date_created}' => 'Fecha de creación',
      'catalogue{date_modified}' => 'Fecha de modificación',
      'catalogue{author}' => 'Autor',
    );
  }
}
