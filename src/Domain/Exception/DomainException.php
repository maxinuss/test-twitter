<?php
declare(strict_types=1);

namespace Tweets\Domain\Exception;

interface DomainException
{
    public function message();
}
