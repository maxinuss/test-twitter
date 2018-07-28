<?php
declare(strict_types=1);

namespace Tweets\Domain\Model\Tweet;

use Tweets\Domain\Exception\NotFoundException;
use Throwable;

class TweetNotFoundException extends \Exception implements NotFoundException
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $message = "Tweet not found";
        parent::__construct($message, $code, $previous);
    }
}
