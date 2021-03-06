<?php

/**
 * Base class that represents a row from the 'grupo' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Wed Oct 27 21:17:36 2010
 *
 * @package    lib.model.om
 */
abstract class BaseGrupo extends BaseObject  implements Persistent {


  const PEER = 'GrupoPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        GrupoPeer
	 */
	protected static $peer;

	/**
	 * The value for the id_grupo field.
	 * @var        int
	 */
	protected $id_grupo;

	/**
	 * The value for the nombre field.
	 * @var        string
	 */
	protected $nombre;

	/**
	 * The value for the padre field.
	 * @var        int
	 */
	protected $padre;

	/**
	 * @var        array GrupoModulo[] Collection to store aggregation of GrupoModulo objects.
	 */
	protected $collGrupoModulos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collGrupoModulos.
	 */
	private $lastGrupoModuloCriteria = null;

	/**
	 * @var        array UsuarioGrupo[] Collection to store aggregation of UsuarioGrupo objects.
	 */
	protected $collUsuarioGrupos;

	/**
	 * @var        Criteria The criteria used to select the current contents of collUsuarioGrupos.
	 */
	private $lastUsuarioGrupoCriteria = null;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Initializes internal state of BaseGrupo object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
	}

	/**
	 * Get the [id_grupo] column value.
	 * 
	 * @return     int
	 */
	public function getIdGrupo()
	{
		return $this->id_grupo;
	}

	/**
	 * Get the [nombre] column value.
	 * 
	 * @return     string
	 */
	public function getNombre()
	{
		return $this->nombre;
	}

	/**
	 * Get the [padre] column value.
	 * 
	 * @return     int
	 */
	public function getPadre()
	{
		return $this->padre;
	}

	/**
	 * Set the value of [id_grupo] column.
	 * 
	 * @param      int $v new value
	 * @return     Grupo The current object (for fluent API support)
	 */
	public function setIdGrupo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id_grupo !== $v) {
			$this->id_grupo = $v;
			$this->modifiedColumns[] = GrupoPeer::ID_GRUPO;
		}

		return $this;
	} // setIdGrupo()

	/**
	 * Set the value of [nombre] column.
	 * 
	 * @param      string $v new value
	 * @return     Grupo The current object (for fluent API support)
	 */
	public function setNombre($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = GrupoPeer::NOMBRE;
		}

		return $this;
	} // setNombre()

	/**
	 * Set the value of [padre] column.
	 * 
	 * @param      int $v new value
	 * @return     Grupo The current object (for fluent API support)
	 */
	public function setPadre($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->padre !== $v) {
			$this->padre = $v;
			$this->modifiedColumns[] = GrupoPeer::PADRE;
		}

		return $this;
	} // setPadre()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			// First, ensure that we don't have any columns that have been modified which aren't default columns.
			if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id_grupo = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->padre = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 3; // 3 = GrupoPeer::NUM_COLUMNS - GrupoPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Grupo object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(GrupoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = GrupoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collGrupoModulos = null;
			$this->lastGrupoModuloCriteria = null;

			$this->collUsuarioGrupos = null;
			$this->lastUsuarioGrupoCriteria = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseGrupo:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(GrupoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			GrupoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseGrupo:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseGrupo:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(GrupoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseGrupo:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			GrupoPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			if ($this->isNew() ) {
				$this->modifiedColumns[] = GrupoPeer::ID_GRUPO;
			}

			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = GrupoPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setIdGrupo($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += GrupoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collGrupoModulos !== null) {
				foreach ($this->collGrupoModulos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUsuarioGrupos !== null) {
				foreach ($this->collUsuarioGrupos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = GrupoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collGrupoModulos !== null) {
					foreach ($this->collGrupoModulos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUsuarioGrupos !== null) {
					foreach ($this->collUsuarioGrupos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GrupoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdGrupo();
				break;
			case 1:
				return $this->getNombre();
				break;
			case 2:
				return $this->getPadre();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = GrupoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdGrupo(),
			$keys[1] => $this->getNombre(),
			$keys[2] => $this->getPadre(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GrupoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdGrupo($value);
				break;
			case 1:
				$this->setNombre($value);
				break;
			case 2:
				$this->setPadre($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GrupoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdGrupo($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPadre($arr[$keys[2]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(GrupoPeer::DATABASE_NAME);

		if ($this->isColumnModified(GrupoPeer::ID_GRUPO)) $criteria->add(GrupoPeer::ID_GRUPO, $this->id_grupo);
		if ($this->isColumnModified(GrupoPeer::NOMBRE)) $criteria->add(GrupoPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(GrupoPeer::PADRE)) $criteria->add(GrupoPeer::PADRE, $this->padre);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(GrupoPeer::DATABASE_NAME);

		$criteria->add(GrupoPeer::ID_GRUPO, $this->id_grupo);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getIdGrupo();
	}

	/**
	 * Generic method to set the primary key (id_grupo column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setIdGrupo($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Grupo (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setNombre($this->nombre);

		$copyObj->setPadre($this->padre);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getGrupoModulos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addGrupoModulo($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getUsuarioGrupos() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addUsuarioGrupo($relObj->copy($deepCopy));
				}
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setIdGrupo(NULL); // this is a auto-increment column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Grupo Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     GrupoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new GrupoPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears out the collGrupoModulos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addGrupoModulos()
	 */
	public function clearGrupoModulos()
	{
		$this->collGrupoModulos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collGrupoModulos collection (array).
	 *
	 * By default this just sets the collGrupoModulos collection to an empty array (like clearcollGrupoModulos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initGrupoModulos()
	{
		$this->collGrupoModulos = array();
	}

	/**
	 * Gets an array of GrupoModulo objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Grupo has previously been saved, it will retrieve
	 * related GrupoModulos from storage. If this Grupo is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array GrupoModulo[]
	 * @throws     PropelException
	 */
	public function getGrupoModulos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(GrupoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGrupoModulos === null) {
			if ($this->isNew()) {
			   $this->collGrupoModulos = array();
			} else {

				$criteria->add(GrupoModuloPeer::ID_GRUPO, $this->id_grupo);

				GrupoModuloPeer::addSelectColumns($criteria);
				$this->collGrupoModulos = GrupoModuloPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(GrupoModuloPeer::ID_GRUPO, $this->id_grupo);

				GrupoModuloPeer::addSelectColumns($criteria);
				if (!isset($this->lastGrupoModuloCriteria) || !$this->lastGrupoModuloCriteria->equals($criteria)) {
					$this->collGrupoModulos = GrupoModuloPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGrupoModuloCriteria = $criteria;
		return $this->collGrupoModulos;
	}

	/**
	 * Returns the number of related GrupoModulo objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related GrupoModulo objects.
	 * @throws     PropelException
	 */
	public function countGrupoModulos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(GrupoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collGrupoModulos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(GrupoModuloPeer::ID_GRUPO, $this->id_grupo);

				$count = GrupoModuloPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(GrupoModuloPeer::ID_GRUPO, $this->id_grupo);

				if (!isset($this->lastGrupoModuloCriteria) || !$this->lastGrupoModuloCriteria->equals($criteria)) {
					$count = GrupoModuloPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collGrupoModulos);
				}
			} else {
				$count = count($this->collGrupoModulos);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a GrupoModulo object to this object
	 * through the GrupoModulo foreign key attribute.
	 *
	 * @param      GrupoModulo $l GrupoModulo
	 * @return     void
	 * @throws     PropelException
	 */
	public function addGrupoModulo(GrupoModulo $l)
	{
		if ($this->collGrupoModulos === null) {
			$this->initGrupoModulos();
		}
		if (!in_array($l, $this->collGrupoModulos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collGrupoModulos, $l);
			$l->setGrupo($this);
		}
	}

	/**
	 * Clears out the collUsuarioGrupos collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addUsuarioGrupos()
	 */
	public function clearUsuarioGrupos()
	{
		$this->collUsuarioGrupos = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collUsuarioGrupos collection (array).
	 *
	 * By default this just sets the collUsuarioGrupos collection to an empty array (like clearcollUsuarioGrupos());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initUsuarioGrupos()
	{
		$this->collUsuarioGrupos = array();
	}

	/**
	 * Gets an array of UsuarioGrupo objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this Grupo has previously been saved, it will retrieve
	 * related UsuarioGrupos from storage. If this Grupo is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array UsuarioGrupo[]
	 * @throws     PropelException
	 */
	public function getUsuarioGrupos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(GrupoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsuarioGrupos === null) {
			if ($this->isNew()) {
			   $this->collUsuarioGrupos = array();
			} else {

				$criteria->add(UsuarioGrupoPeer::ID_GRUPO, $this->id_grupo);

				UsuarioGrupoPeer::addSelectColumns($criteria);
				$this->collUsuarioGrupos = UsuarioGrupoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(UsuarioGrupoPeer::ID_GRUPO, $this->id_grupo);

				UsuarioGrupoPeer::addSelectColumns($criteria);
				if (!isset($this->lastUsuarioGrupoCriteria) || !$this->lastUsuarioGrupoCriteria->equals($criteria)) {
					$this->collUsuarioGrupos = UsuarioGrupoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUsuarioGrupoCriteria = $criteria;
		return $this->collUsuarioGrupos;
	}

	/**
	 * Returns the number of related UsuarioGrupo objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related UsuarioGrupo objects.
	 * @throws     PropelException
	 */
	public function countUsuarioGrupos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(GrupoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collUsuarioGrupos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(UsuarioGrupoPeer::ID_GRUPO, $this->id_grupo);

				$count = UsuarioGrupoPeer::doCount($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


				$criteria->add(UsuarioGrupoPeer::ID_GRUPO, $this->id_grupo);

				if (!isset($this->lastUsuarioGrupoCriteria) || !$this->lastUsuarioGrupoCriteria->equals($criteria)) {
					$count = UsuarioGrupoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collUsuarioGrupos);
				}
			} else {
				$count = count($this->collUsuarioGrupos);
			}
		}
		return $count;
	}

	/**
	 * Method called to associate a UsuarioGrupo object to this object
	 * through the UsuarioGrupo foreign key attribute.
	 *
	 * @param      UsuarioGrupo $l UsuarioGrupo
	 * @return     void
	 * @throws     PropelException
	 */
	public function addUsuarioGrupo(UsuarioGrupo $l)
	{
		if ($this->collUsuarioGrupos === null) {
			$this->initUsuarioGrupos();
		}
		if (!in_array($l, $this->collUsuarioGrupos, true)) { // only add it if the **same** object is not already associated
			array_push($this->collUsuarioGrupos, $l);
			$l->setGrupo($this);
		}
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Grupo is new, it will return
	 * an empty collection; or if this Grupo has previously
	 * been saved, it will retrieve related UsuarioGrupos from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Grupo.
	 */
	public function getUsuarioGruposJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(GrupoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsuarioGrupos === null) {
			if ($this->isNew()) {
				$this->collUsuarioGrupos = array();
			} else {

				$criteria->add(UsuarioGrupoPeer::ID_GRUPO, $this->id_grupo);

				$this->collUsuarioGrupos = UsuarioGrupoPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(UsuarioGrupoPeer::ID_GRUPO, $this->id_grupo);

			if (!isset($this->lastUsuarioGrupoCriteria) || !$this->lastUsuarioGrupoCriteria->equals($criteria)) {
				$this->collUsuarioGrupos = UsuarioGrupoPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastUsuarioGrupoCriteria = $criteria;

		return $this->collUsuarioGrupos;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collGrupoModulos) {
				foreach ((array) $this->collGrupoModulos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collUsuarioGrupos) {
				foreach ((array) $this->collUsuarioGrupos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collGrupoModulos = null;
		$this->collUsuarioGrupos = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseGrupo:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseGrupo::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseGrupo
