<?php

namespace App\Entity;

use App\Entity\Property;
use Symfony\Component\Validator\Constraints as Assert;

class Contact
{

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
     private $firstName;

     /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
     private $lastName;

    /**
     * @var Property|null
     */
     private $property;

     /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
     private $email;

      /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=15)
     */
     private $phone;

     /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
     private $message;

    //SETTERS
    public function setFirstName($firstname): Contact
    {
        $this->firstName = $firstname;
        return $this;
    }

    public function setLastName($lastname): Contact
    {
        $this->lastName = $lastname;
        return $this;
    }

    public function setProperty($property): Contact
    {
        $this->property = $property;
        return $this;
    }

    public function setPhone($phone): Contact
    {
        $this->phone = $phone;
        return $this;
    }

    public function setEmail($email): Contact
    {
        $this->email = $email;
        return $this;
    }

    public function setMessage($message): Contact
    {
        $this->message = $message;
        return $this;
    }

    //GETTERS
    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getProperty()
    {
        return $this->property ;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getMessage()
    {
        return $this->message;
    }
}