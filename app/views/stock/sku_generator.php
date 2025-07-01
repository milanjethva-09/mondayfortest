<h4>SKU Generator</h4>

<?php if ($error): ?>
  <p style="color:#c00;font-weight:bold;"><?= $error ?></p>
<?php endif; ?>
<?php if ($success): ?>
  <p style="color:#080;font-weight:bold;"><?= $success ?></p>
<?php endif; ?>

<!-- Seller dropdown -->
<form method="get" action="">
  <label>Seller:</label>
  <select name="seller" onchange="this.form.submit()">
    <option value="">-- choose --</option>
    <?php foreach ($sellers as $s): ?>
      <option value="<?= $s['seller_id'] ?>" <?= $seller_id==$s['seller_id']?'selected':'' ?>>
        <?= htmlspecialchars($s['seller_name']) ?>
      </option>
    <?php endforeach; ?>
  </select>
</form>

<?php if ($seller_id): ?>
<hr>
<form method="post" action="">
  <?= \App\Core\Csrf::field(); ?>
  <input type="hidden" name="seller_id" value="<?= $seller_id ?>">

  <!-- compulsory fields -->
  <label>Brand:</label>
  <select name="brand_code" required>
    <option value="">-- code --</option>
    <?php foreach ($brandCodes as $b): ?>
      <option value="<?= $b['brand_code'] ?>">
        <?= $b['brand_code'].' – '.htmlspecialchars($b['brand_name']) ?>
      </option>
    <?php endforeach; ?>
  </select>

  <label>Product Class:</label>
  <select name="class_code" required>
    <option value="">-- code --</option>
    <?php foreach ($classCodes as $c): ?>
      <option value="<?= $c['class_code'] ?>">
        <?= $c['class_code'].' – '.htmlspecialchars($c['class_name']) ?>
      </option>
    <?php endforeach; ?>
  </select>

  <label>Category:</label>
  <select name="category_code" required>
    <option value="">-- code --</option>
    <?php foreach ($catCodes as $c): ?>
      <option value="<?= $c['category_code'] ?>">
        <?= $c['category_code'].' – '.htmlspecialchars($c['category']) ?>
      </option>
    <?php endforeach; ?>
  </select>

  <input type="text" name="article_name"  placeholder="Article / Generic Name" required>
  <input type="text" name="pack"          placeholder="Pack (e.g. 250ML)" required>

  <!-- optional fields -->
  <input type="number" step="0.01" name="mrp"        placeholder="MRP">
  <input type="number" step="0.01" name="cost_price" placeholder="Cost Price">
  <input type="number" step="0.001" name="weight_kg" placeholder="Weight kg">
  <input type="number" step="0.01" name="pack_l" placeholder="Pack L cm">
  <input type="number" step="0.01" name="pack_b" placeholder="Pack B cm">
  <input type="number" step="0.01" name="pack_h" placeholder="Pack H cm">

  <input type="text" name="sku_code" placeholder="Override SKU (optional)">
  <button type="submit">Generate SKU</button>
</form>

<p style="margin-top:10px;">
  <a href="/stock/skuList?seller=<?= $seller_id ?>">View all SKUs for this seller</a>
</p>
<?php endif; ?>
