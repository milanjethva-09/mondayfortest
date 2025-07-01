<h4>Generated SKU List</h4>

<?php if ($error):   ?><p style="color:#c00;font-weight:bold;"><?= $error   ?></p><?php endif; ?>
<?php if ($success): ?><p style="color:#080;font-weight:bold;"><?= $success ?></p><?php endif; ?>

<!-- Seller selector -->
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
  <?php if ($rows): ?>
    <table border="1" cellpadding="6" style="margin-top:12px;">
      <tr>
        <th>ID</th><th>SKU Code</th><th>Brand</th><th>Article</th><th>Action</th>
      </tr>
      <?php foreach ($rows as $r): ?>
        <tr>
          <td><?= $r['sku_id'] ?></td>
          <td><?= htmlspecialchars($r['sku_code']) ?></td>
          <td><?= htmlspecialchars($r['brand_name']) ?></td>
          <td><?= htmlspecialchars($r['article_name']) ?></td>
          <td>
            <a href="/stock/skuView/<?= $r['sku_id'] ?>">View / Edit</a>
            |
            <form method="post" action="" style="display:inline;">
              <?= \App\Core\Csrf::field(); ?>
              <input type="hidden" name="seller_id" value="<?= $seller_id ?>">
              <input type="hidden" name="delete_sku_id" value="<?= $r['sku_id'] ?>">
              <button type="submit"
                      onclick="return confirm('Delete this SKU?');">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <p>No SKUs found for this seller.</p>
  <?php endif; ?>
<?php endif; ?>
