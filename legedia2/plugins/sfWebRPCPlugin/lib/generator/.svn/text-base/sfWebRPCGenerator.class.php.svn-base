<?php

/**
 * sfWebRPC generator.
 *
 * This class generates a Doctrine forms.
 *
 * @package    symfony
 * @subpackage generator
 * @author     Jerome Etienne <jerome.etienne@gmail.com>
 * @version    SVN: $Id: sfWebRPCGenerator.class.php 8512 2008-04-17 18:06:12Z fabien $
 */
class sfWebRPCGenerator extends sfGenerator
{
	protected
		$modelClass    = '',
		$params        = array();
    
	/**
	 * Initializes the current sfGenerator instance.
	 *
	 * @param sfGeneratorManager A sfGeneratorManager instance
	 */
	public function initialize(sfGeneratorManager $generatorManager)
	{
		parent::initialize($generatorManager);

		$this->setGeneratorClass('sfWebRPC');
		sfContext::getInstance()->getLogger()->err("WOW initialise");
	}

	/**
	 * Generates classes and templates in cache.
	 *
	 * @param array The parameters
	 *
	 * @return string The data to put in configuration cache
	*/
	public function generate($params = array())
	{
		$logger	= sfContext::getInstance()->getLogger();
		$logger->err("WOW generate enter");
		$logger->err(print_r($params, true));

		$this->params = $params;

		// check if all required parameters are present
		$required_parameters = array('moduleName');
		foreach( $required_parameters as $entry ){
			if( !isset($this->params[$entry]) ){
				throw new sfParseException(sprintf('You must specify a "%s".', $entry));
			}
		}

		// generated module name
		$this->setGeneratedModuleName('auto'.ucfirst($this->params['moduleName']));
		$this->setModuleName($this->params['moduleName']);

		// check if the theme exists?
		$theme = isset($this->params['theme']) ? $this->params['theme'] : 'default';
		$themeDir = $this->generatorManager->getConfiguration()->getGeneratorTemplate($this->getGeneratorClass(), $theme, '');
		if( !is_dir($themeDir) ){
			throw new sfConfigurationException(sprintf('The theme "%s" does not exist.', $theme));
		}

		$this->setTheme($theme);
		$files = sfFinder::type('file')->relative()->in($themeDir);
		$this->generatePhpFiles($this->generatedModuleName, $files);

		// require generated action class
		$data = "require_once(sfConfig::get('sf_module_cache_dir').'/".$this->generatedModuleName."/actions/actions.class.php');\n";

		$logger->err("WOW generate leave");
		return $data;		
	}

	/**
	 * Sets the model class.
	 *
	 * @param string $modelClass The model class
	*/
	public function setModelClass($modelClass)
	{
		$this->modelClass = $modelClass;
	}

	/**
	 * Gets the model class.
	 *
	 * @return string the model class
	*/
	protected function getModelClass()
	{
		return $this->modelClass;
	}
}