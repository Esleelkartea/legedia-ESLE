<?php


/**
 * This class adds structure of 'taula2' table to 'legedia' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Wed Oct 27 21:17:37 2010
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class Taula2MapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.Taula2MapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(Taula2Peer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(Taula2Peer::TABLE_NAME);
		$tMap->setPhpName('Taula2');
		$tMap->setClassname('Taula2');

		$tMap->setUseIdGenerator(false);

		$tMap->addPrimaryKey('T2ID', 'T2id', 'INTEGER', true, null);

		$tMap->addColumn('DESCRIPCION', 'Descripcion', 'LONGVARCHAR', false, null);

	} // doBuild()

} // Taula2MapBuilder
