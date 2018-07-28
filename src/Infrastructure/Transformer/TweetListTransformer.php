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
            'created_at' => $tweet->getCreatedAt()->format('d/m/Y'),
            'text' => $tweet->getText()
        ];
    }
}
