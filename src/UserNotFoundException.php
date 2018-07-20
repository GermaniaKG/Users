<?php
namespace Germania\Users;

use Interop\Container\Exception\NotFoundException;
use Psr\Container\NotFoundExceptionInterface as PsrNotFoundExceptionInterface;

class UserNotFoundException extends \Exception implements NotFoundException, PsrNotFoundExceptionInterface
{

}
