<?php
declare(strict_types=1);

namespace Tweets\Domain\Model\Tweet;

interface TweetRepository
{
    /**
     * @param Tweet $tweet
     */
    public function add(Tweet $tweet);

    /**
     * @param int $quantity
     * @return mixed
     */
    public function findLast(int $quantity);
}
