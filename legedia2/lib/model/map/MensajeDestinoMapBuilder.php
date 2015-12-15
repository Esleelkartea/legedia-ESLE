<?php


/**
 * This class adds structure of 'mensaje_destino' table to 'legedia' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Wed Oct 27 21:17:36 2010
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class MensajeDestinoMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.MensajeDestinoMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap(MensajeDestinoPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(MensajeDestinoPeer::TABLE_NAME);
		$tMap->setPhpName('MensajeDestino');
		$tMap->setClassname('MensajeDestino');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('ID_MENSAJE', 'IdMensaje', 'INTEGER' , 'mensaje', 'ID_MENSAJE', true, null);

		$tMap->addForeignPrimaryKey('ID_USUARIO', 'IdUsuario', 'INTEGER' , 'usuario', 'ID_USUARIO', true, null);

		$tMap->addColumn('LEIDO', 'Leido', 'BOOLEAN', false, null);

		$tMap->addColumn('BORRADO', 'Borrado', 'BOOLEAN', false, null);

	} // doBuild()

} // MensajeDestinoMapBuilder