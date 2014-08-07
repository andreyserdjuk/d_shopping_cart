<?php

namespace models;

// TODO: think about unbound class for using d_shopping cart as module - ugly solution for projects without Doctrine

/**
 * @Entity
 * @Table(name="order", indexes={@index(name="search_idx", columns={"created_at", "updated_at"})})
 */
class Order extends Entity
{
	const API_KEY_PRODUCT_TYPE_ID = "product_type_id";
	const API_KEY_PRODUCT_TYPE = "product_type";
	const API_KEY_DESCRIPTION = "description";
	const API_KEY_OPERATOR_ID = "operator_id";
	const API_KEY_STATUS_ID = "status_id";
	const API_KEY_COMPANY_ID = "company_id";
	const API_KEY_PERSON_ID = "person_id";


	/**
	 * Sales manager or administrator, who created an order
	 *
	 * @ManyToOne(targetEntity="Person")
	 * @JoinColumn(name="operator_id", referencedColumnName="id")
	 **/
	protected $operator;
	
	/**
	 * Person as customer
	 *
	 * @ManyToOne(targetEntity="Person")
	 * @JoinColumn(name="person_id", referencedColumnName="id")
	 **/
	protected $customerPerson;
	
	/**
	 * Company as customer
	 *
	 * @ManyToOne(targetEntity="Company")
	 * @JoinColumn(name="company_id", referencedColumnName="id")
	 **/
	protected $customerCompany;
	
	/**
	 * @ManyToOne(targetEntity="ProductDescription")
	 * @JoinColumn(name="description_id", referencedColumnName="id")
	 */
	protected $description;

	/**
	 * @ManyToOne(targetEntity="Discount")
	 * @JoinColumn(name="discount_id", referencedColumnName="id")
	 */
	protected $discount;

	/**
	 * @ManyToOne(targetEntity="OrderStatus")
	 * @JoinColumn(name="order_status_id", referencedColumnName="id")
	 **/
	protected $status;

	/**
	 * @OneToMany(targetEntity="Invoice", mappedBy="product")
	 **/
	private $invoices;

	
	public function __construct()
	{
		$this->invoices = new \Doctrine\Common\Collections\ArrayCollection();
	}

	public function getInvoices()
	{
		return $this->invoices->filter(function($invoice){
			return $invoice->getDeleted() == FALSE;
		});
	}
	
	public function setInvoice($invoice)
	{
		$this->invoices[] = $invoice;
	}

	public function setDescription(\models\ProductDescription $description)
	{
		$this->description = $description;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setStatus($status)
	{
		$this->status = $status;
	}

	public function getStatus()
	{
		return $this->status;
	}

	// TODO:
	// public function calculatePaidSum()
	// {   
		// $q = $em->createQuery("select sum(p.sum) from models\Payment p join p.invoice i where i.product = :product");
		// $q->setParameter('product', $this->getId());
		// return intval($q->getSingleScalarResult());
	// }

	// public function calculateNeededSum()
	// {   
		// $q = $em->createQuery("SELECT sum(i.sumTotal) FROM models\Invoice i WHERE i.product = :product AND i.deleted = 0");
		// $q->setParameter('product', $this->getId());
		// return $q->getSingleScalarResult();
	// }
}