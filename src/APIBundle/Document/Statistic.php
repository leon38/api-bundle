<?php

namespace APIBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\HasLifecycleCallbacks;
use Doctrine\ODM\MongoDB\Mapping\Annotations\PrePersist;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Statistic
 * @package APIBundle\Document
 *
 * @MongoDB\Document()
 * @HasLifecycleCallbacks
 * @Assert\Callback({"APIBundle\Validator\StatisticValidator", "validate"})
 */
class Statistic
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @var int $version
     * @Assert\NotBlank(message="The API version is mandatory")
     * @Assert\EqualTo(value=1, message="This API Version number does not exist")
     * @MongoDB\Field(type="int")
     */
    protected $v;

    /**
     * @var String $hit_type
     * @Assert\Choice(choices={"pageview", "screenview", "event"}, message="This hit type '{{ value }}' is not valid")
     * @MongoDB\Field(type="string")
     */
    protected $t;

    /**
     * @var String $document_location
     * @Assert\Url(message="The current url {{ value }} is not a valid url")
     * @MongoDB\Field(type="string")
     */
    protected $dl;


    /**
     * @var String $document_referrer
     * @Assert\Url(message="The referrer url {{ value }} is not a valid url")
     * @MongoDB\Field(type="string")
     */
    protected $dr;


    /**
     * @var String $wiiz_creator_type
     * @Assert\Choice(choices={"profile", "recruiter", "visitor", "wizbii_employee"}, message="The creator type {{ value }} is not valid")
     * @MongoDB\Field(type="string")
     */
    protected $wct;

    /**
     * @var String $wiiz_user_id
     * @MongoDB\Field(type="string")
     */
    protected $wui;

    /**
     * @var String $wiiz_unique_user_id
     * @Assert\NotBlank(message="The user id is mandatory")
     * @MongoDB\Field(type="string")
     */
    protected $wuui;

    /**
     * @var String $event_category
     * @MongoDB\Field(type="string")
     */
    protected $ec;

    /**
     * @var String $event_action
     * @MongoDB\Field(type="string")
     */
    protected $ea;

    /**
     * @var String $event_label
     * @MongoDB\Field(type="string")
     */
    protected $el;

    /**
     * @var int $event_value
     * @Assert\GreaterThanOrEqual(value=0)
     * @MongoDB\Field(type="int")
     */
    protected $ev;

    /**
     * @var String $tracking_id
     * @Assert\NotBlank(message="The tracking id is mandatory")
     * @Assert\Regex("/UA-\w+-Y/", message="The tracking id is not valid")
     * @MongoDB\Field(type="string")
     */
    protected $tid;

    /**
     * @var String $data_source
     * @Assert\NotBlank()
     * @Assert\Choice(choices={"web", "apps", "backend"})
     * @MongoDB\Field(type="string")
     */
    protected $ds;


    /**
     * @var String $campaign_name
     * @MongoDB\Field(type="string")
     */
    protected $cn;

    /**
     * @var String $campaign_source
     * @MongoDB\Field(type="string")
     */
    protected $cs;

    /**
     * @var String $campaign_medium
     * @MongoDB\Field(type="string")
     */
    protected $cm;


    /**
     * @var String $campaign_keyword
     * @MongoDB\Field(type="string")
     */
    protected $ck;

    /**
     * @var String $campaign_content
     * @MongoDB\Field(type="string")
     */
    protected $cc;

    /**
     * @var String $screen_name
     * Les contraintes sont vérifiées dans le controller
     * @MongoDB\Field(type="string")
     */
    protected $sn;

    /**
     * @var String $application_name
     * Les contraintes sont vérifiées dans le controller
     * @MongoDB\Field(type="string")
     */
    protected $an;


    /**
     * @var String $application_version
     * @MongoDB\Field(type="string")
     */
    protected $av;

    /**
     * @var String $application_version
     * @Assert\GreaterThanOrEqual(value=0)
     * @MongoDB\Field(type="string")
     */
    protected $qt;

    /**
     * @var \DateTime $created
     * @MongoDB\Field(type="date")
     */
    protected $created;


    protected $cookies;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getV()
    {
        return $this->v;
    }

    /**
     * @param int $v
     */
    public function setV($v)
    {
        $this->v = $v;
    }

    /**
     * @return String
     */
    public function getT()
    {
        return $this->t;
    }

    /**
     * @param String $t
     */
    public function setT($t)
    {
        $this->t = $t;
    }

    /**
     * @return String
     */
    public function getDl()
    {
        return $this->dl;
    }

    /**
     * @param String $dl
     */
    public function setDl($dl)
    {
        $this->dl = $dl;
    }

    /**
     * @return String
     */
    public function getDr()
    {
        return $this->dr;
    }

    /**
     * @param String $dr
     */
    public function setDr($dr)
    {
        $this->dr = $dr;
    }

    /**
     * @return String
     */
    public function getWct()
    {
        return $this->wct;
    }

    /**
     * @param String $wct
     */
    public function setWct($wct)
    {
        $this->wct = $wct;
    }

    /**
     * @return String
     */
    public function getWui()
    {
        return $this->wui;
    }

    /**
     * @param String $wui
     */
    public function setWui($wui)
    {
        $this->wui = $wui;
    }

    /**
     * @return String
     */
    public function getWuui()
    {
        return $this->wuui;
    }

    /**
     * @param String $wuui
     */
    public function setWuui($wuui)
    {
        $this->wuui = $wuui;
    }

    /**
     * @return String
     */
    public function getEc()
    {
        return $this->ec;
    }

    /**
     * @param String $ec
     */
    public function setEc($ec)
    {
        $this->ec = $ec;
    }

    /**
     * @return String
     */
    public function getEa()
    {
        return $this->ea;
    }

    /**
     * @param String $ea
     */
    public function setEa($ea)
    {
        $this->ea = $ea;
    }

    /**
     * @return String
     */
    public function getEl()
    {
        return $this->el;
    }

    /**
     * @param String $el
     */
    public function setEl($el)
    {
        $this->el = $el;
    }

    /**
     * @return int
     */
    public function getEv()
    {
        return $this->ev;
    }

    /**
     * @param int $ev
     */
    public function setEv($ev)
    {
        $this->ev = $ev;
    }

    /**
     * @return String
     */
    public function getTid()
    {
        return $this->tid;
    }

    /**
     * @param String $tid
     */
    public function setTid($tid)
    {
        $this->tid = $tid;
    }

    /**
     * @return String
     */
    public function getDs()
    {
        return $this->ds;
    }

    /**
     * @param String $ds
     */
    public function setDs($ds)
    {
        $this->ds = $ds;
    }

    /**
     * @return String
     */
    public function getCn()
    {
        return $this->cn;
    }

    /**
     * @param String $cn
     */
    public function setCn($cn)
    {
        $this->cn = $cn;
    }

    /**
     * @return String
     */
    public function getCs()
    {
        return $this->cs;
    }

    /**
     * @param String $cs
     */
    public function setCs($cs)
    {
        $this->cs = $cs;
    }

    /**
     * @return String
     */
    public function getCm()
    {
        return $this->cm;
    }

    /**
     * @param String $cm
     */
    public function setCm($cm)
    {
        $this->cm = $cm;
    }

    /**
     * @return String
     */
    public function getCk()
    {
        return $this->ck;
    }

    /**
     * @param String $ck
     */
    public function setCk($ck)
    {
        $this->ck = $ck;
    }

    /**
     * @return String
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @param String $cc
     */
    public function setCc($cc)
    {
        $this->cc = $cc;
    }

    /**
     * @return String
     */
    public function getSn()
    {
        return $this->sn;
    }

    /**
     * @param String $sn
     */
    public function setSn($sn)
    {
        $this->sn = $sn;
    }

    /**
     * @return String
     */
    public function getAn()
    {
        return $this->an;
    }

    /**
     * @param String $an
     */
    public function setAn($an)
    {
        $this->an = $an;
    }

    /**
     * @return String
     */
    public function getAv()
    {
        return $this->av;
    }

    /**
     * @param String $av
     */
    public function setAv($av)
    {
        $this->av = $av;
    }

    /**
     * @return String
     */
    public function getQt()
    {
        return $this->qt;
    }

    /**
     * @param String $qt
     */
    public function setQt($qt)
    {
        $this->qt = $qt;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }


    /**
     * @PrePersist
     */
    public function setCreatedValue()
    {
        $this->created = date('Y-m-d H:i:s');
    }

    /**
     * @return mixed
     */
    public function getCookies()
    {
        return $this->cookies;
    }

    /**
     * @param mixed $cookies
     */
    public function setCookies($cookies)
    {
        $this->cookies = $cookies;
    }


    public function __set($name, $value)
    {
        $this->{"set".ucfirst($name)}($value);
    }
}