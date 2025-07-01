<h4>Variations Management</h4>

<?php if ($error): ?><p style="color:#c00;font-weight:bold;"><?= htmlspecialchars($error) ?></p><?php endif; ?>
<?php if ($success): ?><p style="color:#080;font-weight:bold;"><?= htmlspecialchars($success) ?></p><?php endif; ?>

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

<!-- Brand dropdown -->
<?php if ($seller_id): ?>
  <form method="get" action="" style="margin-top:6px;">
    <input type="hidden" name="seller" value="<?= $seller_id ?>">
    <label>Brand:</label>
    <select name="brand" onchange="this.form.submit()">
      <option value="">-- choose --</option>
      <?php foreach ($brands as $b): ?>
        <option value="<?= $b['brand_id'] ?>" <?= $brand_id==$b['brand_id']?'selected':'' ?>>
          <?= htmlspecialchars($b['brand_name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </form>
<?php endif; ?>

<!-- Line dropdown -->
<?php if ($brand_id): ?>
  <form method="get" action="" style="margin-top:6px;">
    <input type="hidden" name="seller" value="<?= $seller_id ?>">
    <input type="hidden" name="brand"  value="<?= $brand_id ?>">
    <label>Line:</label>
    <select name="line" onchange="this.form.submit()">
      <option value="">-- choose --</option>
      <?php foreach ($lines as $ln): ?>
        <option value="<?= $ln['line_id'] ?>" <?= $line_id==$ln['line_id']?'selected':'' ?>>
          <?= htmlspecialchars($ln['line_name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </form>
<?php endif; ?>

<!-- Product dropdown -->
<?php if ($line_id): ?>
  <form method="get" action="" style="margin-top:6px;">
    <input type="hidden" name="seller" value="<?= $seller_id ?>">
    <input type="hidden" name="brand"  value="<?= $brand_id ?>">
    <input type="hidden" name="line"   value="<?= $line_id ?>">
    <label>Product:</label>
    <select name="product" onchange="this.form.submit()">
      <option value="">-- choose --</option>
      <?php foreach ($products as $p): ?>
        <option value="<?= $p['product_id'] ?>" <?= $product_id==$p['product_id']?'selected':'' ?>>
          <?= htmlspecialchars($p['product_name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </form>
<?php endif; ?>

<?php if ($product_id): ?>
  <hr>

  <!-- Add variation -->
  <form method="post" action="">
    <?= \App\Core\Csrf::field(); ?>
    <input type="hidden" name="seller_id"   value="<?= $seller_id ?>">
    <input type="hidden" name="brand_id"    value="<?= $brand_id ?>">
    <input type="hidden" name="line_id"     value="<?= $line_id ?>">
    <input type="hidden" name="product_id"  value="<?= $product_id ?>">
    <input type="text"   name="variation_desc" placeholder="Variation (e.g., 'Large 250 g')" required>
    <button type="submit">Add Variation</button>
  </form>

  <!-- Variation list -->
  <?php if ($variations): ?>
    <table border="1" cellpadding="6" style="margin-top:10px;">
      <tr><th>ID</th><th>Variation</th><th>Action</th></tr>
      <?php foreach ($variations as $v): ?>
        <tr>
          <td><?= $v['variation_id'] ?></td>
          <td><?= htmlspecialchars($v['variation_desc']) ?></td>
          <td>
            <form method="post" action="" style="display:inline;">
              <?= \App\Core\Csrf::field(); ?>
              <input type="hidden" name="delete_variation_id" value="<?= $v['variation_id'] ?>">
              <button type="submit" onclick="return confirm('Delete this variation?');">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <p>No variations for this product.</p>
  <?php endif; ?>
<?php endif; ?>
