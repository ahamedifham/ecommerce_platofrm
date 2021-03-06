<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Buyer
 *
 * @ORM\Table(name="buyer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BuyerRepository")
 */
class Buyer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Member")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     */
    private $member;

    /**
     * @var string
     * @Assert\NotBlank(message="not_blank")
     * @ORM\Column(name="first_name", type="string", length=50)
     */
    private $firstName;

    /**
     * @var string
     * @Assert\NotBlank(message="not_blank")
     * @ORM\Column(name="surname", type="string", length=100)
     */
    private $surname;

    /**
     * @var boolean
     *
     * @ORM\Column(name="gender", type="boolean", nullable=false)
     */
    private $gender;

    /**
     * @var Date
     * @Assert\NotBlank(message="not_blank")
     * @ORM\Column(name="date_of_birth", type="date",  nullable=false)
     */
    private $dateOfBirth;

    /**
     * @var string
     * @Assert\NotBlank(message="not_blank")
     * @ORM\Column(name="nationality", type="string", length=100)
     */
    private $nationality;

    /**
     * @var string
     * @Assert\NotBlank(message="not_blank")
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;


    /**
     * @var string
     * @Assert\NotBlank(message="not_blank")
     * @ORM\Column(name="physical_address", type="string", length=255)
     */
    private $physicalAddress;

    /**
     * @var string
     * @Assert\NotBlank(message="not_blank")
     * @ORM\Column(name="BSB_number", type="string", length=255)
     */
    private $BSBNumber;
    
    /**
     * @var string
     * @Assert\NotBlank(message="not_blank")
     * @ORM\Column(name="account_number", type="string", length=255)
     */
    private $accountNUmber;

    /**
     * @var string
     * @Assert\NotBlank(message="not_blank")
     * @ORM\Column(name="account_name", type="string", length=255)
     */
    private $accountName;

    /**
     * @var string
     * @Assert\NotBlank(message="not_blank")
     * @ORM\Column(name="financial_institute_name", type="string", length=255)
     */
    private $financialInstituteName;

    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set member
     *
     * @param Member $member
     * @return Buyer
     */
    public function setMember($member)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get member
     *
     * @return Member
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Buyer
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return Buyer
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }



    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     * @return Buyer
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime 
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set nationality
     *
     * @param string $nationality
     * @return Buyer
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get nationality
     *
     * @return string 
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Buyer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set physicalAddress
     *
     * @param string $physicalAddress
     * @return Buyer
     */
    public function setPhysicalAddress($physicalAddress)
    {
        $this->physicalAddress = $physicalAddress;

        return $this;
    }

    /**
     * Get physicalAddress
     *
     * @return string 
     */
    public function getPhysicalAddress()
    {
        return $this->physicalAddress;
    }

    /**
     * Set BSBNumber
     *
     * @param string $bSBNumber
     * @return Buyer
     */
    public function setBSBNumber($bSBNumber)
    {
        $this->BSBNumber = $bSBNumber;

        return $this;
    }

    /**
     * Get BSBNumber
     *
     * @return string 
     */
    public function getBSBNumber()
    {
        return $this->BSBNumber;
    }

    /**
     * Set accountNUmber
     *
     * @param string $accountNUmber
     * @return Buyer
     */
    public function setAccountNUmber($accountNUmber)
    {
        $this->accountNUmber = $accountNUmber;

        return $this;
    }

    /**
     * Get accountNUmber
     *
     * @return string 
     */
    public function getAccountNUmber()
    {
        return $this->accountNUmber;
    }

    /**
     * Set accountName
     *
     * @param string $accountName
     * @return Buyer
     */
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;

        return $this;
    }

    /**
     * Get accountName
     *
     * @return string 
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * Set financialInstituteName
     *
     * @param string $financialInstituteName
     * @return Buyer
     */
    public function setFinancialInstituteName($financialInstituteName)
    {
        $this->financialInstituteName = $financialInstituteName;

        return $this;
    }

    /**
     * Get financialInstituteName
     *
     * @return string 
     */
    public function getFinancialInstituteName()
    {
        return $this->financialInstituteName;
    }

    /**
     * Set gender
     *
     * @param boolean $gender
     * @return Buyer
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return boolean 
     */
    public function getGender()
    {
        return $this->gender;
    }
}
