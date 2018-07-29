<?php
declare(strict_types=1);

namespace Tweets\Application\Service\Tweet;

use Tweets\Application\TimezoneHandler;
use Tweets\Domain\Model\Tweet\TweetRepository;
use Tweets\Domain\Model\Tweet\TweetConfiguration;
use Tweets\Infrastructure\Service\JsonTransformer;
use Tweets\Infrastructure\Transformer\InReplyTransformer;
use Tweets\Infrastructure\Transformer\TweetListTransformer;


class TweetListService
{
    /**
     * @var TweetRepository
     */
    private $tweetRepository;

    /**
     * @var TweetConfiguration
     */
    private $tweetConfiguration;

    /**
     * @var JsonTransformer
     */
    private $jsonTransformer;

    /**
     * TweetListService constructor.
     * @param TweetRepository $tweetRepository
     * @param TweetConfiguration $tweetConfiguration
     * @param JsonTransformer $jsonTransformer
     * @param TimezoneHandler $timezoneHandler
     */
    public function __construct(
        TweetRepository $tweetRepository,
        TweetConfiguration $tweetConfiguration,
        JsonTransformer $jsonTransformer,
        TimezoneHandler $timezoneHandler
    ) {
        $this->tweetRepository = $tweetRepository;
        $this->tweetConfiguration = $tweetConfiguration;
        $this->jsonTransformer = $jsonTransformer;
    }

    /**
     * @return array
     */
    public function execute()
    {
        $tweetsArray = [];

        try{
            $tweets = $this->tweetRepository->findLast($this->tweetConfiguration->getQuantity());

            foreach($tweets as $tweet){
                if(!empty($tweet->getInReply())) {
                    $tweetsArray[] = array_merge(
                        $this->jsonTransformer->formatItem($tweet, new TweetListTransformer()),
                        array('in_reply' => $this->jsonTransformer->formatItem($tweet, new InReplyTransformer()))
                    );
                } else {
                    $tweetsArray[] = $this->jsonTransformer->formatItem($tweet, new TweetListTransformer());
                }
            }
        }catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }

        return $tweetsArray;
    }
}
