<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAccountloginban
 */

namespace DragonJsonServerAccountloginban\Event;

/**
 * Eventklasse für die Entfernung eines Accountloginbanns
 */
class RemoveAccountloginban extends \Zend\EventManager\Event
{
	/**
	 * @var string
	 */
	protected $name = 'RemoveAccountloginban';

    /**
     * Setzt den Accountloginbann der entfernt wird
     * @param \DragonJsonServerAccountloginban\Entity\Accountloginban $accountloginban
     * @return RemoveAccountloginban
     */
    public function setAccountloginban(\DragonJsonServerAccountloginban\Entity\Accountloginban $accountloginban)
    {
        $this->setParam('accountloginban', $accountloginban);
        return $this;
    }

    /**
     * Gibt den Accountloginbann der entfernt wird zurück
     * @return \DragonJsonServerAccountloginban\Entity\Accountloginban
     */
    public function getAccountloginban()
    {
        return $this->getParam('accountloginban');
    }
}
