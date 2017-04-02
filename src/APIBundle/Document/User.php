<?php
/**
 * Created by PhpStorm.
 * User: damiencorona
 * Date: 02/04/2017
 * Time: 19:17
 */

namespace APIBundle\Document;

/**
 * Class Statistic
 * @package APIBundle\Document
 *
 * @MongoDB\Document()
 */
class User
{

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @var String $firstname
     * @Assert\NotBlank(message="The firstname is mandatory")
     * @MongoDB\Field(type="string")
     */
    protected $firstname;


    /**
     * @var String $lastname
     * @Assert\NotBlank(message="The lastname is mandatory")
     * @MongoDB\Field(type="string")
     */
    protected $lastname;


    /**
     * @var string $wui
     * @Assert\NotBlank(message="The Wui is mandatory")
     * @MongoDB\Field(type="string")
     */
    protected $wui;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param String $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return String
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param String $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getWui()
    {
        return $this->wui;
    }

    /**
     * @param string $wui
     */
    public function setWui($wui)
    {
        $this->wui = $wui;
    }
}