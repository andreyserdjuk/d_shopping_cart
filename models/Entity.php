<?php

namespace models;

/**
 * Simple class with timestamps, deleted mark
 */
abstract class Entity
{
	/**
	 * Api keys are used for binding internal and external entity data
	 */
	const API_KEY_CREATION_TIME = 'creation_time';
	const API_KEY_LAST_UPDATE_TIME = 'last_update_time';

	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	protected $id;

	/**
	 * @Column(type="datetime", name="created_at", nullable=false)
	 */
	protected $creationTime;
	
	/**
	 * @Column(type="datetime", name="updated_at", nullable=false)
	 */
	protected $lastUpdate;

	/**
	 * @Column(type="boolean", name="deleted", nullable=false)
	 */
	protected $deleted = FALSE;
	

	public function getId()
	{
		return $this->id;
	}

	public function getLastUpdate()
	{
		return $this->lastUpdate;
	}

	public function setLastUpdate(\DateTime $lastUpdate)
	{
		$this->lastUpdate = $lastUpdate;
	}

	public function getCreationTime()
	{
		return $this->creationTime;
	}

	public function setCreationTime(\DateTime $creationTime)
	{
		$this->creationTime = $creationTime;
	}

	public function setDeleted($deleted)
	{
		$this->deleted = $deleted;
	}

	public function getDeleted()
	{
		return $this->deleted;
	}

	// TODO: write data provider, update func, permit (like in Rails)
	/**
	 * Update class data from some data provider
	 */	
	// public function update($map) {
		// Doctrine has no 
	// }
}