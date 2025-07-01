<h4>Brand Codes (2-letter) – per seller</h4>

<?php if (!empty($error)):  ?><p style="color:#c00;font-weight:bold;"><?= $error   ?></p><?php endif; ?>
<?php if (!empty($success)):?><p style="color:#080;font-weight:bold;"><?= $success ?></p><?php endif; ?>

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
  <?php if ($brands): ?>
    <table border="1" cellpadding="6" style="margin-top:12px;">
      <tr><th>ID</th><th>Brand Name</th><th>Code</th><th>Action</th></tr>
      <?php foreach ($brands as $b): ?>
        <tr>
          <td><?= $b['brand_id'] ?></td>
          <td><?= htmlspecialchars($b['brand_name']) ?></td>
          <td><?= htmlspecialchars($b['brand_code']) ?></td>
          <td>
            <!-- inline edit -->
            <form method="post" action="" style="display:inline;">
              <?= \App\Core\Csrf::field(); ?>
              <input type="hidden" name="seller_id" value="<?= $seller_id ?>">
              <input type="hidden" name="brand_id"  value="<?= $b['brand_id'] ?>">
              <input type="text"  name="brand_code"
                     value="<?= htmlspecialchars($b['brand_code']) ?>"
                     maxlength="2" size="3" required>
              <button type="submit">Save</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <p>No brands for this seller.</p>
  <?php endif; ?>
<?php endif; ?>
