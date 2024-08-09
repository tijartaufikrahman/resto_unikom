<div class="ingredient-group">
    <div class="row">
        <div class="col-6">
            <label for="" class="form-label">Bahan Baku:</label>
            <select name="ingredients2[]" class="form-control" required>
                <option value="">-- Choose --</option>
                <?php foreach ($bahan_baku as $bb) : ?>
                    <option value="<?= $bb['id'] ?>">
                        <?= $bb['name_material']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-4">
            <label for="" class="form-label">Qty:</label>
            <input type="text" name="qty2[]" class="form-control mb-2" required>
        </div>
    </div>
</div>