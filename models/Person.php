<?php

namespace models;

/**
 * @Entity
 * @Table(name="person", indexes={@index(name="search_idx", columns={"created_at", "updated_at"})})
 */
class Person extends Entity
{
	const API_KEY_EMAIL = 'email';
	const API_KEY_PASSWORD = 'password';
	const API_KEY_PHONE = 'phone';
	const API_KEY_FIRST_NAME = 'first_name';
	const API_KEY_LAST_NAME = 'last_name';
	const API_KEY_MIDDLE_NAME = 'middle_name';
	const API_KEY_PASSPORT_CODE = "passport_code";
	const API_KEY_PASSPORT_NUMBER = "passport_number";
	const API_KEY_BONUS_CARD = "bonus_card";
	const API_KEY_BONUS_CARD_ID = "bonus_card_id";
	const API_KEY_COMPANIES = "companies";
	const API_KEY_COMMENTS = "comments";
	const API_KEY_ROLE = "role";


	/**
	* @Column(type="string", length=32, nullable=false)
	*/
	protected $password='';
	
	/**
	* @Column(type="string", length=255, nullable=false)
	*/
	protected $email;
	
	/**
	 * @ManyToOne(targetEntity="Role")
	 * @JoinColumn(name="role_id", referencedColumnName="id")
	 **/
	protected $role;

	/**
	 * @ManyToOne(targetEntity="EntityStatus")
	 * @JoinColumn(name="entity_status_id", referencedColumnName="id")
	 **/
	protected $entityStatus;

	/**
	 * @Column(type="string", name="last_name", length=60, unique=false, nullable=true)
	 */
	protected $lastName;
	
	/**
	 * @Column(type="string", name="first_name", length=60, unique=false, nullable=true)
	 */
	protected $firstName;
	
	/**
	 * @Column(type="string", name="middle_name", length=60, unique=false, nullable=true)
	 */
	protected $middleName;

	/**
	 * @Column(type="string", name="phone_international_index", length=4, unique=false, nullable=true)
	 */
	protected $phoneInternationalIndex = "+38";

	/**
	 * @Column(type="string", name="phone", length=11, unique=false, nullable=true)
	 */
	protected $phone;
	
	/**
	 * @Column(type="string", name="passport_code", length=6, unique=false, nullable=true)
	 */
	protected $passportCode;

	/**
	 * @Column(type="string", name="passport_number", length=32, unique=false, nullable=true)
	 */
	protected $passportNumber;
	
	/**
	 * @OneToOne(targetEntity="Bonus", mappedBy="person")
	 **/
	private $bonusCard;

	/**
	 * @OneToMany(targetEntity="AssocCompaniesPersons", mappedBy="person")
	 **/
	protected $assocCompaniesPersons;

	/**
	 * @Column(type="string", name="person_type", length=45, unique=false, nullable=true)
	 */
	protected $personType = 1;

	/**
	 * @Column(type="string", name="comments", length=500, unique=false, nullable=true)
	 */
	protected $comments;

	/**
	 * @Column(type="boolean", name="deleted", nullable=false)
	 */
	protected $deleted = FALSE;


	public function __construct()
	{
		$this->companies = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
	public function getId()
	{
		return $this->id;
	}

	public function setAssocCompanyPerson($assocCompanyPerson)
	{
		$this->assocCompaniesPersons[] = $assocCompanyPerson;
	}

	public function getAssocCompaniesPersons()
	{
		return $this->assocCompaniesPersons;
	}

	public function getCompanies()
	{
		return $this->companies->filter(function($company){
			return $company->getDeleted() == FALSE;
		});
	}
	
	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setRole($role)
	{
		$this->role = $role;
	}

	public function getRole()
	{
		return $this->role;
	}

	public function setFirstName($first_namerstName)
	{
		$this->firstName = $firstName;
	}

	public function getFirstName()
	{
		return $this->firstName;
	}

	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
	}

	public function getLastName()
	{
		return $this->lastName;
	}

	public function setMiddleName($middleName)
	{
		$this->middleName = $middleName;
	}

	public function getMiddleName()
	{
		return $this->middleName;
	}

	public function setPhoneInternationalIndex($phoneInternationalIndex)
	{
		$this->phoneInternationalIndex = $phoneInternationalIndex;
	}

	public function getPhoneInternationalIndex()
	{
		return $this->phoneInternationalIndex;
	}

	public function setPhone($phone)
	{
		$this->phone = $phone;
	}

	public function getPhone()
	{
		return $this->phone;
	}

	public function setPassportCode($passportCode)
	{
		$this->passportCode = $passportCode;
	}

	public function getPassportCode()
	{
		return $this->passportCode;
	}

	public function setPassportNumber($passportNumber)
	{
		$this->passportNumber = $passportNumber;
	}

	public function getPassportNumber()
	{
		return $this->passportNumber;
	}

	public function setBonusCard($bonusCard)
	{
		$this->bonusCard = $bonusCard;
	}

	public function getBonusCard()
	{
		return $this->bonusCard;
	}

	public function setPersonType($personType)
	{
		$this->personType = $personType;
	}

	public function getPersonType()
	{
		return $this->personType;
	}

	public function setComments($comments)
	{
		$this->comments = $comments;
	}

	public function getComments()
	{
		return $this->comments;
	}
}
