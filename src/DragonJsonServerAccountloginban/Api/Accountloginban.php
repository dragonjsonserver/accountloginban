<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAccountloginban
 */

namespace DragonJsonServerAccountloginban\Api;

/**
 * API Klasse zur Verwaltung von Accountloginbanns
 */
class Accountloginban
{
	use \DragonJsonServer\ServiceManagerTrait;
	
	/**
	 * Gibt den Accountloginbann für den aktuellen Account zurück
	 * @return array|null
	 * @DragonJsonServerAccount\Annotation\Session
	 */
	public function getAccountloginban()
	{
		$serviceManager = $this->getServiceManager();

		$session = $serviceManager->get('Session')->getSession();
		$accountloginban = $serviceManager->get('Accountloginban')->getAccountloginbanByAccountId($session->getAccountId(), false);
		if (null !== $accountloginban) {
			$accountloginban = $accountloginban->toArray();
		}
		return $accountloginban;
	}
}
