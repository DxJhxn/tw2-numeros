<form action="./index.php" method="POST" class="row g-3">
    <div class="col-md-4">
        <label for="n" class="form-label">Cantidad de números (n):</label>
        <input type="number" id="n" name="n" class="form-control" value="<?php echo isset($data['n']) ? htmlspecialchars($data['n'], ENT_QUOTES, 'UTF-8') : ''; ?>" min="1" max="1000" required>
    </div>
    <div class="col-md-4">
        <label for="min" class="form-label">Valor mínimo (opcional):</label>
        <input type="number" id="min" name="min" class="form-control" value="<?php echo isset($data['min']) ? htmlspecialchars($data['min'], ENT_QUOTES, 'UTF-8') : ''; ?>">
    </div>
    <div class="col-md-4">
        <label for="max" class="form-label">Valor máximo (opcional):</label>
        <input type="number" id="max" name="max" class="form-control" value="<?php echo isset($data['max']) ? htmlspecialchars($data['max'], ENT_QUOTES, 'UTF-8') : ''; ?>">
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Generar</button>
    </div>
</form>
