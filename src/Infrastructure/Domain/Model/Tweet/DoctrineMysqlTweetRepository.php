<?php
declare(strict_types=1);

namespace Tweets\Infrastructure\Domain\Model\Tweet;

use Doctrine\DBAL\Exception\TableNotFoundException;
use Tweets\Domain\Model\Tweet\Tweet;
use Tweets\Domain\Model\Tweet\TweetRepository;
use Tweets\Infrastructure\Domain\Model\DoctrineMysqlRepository;

class DoctrineMysqlTweetRepository extends DoctrineMysqlRepository implements TweetRepository
{
    /**
     * @param Tweet $tweet
     */
    public function add(Tweet $tweet)
    {
        $this->em->persist($tweet);
    }

    /**
     * @param int $quantity
     * @return mixed
     */
    public function findLast(int $quantity = 10)
    {
        return $this->em->getRepository(Tweet::class)->findBy(array(), array('id' => 'DESC'), $quantity);
    }

}
