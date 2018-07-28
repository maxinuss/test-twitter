<?php
declare(strict_types=1);

namespace Tweets\Application\Action\Tweet;

use Tweets\Application\Service\Tweet\TweetListService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class TweetList
{
    /**
     * @var TweetListService
     */
    private $service;
    /**
     * @param TweetListService $service
     */
    public function __construct(TweetListService $service)
    {
        $this->service = $service;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args = []): ResponseInterface
    {
        $result = $this->service->execute();

        return $response->withJson($result);
    }
}
