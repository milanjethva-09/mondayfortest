<h4>Product Lines Management</h4>

<?php if (!empty($error)): ?><p style="color:#c00;font-weight:bold;"><?= htmlspecialchars($error) ?></p><?php endif; ?>
<?php if (!empty($success)): ?><p style="color:#080;font-weight:bold;"><?= htmlspecialchars($success) ?></p><?php endif; ?>

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

<?php if ($brand_id): ?>
  <hr>

  <!-- Add product line -->
  <form method="post" action="">
    <?= \App\Core\Csrf::field(); ?>
    <input type="hidden" name="seller_id" value="<?= $seller_id ?>">
    <input type="hidden" name="brand_id"  value="<?= $brand_id ?>">
    <input type="text"   name="line_name" placeholder="Line name" required>
    <button type="submit">Add Line</button>
  </form>

  <!-- List lines -->
  <?php if ($lines): ?>
    <table border="1" cellpadding="6" style="margin-top:10px;">
      <tr><th>ID</th><th>Line Name</th><th>Action</th></tr>
      <?php foreach ($lines as $ln): ?>
        <tr>
          <td><?= $ln['line_id'] ?></td>
          <td><?= htmlspecialchars($ln['line_name']) ?></td>
          <td>
            <form method="post" action="" style="display:inline;">
              <?= \App\Core\Csrf::field(); ?>
              <input type="hidden" name="delete_line_id" value="<?= $ln['line_id'] ?>">
              <button type="submit" onclick="return confirm('Delete this line?');">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <p>No product lines for this brand.</p>
  <?php endif; ?>
<?php endif; ?>
