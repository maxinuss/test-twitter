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
     * @param Tweet $category
     */
    public function add(Tweet $category)
    {
        $this->em->persist($category);
    }

    /**
     * @param $category
     * @return Tweet|null
     */
    public function findById($category)
    {
        return $this->em->find(Tweet::class, array('id' => $category));
    }

    /**
     * @param $active
     * @return Tweet|null
     */
    public function findAll($active)
    {
        if($active)
            return $this->em->getRepository(Tweet::class)->findBy(array('active' => 1), array('id' => 'DESC'));
        else
            return $this->em->getRepository(Tweet::class)->findBy(array(), array('id' => 'DESC'));
    }

}
