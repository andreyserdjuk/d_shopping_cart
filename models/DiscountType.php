<?php

namespace models;

/**
 * @Entity
 * @Table(name="discount_type")
 */
Class DiscountType extends Entity {

	const ID_RELATIVE = 1;
	const ID_ABSOLUTE = 2;

	/**
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */
	protected $id;

	/**
	 * @Column(type="string", name="title", length=45, unique=false, nullable=false)
	 */
	protected $name;

    function getId() {
    	return $this->id;
    }

	function setTitle($title) {
	   $this->title = $title;
	}

	function getTitle() {
	   return $this->title;
	}
}