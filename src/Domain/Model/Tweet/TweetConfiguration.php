<?php

namespace Tweets\Domain\Model\Tweet;

class TweetConfiguration
{
    /**
     * @var int
     */
    protected $quantity;

    /**
     * TweetConfiguration constructor.
     * @param int $quantity
     */
    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getQuantity() : int
    {
        return $this->quantity;
    }
}