<?php

namespace Tweets\Domain\Model\Tweet;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

/**
 * Category
 */
class Tweet
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $text;

    /**
     * @var Tweet
     */
    private $inReply;

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Tweet
     */
    public function setCreatedAt(\DateTime $createdAt) : Tweet
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getText() : string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Tweet
     */
    public function setText(string $text) : Tweet
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return null|Tweet
     */
    public function getInReply() : ?Tweet
    {
        return $this->inReply;
    }

    /**
     * @param Tweet $inReply
     * @return Tweet
     */
    public function setInReply(Tweet $inReply) : Tweet
    {
        $this->inReply = $inReply;
        return $this;
    }
}
