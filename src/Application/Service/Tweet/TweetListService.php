<?php
declare(strict_types=1);

namespace Tweets\Application\Service\Tweet;

use Tweets\Domain\Model\Tweet\Tweet;
use Tweets\Domain\Model\Tweet\TweetRepository;

class TweetListService
{
    /**
     * @var TweetRepository
     */
    private $tweetRepository;

    /**
     * @param TweetRepository $tweetRepository
     */
    public function __construct(
        TweetRepository $tweetRepository
    ) {
        $this->tweetRepository = $tweetRepository;
    }

    /**
     * @return array
     */
    public function execute()
    {
        /*try{
            $category = new Category();
            $category->setName($request->name());
            $category->setImage($request->image());
            $category->setActive($request->active());

            $this->categoryRepository->add($category);
        }catch (\Exception $e) {
            return [
                'error' => $e
            ];
        }

        return [
            'success' => true
        ];*/

        return [];
    }
}
