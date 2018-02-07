<?php
/**
 * Created by iKNSA.
 * User: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 07/02/2018
 * Time: 01:05
 */


namespace PhpLight\AnalyticsBundle\Entity;


use PhpLight\Framework\Components\Model;

class Data extends Model
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var string
     */
    protected $currentUrl;

    /**
     * @var string
     */
    protected $currentHash;

    /**
     * @var string
     */
    protected $event;

    /**
     * @var array
     */
    protected $user;

    /**
     * @var array
     */
    protected $misc;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Data
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     * @return Data
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrentUrl()
    {
        return $this->currentUrl;
    }

    /**
     * @param string $currentUrl
     * @return Data
     */
    public function setCurrentUrl($currentUrl)
    {
        $this->currentUrl = $currentUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrentHash()
    {
        return $this->currentHash;
    }

    /**
     * @param string $currentHash
     * @return Data
     */
    public function setCurrentHash($currentHash)
    {
        $this->currentHash = $currentHash;
        return $this;
    }

    /**
     * @return string
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param string $event
     * @return Data
     */
    public function setEvent($event)
    {
        $this->event = $event;
        return $this;
    }

    /**
     * @return array
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param array $user
     * @return Data
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return array
     */
    public function getMisc()
    {
        return $this->misc;
    }

    /**
     * @param array $misc
     * @return Data
     */
    public function setMisc($misc)
    {
        $this->misc = $misc;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Data
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
