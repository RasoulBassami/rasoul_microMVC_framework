<?php
namespace App\Core\Middlewares;

abstract class BaseMiddleware {

    protected array $actions = [];

    public function __construct($actions = [])
    {
        $this->actions = $actions;
    }

    abstract public function execute();
}