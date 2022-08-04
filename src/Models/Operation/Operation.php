<?php

namespace App\Models\Operation;

abstract class Operation
{
    protected const PREFIX = 'Operation';

    protected string $id;
    protected string $comment;
    protected int $price;
    protected string $dateTime; // 2022-03-21 12:12

    public function __construct(int $price, string $comment)
    {
        sleep(1);
        $this->price = $price;
        $this->comment = $comment;
        $this->id = uniqid(self::PREFIX);
        $this->dateTime = date('Y-m-d H:i:s');
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    public function getDateTime(): string
    {
        return $this->dateTime;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}