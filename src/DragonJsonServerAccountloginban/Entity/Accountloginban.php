<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAccountloginban
 */

namespace DragonJsonServerAccountloginban\Entity;

/**
 * Entityklasse eines Accountloginbanns
 * @Doctrine\ORM\Mapping\Entity
 * @Doctrine\ORM\Mapping\Table(name="accountloginbans")
 */
class Accountloginban
{
	use \DragonJsonServerDoctrine\Entity\CreatedTrait;
	use \DragonJsonServerAccount\Entity\AccountIdTrait;
	
	/**
	 * @Doctrine\ORM\Mapping\Id 
	 * @Doctrine\ORM\Mapping\Column(type="integer")
	 * @Doctrine\ORM\Mapping\GeneratedValue
	 **/
	protected $accountloginban_id;
	
	/**
	 * @Doctrine\ORM\Mapping\Column(type="datetime")
	 **/
	protected $end;
	
	/**
	 * Setzt die ID des Accountloginbanns
	 * @param integer $accountloginban_id
	 * @return Accountloginban
	 */
	protected function setAccountloginbanId($accountloginban_id)
	{
		$this->accountloginban_id = $accountloginban_id;
		return $this;
	}
	
	/**
	 * Gibt die ID des Accountloginbanns zurück
	 * @return integer
	 */
	public function getAccountloginbanId()
	{
		return $this->accountloginban_id;
	}
	
	/**
	 * Setzt den Endzeitpunkt des Accountloginbanns
	 * @param \DateTime $end
	 * @return Accountloginban
	 */
	public function setEnd(\DateTime $end)
	{
		$this->end = $end;
		return $this;
	}
	
	/**
	 * Setzt den Endzeitpunkt des Accountloginbanns als Unix Timestamp
	 * @param integer $end
	 * @return Accountloginban
	 */
	public function setEndTimestamp($end)
	{
		$this->setEnd((new \DateTime())->setTimestamp($end));
		return $this;
	}
	
	/**
	 * Gibt den Endzeitpunkt des Accountloginbanns zurück
	 * @return \DateTime
	 */
	public function getEnd()
	{
		return $this->end;
	}
	
	/**
	 * Gibt den Endzeitpunkt des Accountloginbanns als Unix Timestamp zurück
	 * @return \DateTime
	 */
	public function getEndTimestamp()
	{
		$end = $this->getEnd();
		if (null === $end) {
			return;
		}
		return $end->getTimestamp();
	}
	
	/**
	 * Setzt die Attribute des Accountloginbanns aus dem Array
	 * @param array $array
	 * @return Accountloginban
	 */
	public function fromArray(array $array)
	{
		return $this
			->setAccountloginbanId($array['accountloginban_id'])
			->setCreatedTimestamp($array['created'])
			->setAccountId($array['account_id'])
			->setEndTimestamp($array['end']);
	}
	
	/**
	 * Gibt die Attribute des Accountloginbanns als Array zurück
	 * @return array
	 */
	public function toArray()
	{
		return [
			'__className' => __CLASS__,
			'accountloginban_id' => $this->getAccountloginbanId(),
			'created' => $this->getCreatedTimestamp(),
			'account_id' => $this->getAccountId(),
			'end' => $this->getEndTimestamp(),
		];
	}
}
