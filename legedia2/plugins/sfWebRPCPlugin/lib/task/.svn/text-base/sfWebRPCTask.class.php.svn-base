<?php
/*
 * This file is part of the sfWebRPCPlugin package.
 * (c) 2006-2007 Jerome Etienne <jerome.etienne@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Initializes a Rest admin module.
 *
 * @package    sfWebRPCPlugin
 * @subpackage Task
 * @author     2006-2007 Jerome M. Etienne <jerome.etienne@gmail.com>
 * @version    SVN: $Id: sfAdminTask.class.php 8743 2008-05-03 05:02:39Z Jonathan.Wage $
 */
class sfWebRPCInitAdminTask extends sfBaseTask
{
	/**
	 * @see sfTask
	*/
	protected function configure()
	{
		$this->namespace	= 'WebRPC';
		$this->name		= 'generate-module';
		$this->briefDescription = 'Initializes a sfWebRPC admin module';
		$this->addArguments(array(
				new sfCommandArgument('application', sfCommandArgument::REQUIRED, 'The application name'),
				new sfCommandArgument('module', sfCommandArgument::REQUIRED, 'The module name'),
			));
 
		$this->detailedDescription = <<<EOF
Generate a sfWebRPC.

The [WebRPC:generate-module|INFO] task generates a WebRPC module:

  [./symfony WebRPC:generate-module frontend myWebRPC|INFO]

The task creates a [%module%|COMMENT] module in the [%application%|COMMENT] application.

TODO to comment
The created module is an empty one that inherit its actions and templates from
a runtime generated module in [%sf_app_cache_dir%/modules/auto%module%|COMMENT].
It has a default security.yml with is_secure set at on.

EOF;
	}

	/**
	 * @see sfTask
	*/
	protected function execute($arguments = array(), $options = array())
	{
		$properties = parse_ini_file(sfConfig::get('sf_config_dir').'/properties.ini', true);

		$constants = array(
			'PROJECT_NAME' => isset($properties['name']) ? $properties['name'] : 'symfony',
			'APP_NAME'     => $arguments['application'],
			'MODULE_NAME'  => $arguments['module'],
			'AUTHOR_NAME'  => isset($properties['author']) ? $properties['author'] : 'Your name here',
			);

		$moduleDir = sfConfig::get('sf_apps_dir').'/'.$arguments['application'].'/modules/'.$arguments['module'];

		// create module structure
		$finder = sfFinder::type('any')->ignore_version_control()->discard('.sf');
		$dirs = sfProjectConfiguration::getActive()->getGeneratorSkeletonDirs('sfWebRPC', "default");
		foreach ($dirs as $dir){
			if (is_dir($dir)){
				$this->getFileSystem()->mirror($dir, $moduleDir, $finder);
				break;
			}
		}

		// customize php and yml files
		$finder = sfFinder::type('file')->name('*.php', '*.yml');
		$this->getFileSystem()->replaceTokens($finder->in($moduleDir), '##', '##', $constants);
	}
}