<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RequestStructure
 *
 * @ORM\Table(name="request_structure")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RequestStructureRepository")
 */
class RequestStructure
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
     * @ORM\Column(name="request_structure", type="text")
     */
    private $requestStructure;

    /**
     * @var string
     *
     * @ORM\Column(name="request_key", type="string", length=50)
     */
    private $requestKey;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set requestStructure
     *
     * @param string $requestStructure
     *
     * @return RequestStructure
     */
    public function setRequestStructure($requestStructure)
    {
        $this->requestStructure = $requestStructure;

        return $this;
    }

    /**
     * Get requestStructure
     *
     * @return string
     */
    public function getRequestStructure()
    {
        return $this->requestStructure;
    }

    /**
     * Set requestKey
     *
     * @param string $requestKey
     *
     * @return RequestStructure
     */
    public function setRequestKey($requestKey)
    {
        $this->requestKey = $requestKey;

        return $this;
    }

    /**
     * Get requestKey
     *
     * @return string
     */
    public function getRequestKey()
    {
        return $this->requestKey;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return RequestStructure
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
     * @return RequestStructure
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

