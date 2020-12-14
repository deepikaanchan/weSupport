<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TicketCreationCallLogs
 *
 * @ORM\Table(name="ticket_creation_call_logs")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TicketCreationCallLogsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class TicketCreationCallLogs
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
     * @var string
     *
     * @ORM\Column(name="api_request", type="text")
     */
    private $apiRequest;

    /**
     * @var string
     *
     * @ORM\Column(name="api_response", type="text", nullable = true)
     */
    private $apiResponse;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Users",fetch="EAGER")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable = true,options={"comment":"1- success ,2 - error"})
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable = true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable = true)
     */
    private $updatedAt;



    /**
     *
     * Action to be taken before persist
     * @ORM\PrePersist
     *
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     *
     * Action to be taken before update
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set apiRequest
     *
     * @param string $apiRequest
     *
     * @return TicketCreationCallLogs
     */
    public function setApiRequest($apiRequest)
    {
        $this->apiRequest = $apiRequest;

        return $this;
    }

    /**
     * Get apiRequest
     *
     * @return string
     */
    public function getApiRequest()
    {
        return $this->apiRequest;
    }

    /**
     * Set apiResponse
     *
     * @param string $apiResponse
     *
     * @return TicketCreationCallLogs
     */
    public function setApiResponse($apiResponse)
    {
        $this->apiResponse = $apiResponse;

        return $this;
    }

    /**
     * Get apiResponse
     *
     * @return string
     */
    public function getApiResponse()
    {
        return $this->apiResponse;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return TicketCreationCallLogs
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }


    
     /**
     * Set status
     *
     * @param integer $status
     *
     * @return TicketCreationCallLogs
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return TicketCreationCallLogs
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return TicketCreationCallLogs
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}

