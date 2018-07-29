<?php
declare(strict_types=1);

namespace Tests\Unit\User;

use Mockery;

use League\Fractal\Manager;
use Tweets\Domain\Model\Tweet\Tweet;
use Tweets\Infrastructure\Service\JsonTransformer;
use League\Fractal\Serializer\DataArraySerializer;
use Tweets\Application\Service\Tweet\TweetListService;

class TweetListServiceTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function testTweetClass()
    {
        $tweet = new Tweet();
        $tweet->setCreatedAt(1532567854);
        $tweet->setText('This is the first Tweet');
        $tweet->setUserName('Peter');

        $this->assertInstanceOf('Tweets\Domain\Model\Tweet\Tweet', $tweet);

        $tweet2 = new Tweet();
        $tweet2->setCreatedAt(1532527854);
        $tweet2->setText('This is the second Tweet');
        $tweet2->setUserName('John Doe');
        $tweet2->setInReply($tweet);

        $this->assertInstanceOf('Tweets\Domain\Model\Tweet\Tweet', $tweet2);
    }

    /** @test */
    public function testTweetListService()
    {
        $tweet = new Tweet();
        $tweet->setCreatedAt(1532567854);
        $tweet->setText('This is the first Tweet');
        $tweet->setUserName('Peter');

        $tweetId = '1';

        $mockTweet = Mockery::mock('Tweets\Domain\Model\Tweet\Tweet');
        $mockTweet->shouldReceive([])->once();
        $mockTweet->shouldReceive('getInReply')->andReturn($tweet->getInReply());
        $mockTweet->shouldReceive('getCreatedAt')->andReturn($tweet->getCreatedAt());
        $mockTweet->shouldReceive('getFormattedCreatedAt')->andReturn($tweet->getFormattedCreatedAt('D M d H:i:s O Y'));
        $mockTweet->shouldReceive('getText')->andReturn($tweet->getText());

        $mockEntityManager = Mockery::mock('Doctrine\ORM\EntityManager');
        $mockEntityManager->shouldReceive('getReference')->with("Tweets\Domain\Model\Tweet\Tweet", $tweetId)->andReturn($mockTweet);

        $mockTweetRepository = Mockery::mock('Tweets\Infrastructure\Domain\Model\Tweet\DoctrineMysqlTweetRepository');
        $mockTweetRepository->shouldReceive([$mockEntityManager]);
        $mockTweetRepository->shouldReceive('findLast')->andReturn([$mockTweet]);

        $mockTweetConfiguration = Mockery::mock('Tweets\Domain\Model\Tweet\TweetConfiguration');
        $mockTweetConfiguration->shouldReceive('getQuantity')->andReturn(10);

        $mockTimezone = Mockery::mock('Tweets\Application\TimezoneHandler');
        $mockTimezone->shouldReceive(['GTM+0']);

        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());
        $tweetListService = new TweetListService($mockTweetRepository, $mockTweetConfiguration, new JsonTransformer($manager), $mockTimezone);

        $this->assertSame('This is the first Tweet', $tweetListService->execute()[0]['text']);
    }

    public function tearDown() {
        Mockery::close();
    }
}
