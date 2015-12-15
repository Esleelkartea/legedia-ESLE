<?php


/**
 * This class adds structure of 'formulario' table to 'legedia' DatabaseMap object.
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
class FormularioMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.FormularioMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(FormularioPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(FormularioPeer::TABLE_NAME);
		$tMap->setPhpName('Formulario');
		$tMap->setClassname('Formulario');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID_FORMULARIO', 'IdFormulario', 'INTEGER', true, null);

		$tMap->addForeignKey('ID_TABLA', 'IdTabla', 'INTEGER', 'tabla', 'ID_TABLA', true, null);

		$tMap->addForeignKey('ID_USUARIO_CREADOR', 'IdUsuarioCreador', 'INTEGER', 'usuario', 'ID_USUARIO', true, null);

		$tMap->addForeignKey('ID_USUARIO', 'IdUsuario', 'INTEGER', 'usuario', 'ID_USUARIO', true, null);

		$tMap->addColumn('FECHA', 'Fecha', 'TIMESTAMP', false, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null);

	} // doBuild()

} // FormularioMapBuilder