<?php

namespace App\Responses;

use App\Models\Post;
use Illuminate\Http\JsonResponse;

class FinalResponse
{
    public function __construct(
        public ?int $total = null,
        public ?int $perPage = null,
        public ?Pagi $pagi = null
    )
    {
    }
}

class Pagi {
    private ?string $name = 'atif';
    private ?int $number = 03345;

    /**
     * @param string|null $name
     * @param int|null $number
     */
    public function __construct(?string $name, ?int $number)
    {
        $this->name = $name;
        $this->number = $number;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @param int|null $number
     */
    public function setNumber(?int $number): void
    {
        $this->number = $number;
    }

}

