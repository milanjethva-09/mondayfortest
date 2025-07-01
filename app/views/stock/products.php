<h4>Products Management</h4>

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

<?php if ($line_id): ?>
  <hr>

  <!-- Add product -->
  <form method="post" action="">
    <?= \App\Core\Csrf::field(); ?>
    <input type="hidden" name="seller_id" value="<?= $seller_id ?>">
    <input type="hidden" name="brand_id"  value="<?= $brand_id ?>">
    <input type="hidden" name="line_id"   value="<?= $line_id ?>">
    <input type="text"   name="product_name" placeholder="Product name" required>
    <button type="submit">Add Product</button>
  </form>

  <!-- Product list -->
  <?php if ($products): ?>
    <table border="1" cellpadding="6" style="margin-top:10px;">
      <tr><th>ID</th><th>Product Name</th><th>Action</th></tr>
      <?php foreach ($products as $p): ?>
        <tr>
          <td><?= $p['product_id'] ?></td>
          <td><?= htmlspecialchars($p['product_name']) ?></td>
          <td>
            <form method="post" action="" style="display:inline;">
              <?= \App\Core\Csrf::field(); ?>
              <input type="hidden" name="delete_product_id" value="<?= $p['product_id'] ?>">
              <button type="submit" onclick="return confirm('Delete this product?');">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <p>No products in this line.</p>
  <?php endif; ?>
<?php endif; ?>
