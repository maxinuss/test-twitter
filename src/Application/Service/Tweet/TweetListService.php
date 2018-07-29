<?php
declare(strict_types=1);

namespace Tweets\Application\Service\Tweet;

use Tweets\Domain\Model\Tweet\Tweet;
use Tweets\Domain\Model\Tweet\TweetRepository;

use Tweets\Infrastructure\Service\JsonTransformer;
use Tweets\Infrastructure\Transformer\TweetListTransformer;
use Tweets\Infrastructure\Transformer\InReplyTransformer;

class TweetListService
{
    /**
     * @var TweetRepository
     */
    private $tweetRepository;

    /**
     * @var JsonTransformer
     */
    private $jsonTransformer;

    /**
     * TweetListService constructor.
     * @param TweetRepository $tweetRepository
     * @param JsonTransformer $jsonTransformer
     */
    public function __construct(
        TweetRepository $tweetRepository,
        JsonTransformer $jsonTransformer
    ) {
        $this->tweetRepository = $tweetRepository;
        $this->jsonTransformer = $jsonTransformer;
    }

    /**
     * @return array
     */
    public function execute()
    {
        $tweetsArray = [];

        try{
            $tweets = $this->tweetRepository->findLast(10);

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
