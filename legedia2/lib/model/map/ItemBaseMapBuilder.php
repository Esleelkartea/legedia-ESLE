<?php


/**
 * This class adds structure of 'item_base' table to 'legedia' DatabaseMap object.
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
class ItemBaseMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ItemBaseMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(ItemBasePeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(ItemBasePeer::TABLE_NAME);
		$tMap->setPhpName('ItemBase');
		$tMap->setClassname('ItemBase');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID_ITEM_BASE', 'IdItemBase', 'INTEGER', true, null);

		$tMap->addForeignKey('ID_CAMPO', 'IdCampo', 'INTEGER', 'campo', 'ID_CAMPO', true, null);

		$tMap->addColumn('TEXTO', 'Texto', 'VARCHAR', false, 150);

		$tMap->addColumn('NUMERO_INFERIOR', 'NumeroInferior', 'FLOAT', false, null);

		$tMap->addColumn('NUMERO_SUPERIOR', 'NumeroSuperior', 'FLOAT', false, null);

		$tMap->addColumn('AYUDA', 'Ayuda', 'LONGVARCHAR', false, null);

		$tMap->addColumn('TEXTO_AUXILIAR', 'TextoAuxiliar', 'BOOLEAN', false, null);

		$tMap->addColumn('ORDEN', 'Orden', 'INTEGER', false, null);

		$tMap->addColumn('ES_RESPONSABLE_FICHERO', 'EsResponsableFichero', 'BOOLEAN', false, null);

		$tMap->addColumn('ES_INCONSISTENTE', 'EsInconsistente', 'BOOLEAN', false, null);

		$tMap->addColumn('BORRADO', 'Borrado', 'BOOLEAN', false, null);

	} // doBuild()

} // ItemBaseMapBuilder
