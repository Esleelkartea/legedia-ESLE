<?php

/**
 * Subclass for performing query and update operations on the 'formulario' table.
 *
 * 
 *
 * @package lib.model
 */

class FormularioPeer extends BaseFormularioPeer {
    
    public static function getCriterioAlcanceVacio() {
        $c = new Criteria();
        $c->add(FormularioPeer::ID_FORMULARIO , 0);
        return $c;
    }
  
    public static function getCriterioAlcance() {
        //$ver_todos_registros = sfContext::getInstance()->getUser()->getAttribute('ver_todos_registros',false,'alcance');
        $ver_todos_registros = false;
        $tabla_actual = sfContext::getInstance()->getUser()->getAttribute('tabla_actual',null);
        $usuario_actual = sfContext::getInstance()->getUser()->getAttribute('usuario',null,'usuarios');

        $alcances = $usuario_actual->getAlcances();
        foreach ($alcances as $alc) {
            if ($alc->getIdTabla() == $tabla_actual || !$alc->getIdTabla()){
                $ver_todos_registros = ($ver_todos_registros || $alc->getVerTodosRegistros());
            }
        }

        $c_base = sfContext::getInstance()->getUser()->getAttribute('tablas',self::getCriterioAlcanceVacio(),'alcance');
        $cr = clone $c_base;
        $cr->addJoin(TablaPeer::ID_TABLA , FormularioPeer::ID_TABLA);

        if (!$ver_todos_registros) {
            $cr->addAnd(FormularioPeer::ID_USUARIO_CREADOR, $usuario_actual->getIdUsuario(), Criteria::EQUAL);
        }

        return $cr;
    }

    static function kriterio($criteria) {
        if (isset($_GET['i'])) {
            if ($_GET['i'] == '2') {
                $criteria->addJoin(self::ID_FORMULARIO, NotificacionesPeer::ID_FICHERO, Criteria::LEFT_JOIN);
                $criteria->add(NotificacionesPeer::ID_FICHERO, null, Criteria::ISNULL);
            } else {
                $criteria->addJoin(self::ID_FORMULARIO, NotificacionesPeer::ID_FICHERO, Criteria::LEFT_JOIN);
                $criteria->add(NotificacionesPeer::PROCESADO, $_GET['i']);
            }
        }
        return $criteria;
    }


    public static function doSelect(Criteria $criteria, PropelPDO $con = null) {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;
        $criteria = self::kriterio($criteria);
        return FormularioPeer::populateObjects(FormularioPeer::doSelectStmt($criteria, $con));
    }

    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null) {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(FormularioPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            FormularioPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(FormularioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        foreach (sfMixer::getCallables('BaseFormularioPeer:doCount:doCount') as $callable) {
            call_user_func($callable, 'BaseFormularioPeer', $criteria, $con);
        }

        $criteria = self::kriterio($criteria);

        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();
        return $count;
    }

}