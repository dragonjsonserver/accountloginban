<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2014 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAccountloginban
 */

namespace DragonJsonServerAccountloginban\Event;

/**
 * Eventklasse für die Erstellung eines Accountloginbanns
 */
class CreateAccountloginban extends \Zend\EventManager\Event
{
	/**
	 * @var string
	 */
	protected $name = 'CreateAccountloginban';

    /**
     * Setzt den Accountloginbann der erstellt wurde
     * @param \DragonJsonServerAccountloginban\Entity\Accountloginban $accountloginban
     * @return CreateAccountloginban
     */
    public function setAccountloginban(\DragonJsonServerAccountloginban\Entity\Accountloginban $accountloginban)
    {
        $this->setParam('accountloginban', $accountloginban);
        return $this;
    }

    /**
     * Gibt den Accountloginbann der erstellt wurde zurück
     * @return \DragonJsonServerAccountloginban\Entity\Accountloginban
     */
    public function getAccountloginban()
    {
        return $this->getParam('accountloginban');
    }
}
