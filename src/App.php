<?php
declare(strict_types=1);

namespace App\Src;

class App
{
    private $request;
    private $renderer;

    public function __construct(Request $request, Renderer $renderer)
    {
        $this->request = $request;
        $this->renderer = $renderer;
    }

    public function run(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePost();
        } else {
            $this->handleGet();
        }
    }

    private function handlePost(): void
    {
        $validation = $this->request->validate();

        if (count($validation['errors']) > 0) {
            $_SESSION['errors'] = $validation['errors'];
            $_SESSION['previous_input'] = $_POST;
            $this->redirect('./index.php');
            return;
        }

        $data = $validation['data'];
        $generator = new RandomGenerator(
            $data['n'],
            $data['min'],
            $data['max']
        );

        $numbers = $generator->generate();

        $_SESSION['results'] = [
            'numbers' => $numbers,
            'stats' => [
                'sum' => $generator->getSum(),
                'average' => $generator->getAverage(),
                'min' => $generator->getMin(),
                'max' => $generator->getMax()
            ],
            'previous_input' => [
                'n' => $data['n'],
                'min' => $data['min'],
                'max' => $data['max']
            ]
        ];

        $this->redirect('./index.php');
    }

    private function handleGet(): void
    {
        $errors = [];
        $previousInput = [];
        $results = null;

        if (isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }

        if (isset($_SESSION['previous_input'])) {
            $previousInput = $_SESSION['previous_input'];
            unset($_SESSION['previous_input']);
        }

        if (isset($_SESSION['results'])) {
            $results = $_SESSION['results'];
            unset($_SESSION['results']);
        }

        echo '<!DOCTYPE html>';
        echo '<html lang="es">';
        echo '<head>';
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<title>Generador de Números Aleatorios</title>';
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">';
        echo '<style>';
        echo '.error { color: red; margin-bottom: 10px; }';
        echo '.stats-row { font-weight: bold; background-color: #f2f2f2; }';
        echo '</style>';
        echo '</head>';
        echo '<body>';
        echo '<h1>Generador de Números Aleatorios</h1>';

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo '<p class="error">' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
            }
        }

        echo $this->renderer->renderForm($previousInput);

        if ($results !== null) {
            echo $this->renderer->renderResults(
                $results['numbers'],
                $results['stats'],
                $results['previous_input']
            );
        }

        echo '</body>';
        echo '</html>';
    }

    private function redirect(string $location): void
    {
        header('Location: ' . $location);
        exit;
    }
}
