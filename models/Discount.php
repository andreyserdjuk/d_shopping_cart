<?php

namespace models;

// TODO: think about unbound class for using d_shopping cart as module - ugly solution for projects without Doctrine

/**
 * @Entity
 * @Table(name="discount", indexes={@index(name="search_idx", columns={"created_at", "updated_at"})})
 */
class Discount extends Entity
{
	const API_KEY_DISCOUNT_VALUE = "discount_value";
	const API_KEY_DISCOUNT_TYPE_ID = "discount_type_id";
	const API_KEY_SERVICE_ID = "service_id";
	const API_KEY_PERSON_ID = "person_id";
	const API_KEY_COMPANY_ID = "company_id";
	const API_KEY_PRODUCT_ID = "product_id";
	const API_KEY_DISCOUNT_COST_MINIMUM = "discount_cost_minimum";
	
	/**
	 * Delivery, information service etc. that can have a discount
	 *
	 * @ManyToOne(targetEntity="Service")
	 * @JoinColumn(name="service_id", referencedColumnName="id")
	 **/
	protected $service;

	/**
	 * Sales manager or administrator, who created a discount
	 *
	 * @ManyToOne(targetEntity="Person")
	 * @JoinColumn(name="operator_id", referencedColumnName="id")
	 **/
	protected $operator;
	
	/**
	 * Customer, who has discount
	 *
	 * @ManyToOne(targetEntity="Person")
	 * @JoinColumn(name="person_id", referencedColumnName="id")
	 **/
	protected $customerPerson;
	
	/**
	 * Company, that has discount
	 *
	 * @ManyToOne(targetEntity="Company")
	 * @JoinColumn(name="company_id", referencedColumnName="id")
	 **/
	protected $customerCompany;
	
	/**
	 * @ManyToOne(targetEntity="DiscountType")
	 * @JoinColumn(name="discount_type_id", referencedColumnName="id")
	 **/
	protected $discountType;

	/**
	 * @Column(type="float", name="discount_value", unique=false, nullable=false)
	 */
	protected $discountValue;

	/**
	 * @Column(type="float", name="discount_cost_minimum", nullable=true)
	 */
	protected $discountCostMinimum;
	
	/**
	 * @ManyToOne(targetEntity="Product")
	 * @JoinColumn(name="product_id", referencedColumnName="id")
	 **/
	protected $product;
	
	/**
	 * @Column(type="datetime", name="create_time", nullable=false)
	 */
	protected $createTime;


	public function setService(Service $service)
	{
		$this->service = $service;
	}

	public function getService()
	{
		return $this->service;
	}

	public function setOperator(Person $operator)
	{
		$this->operator = $operator;
	}

	public function getOperator()
	{
		return $this->operator;
	}

	public function setPerson(Person $person)
	{
		$this->person = $person;
	}

	public function getPerson()
	{
		return $this->person;
	}

	public function setCompany(Company $company)
	{
		$this->company = $company;
	}

	public function getCompany()
	{
		return $this->company;
	}

	public function setDiscountType(DiscountType $discountType)
	{
		$this->discountType = $discountType;
	}

	public function getDiscountType()
	{
		return $this->discountType;
	}

	public function setDiscountValue($discountValue)
	{
		$this->discountValue = $discountValue;
	}

	public function getDiscountValue()
	{
		return $this->discountValue;
	}

	public function setProduct(Product $product)
	{
		$this->product = $product;
	}

	public function getProduct()
	{
		return $this->product;
	}

	public function setCreateTime(\DateTime $createTime)
	{
		$this->createTime = $createTime;
	}

	public function getCreateTime()
	{
		return $this->createTime;
	}

	public function setDiscountCostMinimum($discountCostMinimum)
	{
		$this->discountCostMinimum = $discountCostMinimum;
	}

	public function getDiscountCostMinimum()
	{
		return $this->discountCostMinimum;
	}
}