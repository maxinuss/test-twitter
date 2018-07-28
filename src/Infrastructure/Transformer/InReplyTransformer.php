<?php
declare(strict_types=1);

namespace Tweets\Infrastructure\Transformer;

use Tweets\Domain\Model\Tweet\Tweet;
use League\Fractal\TransformerAbstract;

class InReplyTransformer extends TransformerAbstract
{
    /**
     * @param Tweet $tweet
     * @return array
     */
    public function transform(Tweet $tweet)
    {
        return [
            'id' => $tweet->getId(),
            'name' => $tweet->getuserName()
        ];
    }
}
