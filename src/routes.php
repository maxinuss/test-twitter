<?php
declare(strict_types=1);

use Tweets\Application\Action\Tweet\TweetList;

$app->get('/tweet/list', TweetList::class);