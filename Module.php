<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAccountloginban
 */

namespace DragonJsonServerAccountloginban;

/**
 * Klasse zur Initialisierung des Moduls
 */
class Module
{
    use \DragonJsonServer\ServiceManagerTrait;
	
    /**
     * Gibt die Konfiguration des Moduls zurück
     * @return array
     */
    public function getConfig()
    {
        return require __DIR__ . '/config/module.config.php';
    }

    /**
     * Gibt die Autoloaderkonfiguration des Moduls zurück
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }
    
    /**
     * Wird bei der Initialisierung des Moduls aufgerufen
     * @param \Zend\ModuleManager\ModuleManager $moduleManager
     */
    public function init(\Zend\ModuleManager\ModuleManager $moduleManager)
    {
    	$sharedManager = $moduleManager->getEventManager()->getSharedManager();
    	$sharedManager->attach('DragonJsonServerAccount\Service\Session', 'CreateSession', 
	    	function (\DragonJsonServerAccount\Event\CreateSession $eventCreateSession) {
	    		$serviceAccountloginban = $this->getServiceManager()->get('Accountloginban');
	    		$accountloginban = $serviceAccountloginban->getAccountloginbanByAccountId($eventCreateSession->getSession()->getAccountId(), false);
	    		if (null === $accountloginban) {
	    			return;
	    		}
	    		throw new \DragonJsonServer\Exception('accountloginban', ['accountloginban' => $accountloginban->toArray()]);
	    	}
    	);
    }
}
