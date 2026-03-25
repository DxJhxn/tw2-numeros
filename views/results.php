<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Índice</th>
                <th>Número aleatorio</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($numbers as $index => $number): ?>
            <tr>
                <td><?php echo htmlspecialchars((string)($index + 1), ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars((string)$number, ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="stats-row">
                <td>Suma</td>
                <td><?php echo htmlspecialchars((string)$stats['sum'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <tr class="stats-row">
                <td>Promedio</td>
                <td><?php echo htmlspecialchars(number_format($stats['average'], 2), ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <tr class="stats-row">
                <td>Mínimo</td>
                <td><?php echo htmlspecialchars((string)$stats['min'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
            <tr class="stats-row">
                <td>Máximo</td>
                <td><?php echo htmlspecialchars((string)$stats['max'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
        </tbody>
    </table>
</div>
