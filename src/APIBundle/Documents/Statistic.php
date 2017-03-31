<?php

namespace APIBundle\Documents;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Statistic
 * @package APIBundle\Documents
 *
 * @MongoDB\Document
 */
class Statistic
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @var int $version
     * @Assert\NotBlank(message="La version de l'api est obligatoire")
     * @Assert\EqualTo(value=1, message="Le numéro de version n'existe pas")
     * @MongoDB\Field(type="int")
     */
    protected $version;

    /**
     * @var String $hit_type
     * @Assert\Choice(choices={"pageview", "screenview", "event"}, message="Le hit type {{ value }} n'est pas valide")
     * @MongoDB\Field(type="string")
     */
    protected $hit_type;

    /**
     * @var String $document_location
     * @Assert\Url(message="L'url '{{ value }}' de la page courante n'est pas valide")
     * @MongoDB\Field(type="String")
     */
    protected $document_location;


    /**
     * @var String $document_referrer
     * @Assert\Url(message="L'url '{{ value }}' n'est pas valide")
     * @MongoDB\Field(type="String")
     */
    protected $document_referrer;


    /**
     * @var String $wiiz_creator_type
     * @Assert\NotBlank(message="Le profile est obligatoire")
     * @Assert\Choice(choices={"profile", "recruiter", "visitor", "wizbii_employee"}, message="Le créateur {{ value }} n'est pas valide")
     * @MongoDB\Field(type="string")
     */
    protected $wiiz_creator_type;

    /**
     * @var String $wiiz_user_id
     * @Assert\NotBlank(message="L'alias du visiteur est obligatoire")
     * @MongoDB\Field(type="string")
     */
    protected $wiiz_user_id;

    /**
     * @var String $wiiz_unique_user_id
     * @Assert\NotBlank(message="L'identifiant de l'utilisateur est obligatoire")
     * @MongoDB\Field(type="int")
     */
    protected $wiiz_unique_user_id;

    /**
     * @var String $event_category
     * @Assert\NotBlank(message="La catégorie de l'évènement ne doit pas être vide")
     */
    protected $event_category;

    /**
     * @var
     */
    protected $event_action;

}