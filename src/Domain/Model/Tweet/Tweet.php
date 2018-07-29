<?php

namespace Tweets\Domain\Model\Tweet;

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
     * @var string
     */
    private $userName;

    /**
     * @var int
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
     * @return int
     */
    public function getCreatedAt() : int
    {
        return $this->createdAt;
    }

    /**
     * @param string $format
     * @return string
     */
    public function getFormattedCreatedAt(string $format) : string
    {
        return date($format, $this->createdAt);
    }

    /**
     * @param int $createdAt
     * @return Tweet
     */
    public function setCreatedAt(int $createdAt) : Tweet
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
     * @return string
     */
    public function getUserName() : string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     * @return Tweet
     */
    public function setUserName(string $userName) : Tweet
    {
        $this->userName = $userName;
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

