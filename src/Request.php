<?php
declare(strict_types=1);

namespace App\Src;

class Request
{
    private $get;
    private $post;

    public function __construct(array $get, array $post)
    {
        $this->get = $get;
        $this->post = $post;
    }

    public function getInt(string $key, int $default = null): ?int
    {
        if (isset($this->post[$key])) {
            $value = filter_var($this->post[$key], FILTER_VALIDATE_INT);
            return $value !== false ? $value : null;
        }
        if (isset($this->get[$key])) {
            $value = filter_var($this->get[$key], FILTER_VALIDATE_INT);
            return $value !== false ? $value : null;
        }
        return $default;
    }

    public function validate(): array
    {
        $errors = [];
        $data = [];

        $n = $this->getInt('n');
        if ($n === null) {
            $errors[] = 'El campo "n" es requerido.';
        } elseif ($n < 1 || $n > 1000) {
            $errors[] = 'El campo "n" debe estar entre 1 y 1000.';
        } else {
            $data['n'] = $n;
        }

        $min = $this->getInt('min');
        $max = $this->getInt('max');

        if ($min !== null && $max !== null) {
            if ($min >= $max) {
                $errors[] = 'El valor mínimo debe ser menor que el máximo.';
            } else {
                $data['min'] = $min;
                $data['max'] = $max;
            }
        } else {
            $data['min'] = 1;
            $data['max'] = 10000;
        }

        return ['errors' => $errors, 'data' => $data];
    }

    public function all(): array
    {
        return array_merge($this->get, $this->post);
    }
}
