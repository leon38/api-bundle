<?php

namespace APIBundle\Document;

use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Statistic
 * @package APIBundle\Document
 *
 * @MongoDB\Document(repositoryClass="APIBundle\Repository\StatisticRepository")
 * @ORM\HasLifecycleCallbacks
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
    protected $version;

    /**
     * @var String $hit_type
     * @Assert\Choice(choices={"pageview", "screenview", "event"}, message="This hit type '{{ value }}' is not valid")
     * @MongoDB\Field(type="string")
     */
    protected $hit_type;

    /**
     * @var String $document_location
     * @Assert\Url(message="The current url {{ value }} is not a valid url")
     * @MongoDB\Field(type="string")
     */
    protected $document_location;


    /**
     * @var String $document_referrer
     * @Assert\Url(message="The referrer url {{ value }} is not a valid url")
     * @MongoDB\Field(type="string")
     */
    protected $document_referrer;


    /**
     * @var String $wiiz_creator_type
     * @Assert\Choice(choices={"profile", "recruiter", "visitor", "wizbii_employee"}, message="The creator type {{ value }} is not valid")
     * @MongoDB\Field(type="string")
     */
    protected $wiiz_creator_type;

    /**
     * @var String $wiiz_user_id
     * @MongoDB\Field(type="string")
     */
    protected $wiiz_user_id;

    /**
     * @var String $wiiz_unique_user_id
     * @Assert\NotBlank(message="The user id is mandatory")
     * @MongoDB\Field(type="string")
     */
    protected $wiiz_unique_user_id;

    /**
     * @var String $event_category
     * @MongoDB\Field(type="string")
     */
    protected $event_category;

    /**
     * @var String $event_action
     * @MongoDB\Field(type="string")
     */
    protected $event_action;

    /**
     * @var String $event_label
     * @MongoDB\Field(type="string")
     */
    protected $event_label;

    /**
     * @var int $event_value
     * @Assert\GreaterThanOrEqual(value=0)
     * @MongoDB\Field(type="int")
     */
    protected $event_value;

    /**
     * @var String $tracking_id
     * @Assert\NotBlank(message="The tracking id is mandatory")
     * @Assert\Regex("/UA-\w+-Y/", message="The tracking id is not valid")
     * @MongoDB\Field(type="string")
     */
    protected $tracking_id;

    /**
     * @var String $data_source
     * @Assert\NotBlank()
     * @Assert\Choice(choices={"web", "apps", "backend"})
     * @MongoDB\Field(type="string")
     */
    protected $data_source;


    /**
     * @var String $campaign_name
     * @MongoDB\Field(type="string")
     */
    protected $campaign_name;

    /**
     * @var String $campaign_source
     * @MongoDB\Field(type="string")
     */
    protected $campaign_source;

    /**
     * @var String $campaign_medium
     * @MongoDB\Field(type="string")
     */
    protected $campaign_medium;


    /**
     * @var String $campaign_keyword
     * @MongoDB\Field(type="string")
     */
    protected $campaign_keyword;

    /**
     * @var String $campaign_content
     * @MongoDB\Field(type="string")
     */
    protected $campaign_content;

    /**
     * @var String $screen_name
     * Les contraintes sont vérifiées dans le controller
     * @MongoDB\Field(type="string")
     */
    protected $screen_name;

    /**
     * @var String $application_name
     * Les contraintes sont vérifiées dans le controller
     * @MongoDB\Field(type="string")
     */
    protected $application_name;


    /**
     * @var String $application_version
     * @MongoDB\Field(type="string")
     */
    protected $application_version;

    /**
     * @var String $application_version
     * @Assert\GreaterThanOrEqual(value=0)
     * @MongoDB\Field(type="string")
     */
    protected $queue_time;

    /**
     * @var \DateTime $created
     * @MongoDB\Field(type="date")
     */
    protected $created;

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
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param int $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return String
     */
    public function getHitType()
    {
        return $this->hit_type;
    }

    /**
     * @param String $hit_type
     */
    public function setHitType($hit_type)
    {
        $this->hit_type = $hit_type;
    }

    /**
     * @return String
     */
    public function getDocumentLocation()
    {
        return $this->document_location;
    }

    /**
     * @param String $document_location
     */
    public function setDocumentLocation($document_location)
    {
        $this->document_location = $document_location;
    }

    /**
     * @return String
     */
    public function getDocumentReferrer()
    {
        return $this->document_referrer;
    }

    /**
     * @param String $document_referrer
     */
    public function setDocumentReferrer($document_referrer)
    {
        $this->document_referrer = $document_referrer;
    }

    /**
     * @return String
     */
    public function getWiizCreatorType()
    {
        return $this->wiiz_creator_type;
    }

    /**
     * @param String $wiiz_creator_type
     */
    public function setWiizCreatorType($wiiz_creator_type)
    {
        $this->wiiz_creator_type = $wiiz_creator_type;
    }

    /**
     * @return String
     */
    public function getWiizUserId()
    {
        return $this->wiiz_user_id;
    }

    /**
     * @param String $wiiz_user_id
     */
    public function setWiizUserId($wiiz_user_id)
    {
        $this->wiiz_user_id = $wiiz_user_id;
    }

    /**
     * @return String
     */
    public function getWiizUniqueUserId()
    {
        return $this->wiiz_unique_user_id;
    }

    /**
     * @param String $wiiz_unique_user_id
     */
    public function setWiizUniqueUserId($wiiz_unique_user_id)
    {
        $this->wiiz_unique_user_id = $wiiz_unique_user_id;
    }

    /**
     * @return String
     */
    public function getEventCategory()
    {
        return $this->event_category;
    }

    /**
     * @param String $event_category
     */
    public function setEventCategory($event_category)
    {
        $this->event_category = $event_category;
    }

    /**
     * @return String
     */
    public function getEventAction()
    {
        return $this->event_action;
    }

    /**
     * @param String $event_action
     */
    public function setEventAction($event_action)
    {
        $this->event_action = $event_action;
    }

    /**
     * @return String
     */
    public function getEventLabel()
    {
        return $this->event_label;
    }

    /**
     * @param String $event_label
     */
    public function setEventLabel($event_label)
    {
        $this->event_label = $event_label;
    }

    /**
     * @return int
     */
    public function getEventValue()
    {
        return $this->event_value;
    }

    /**
     * @param int $event_value
     */
    public function setEventValue($event_value)
    {
        $this->event_value = $event_value;
    }

    /**
     * @return String
     */
    public function getTrackingId()
    {
        return $this->tracking_id;
    }

    /**
     * @param String $tracking_id
     */
    public function setTrackingId($tracking_id)
    {
        $this->tracking_id = $tracking_id;
    }

    /**
     * @return String
     */
    public function getDataSource()
    {
        return $this->data_source;
    }

    /**
     * @param String $data_source
     */
    public function setDataSource($data_source)
    {
        $this->data_source = $data_source;
    }

    /**
     * @return String
     */
    public function getCampaignName()
    {
        return $this->campaign_name;
    }

    /**
     * @param String $campaign_name
     */
    public function setCampaignName($campaign_name)
    {
        $this->campaign_name = $campaign_name;
    }

    /**
     * @return String
     */
    public function getCampaignSource()
    {
        return $this->campaign_source;
    }

    /**
     * @param String $campaign_source
     */
    public function setCampaignSource($campaign_source)
    {
        $this->campaign_source = $campaign_source;
    }

    /**
     * @return String
     */
    public function getCampaignMedium()
    {
        return $this->campaign_medium;
    }

    /**
     * @param String $campaign_medium
     */
    public function setCampaignMedium($campaign_medium)
    {
        $this->campaign_medium = $campaign_medium;
    }

    /**
     * @return String
     */
    public function getCampaignKeyword()
    {
        return $this->campaign_keyword;
    }

    /**
     * @param String $campaign_keyword
     */
    public function setCampaignKeyword($campaign_keyword)
    {
        $this->campaign_keyword = $campaign_keyword;
    }

    /**
     * @return String
     */
    public function getCampaignContent()
    {
        return $this->campaign_content;
    }

    /**
     * @param String $campaign_content
     */
    public function setCampaignContent($campaign_content)
    {
        $this->campaign_content = $campaign_content;
    }

    /**
     * @return String
     */
    public function getScreenName()
    {
        return $this->screen_name;
    }

    /**
     * @param String $screen_name
     */
    public function setScreenName($screen_name)
    {
        $this->screen_name = $screen_name;
    }

    /**
     * @return String
     */
    public function getApplicationName()
    {
        return $this->application_name;
    }

    /**
     * @param String $application_name
     */
    public function setApplicationName($application_name)
    {
        $this->application_name = $application_name;
    }

    /**
     * @return String
     */
    public function getApplicationVersion()
    {
        return $this->application_version;
    }

    /**
     * @param String $application_version
     */
    public function setApplicationVersion($application_version)
    {
        $this->application_version = $application_version;
    }

    /**
     * @return String
     */
    public function getQueueTime()
    {
        return $this->queue_time;
    }

    /**
     * @param String $queue_time
     */
    public function setQueueTime($queue_time)
    {
        $this->queue_time = $queue_time;
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


    /** @ORM\PrePersist
     * @param LifecycleEventArgs $eventArgs
     */
    public function setCreatedValue(LifecycleEventArgs $eventArgs)
    {
        $this->created = date('Y-m-d H:i:s');
    }
}