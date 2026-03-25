<?php
declare(strict_types=1);

namespace App\Src;

class RandomGenerator
{
    private $n;
    private $min;
    private $max;
    private $numbers = [];

    public function __construct(int $n, int $min = 1, int $max = 10000)
    {
        $this->n = $n;
        $this->min = $min;
        $this->max = $max;
    }

    public function generate(): array
    {
        $this->numbers = [];
        for ($i = 0; $i < $this->n; $i++) {
            $this->numbers[] = random_int($this->min, $this->max);
        }
        return $this->numbers;
    }

    public function getSum(): int
    {
        $sum = 0;
        foreach ($this->numbers as $number) {
            $sum += $number;
        }
        return $sum;
    }

    public function getAverage(): float
    {
        if (count($this->numbers) === 0) {
            return 0.0;
        }
        return $this->getSum() / count($this->numbers);
    }

    public function getMin(): int
    {
        if (count($this->numbers) === 0) {
            return 0;
        }
        $min = $this->numbers[0];
        foreach ($this->numbers as $number) {
            if ($number < $min) {
                $min = $number;
            }
        }
        return $min;
    }

    public function getMax(): int
    {
        if (count($this->numbers) === 0) {
            return 0;
        }
        $max = $this->numbers[0];
        foreach ($this->numbers as $number) {
            if ($number > $max) {
                $max = $number;
            }
        }
        return $max;
    }
}
