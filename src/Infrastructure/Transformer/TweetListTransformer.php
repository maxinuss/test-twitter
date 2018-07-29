<?php
declare(strict_types=1);

namespace Tweets\Infrastructure\Transformer;

use Tweets\Domain\Model\Tweet\Tweet;
use League\Fractal\TransformerAbstract;

class TweetListTransformer extends TransformerAbstract
{
    /**
     * @param Tweet $tweet
     * @return array
     */
    public function transform(Tweet $tweet)
    {
        return [
            'created_at' => $tweet->getFormattedCreatedAt('D M d H:i:s O Y'),
            'text' => $tweet->getText()
        ];
    }
}


