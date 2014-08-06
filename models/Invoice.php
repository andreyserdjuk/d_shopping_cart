<?php

namespace models;

// TODO: think about unbound class for using d_shopping cart as module - ugly solution for projects without Doctrine
// TODO: think about creating of two entities - invoice of service and invoice of product

/**
 * @Entity
 * @Table(name="invoice", indexes={@index(name="search_idx", columns={"created_at", "updated_at"})})
 */
class Invoice extends Entity
{
	/**
	 * Operator, who created an invoice
	 *
	 * @ManyToOne(targetEntity="Person")
	 * @JoinColumn(name="operator_id", referencedColumnName="id")
	 **/
	protected $operator;
	
	/**
	 * @ManyToOne(targetEntity="Service")
	 * @JoinColumn(name="service_id", referencedColumnName="id")
	 **/
	protected $service;

	/**
	 * @ManyToOne(targetEntity="Product")
	 * @JoinColumn(name="product_id", referencedColumnName="id")
	 **/
	protected $product;

	/**
	 * @Column(type="float", name="service_quantity", unique=false, nullable=false)
	 */
	protected $serviceQuantity;
	
	/**
	 * @ManyToOne(targetEntity="Order")
	 * @JoinColumn(name="order_id", referencedColumnName="id")
	 **/
	protected $order;
	
	/**
	 * Calculated sum per unit of service
	 *
	 * @Column(type="decimal", name="sum", nullable=false, scale=3, precision=11)
	 */
	protected $sum;

	/**
	 * @ManyToOne(targetEntity="Discount")
	 * @JoinColumn(name="discount_id", referencedColumnName="id")
	 **/
	protected $discount;
	
	/**
	 * Total cost of all units of service
	 *
	 * @Column(type="decimal", name="sum_total", nullable=false, scale=2, precision=10)
	 */
	protected $sumTotal;
	
	/**
	 * @Column(type="decimal", name="sum_without_discount", nullable=false, scale=2, precision=10)
	 */
	protected $sumWithoutDiscount;

	/**
	 * @OneToMany(targetEntity="Payment", mappedBy="invoice")
	 */
	protected $payments;

	/**
	 * @Column(type="boolean", name="deleted", nullable=false)
	 */
	protected $deleted = FALSE;
	
	
    public function __construct()
    {
        $this->payments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getPayments()
    {
    	return $this->payments;
    }

    public function setPayment($payment)
    {
    	$this->payments[] = $payment;
    }
	
	public function setSumWithoutDiscount($sumWithoutDiscount)
	{
	   $this->sumWithoutDiscount = $sumWithoutDiscount;
	}

	public function getSumWithoutDiscount()
	{
	   return $this->sumWithoutDiscount;
	}

	public function setOperator($operator)
	{
	   $this->operator = $operator;
	}

	public function getOperator()
	{
	   return $this->operator;
	}

	public function setService($service)
	{
	   $this->service = $service;
	}

	public function getService()
	{
	   return $this->service;
	}

	public function setServiceQuantity($serviceQuantity)
	{
	   $this->serviceQuantity = $serviceQuantity;
	}

	public function getServiceQuantity()
	{
	   return $this->serviceQuantity;
	}

	public function setOrder($order)
	{
	   $this->order = $order;
	}

	public function getOrder()
	{
	   return $this->order;
	}

	public function setSum($sum)
	{
	   $this->sum = $sum;
	}

	public function getSum()
	{
	   return (double) $this->sum;
	}

	public function setDiscount($discount)
	{
	   $this->discount = $discount;
	}

	public function getDiscount()
	{
	   return $this->discount;
	}

	public function setSumTotal($sumTotal)
	{
	   $this->sumTotal = $sumTotal;
	}

	public function getSumTotal()
	{
	   return (double) $this->sumTotal;
	}
}