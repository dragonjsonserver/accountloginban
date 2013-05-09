<?php
/**
 * @link http://dragonjsonserver.de/
 * @copyright Copyright (c) 2012-2013 DragonProjects (http://dragonprojects.de/)
 * @license http://license.dragonprojects.de/dragonjsonserver.txt New BSD License
 * @author Christoph Herrmann <developer@dragonprojects.de>
 * @package DragonJsonServerAccountloginban
 */

namespace DragonJsonServerAccountloginban\Service;

/**
 * Serviceklasse zur Verwaltung von Accountloginbanns
 */
class Accountloginban
{
	use \DragonJsonServer\ServiceManagerTrait;
	use \DragonJsonServer\EventManagerTrait;
	use \DragonJsonServerDoctrine\EntityManagerTrait;

	/**
	 * Erstellt einen Accountloginbann für die AccountID
	 * @param integer $account_id
	 * @param \DateTime $end
	 * @return \DragonJsonServerAccountloginban\Entity\Accountloginban
	 */
	public function createAccountloginban($account_id, \DateTime $end)
	{
		$accountloginban = $this->getAccountloginbanByAccountId($account_id, false);
		if (null === $accountloginban) {
			$accountloginban = (new \DragonJsonServerAccountloginban\Entity\Accountloginban())
				->setAccountId($account_id)
				->setEnd($end);
		} else {
			$accountloginban->setEnd($end);
		}
		$this->getServiceManager()->get('Doctrine')->transactional(function ($entityManager) use ($accountloginban) {
			$entityManager->persist($accountloginban);
			$entityManager->flush();
			$this->getEventManager()->trigger(
				(new \DragonJsonServerAccountloginban\Event\CreateAccountloginban())
					->setTarget($this)
					->setAccountloginban($accountloginban)
			);
		});
		return $accountloginban;
	}
	
	/**
	 * Entfernt den übergebenen Accountloginbann
	 * @param \DragonJsonServerAccountloginban\Entity\Accountloginban $accountloginban
	 * @return Accountloginban
	 */
	public function removeAccountloginban(\DragonJsonServerAccountloginban\Entity\Accountloginban $accountloginban)
	{
		$this->getServiceManager()->get('Doctrine')->transactional(function ($entityManager) use ($accountloginban) {
			$this->getEventManager()->trigger(
				(new \DragonJsonServerAccountloginban\Event\RemoveAccountloginban())
					->setTarget($this)
					->setAccountloginban($accountloginban)
			);
			$entityManager->remove($accountloginban);
			$entityManager->flush();
		});
	}
	
	/**
	 * Gibt den aktuellen Accountloginbann für die AccountID zurück
	 * @param integer $account_id
	 * @param boolean $throwException
	 * @return \DragonJsonServerAccountloginban\Entity\Accountloginban|null
     * @throws \DragonJsonServer\Exception
	 */
	public function getAccountloginbanByAccountId($account_id, $throwException = true)
	{
		$entityManager = $this->getEntityManager();

		$conditions = ['account_id' => $account_id];
		$accountloginban = $entityManager
			->getRepository('\DragonJsonServerAccountloginban\Entity\Accountloginban')
			->findOneBy($conditions);
		if (null === $accountloginban) {
			if ($throwException) {
				throw new \DragonJsonServer\Exception('invalid account_id', $conditions);
			}
			return;
		}
		if ($accountloginban->getEndTimestamp() < time()) {
			$this->removeAccountloginban($accountloginban);
			return;
		}
		return $accountloginban;
	}
}
