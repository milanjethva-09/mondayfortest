<h4>Category Codes (2-digit) – per seller</h4>

<?php if ($error):  ?><p style="color:#c00;font-weight:bold;"><?= $error ?></p><?php endif; ?>
<?php if ($success):?><p style="color:#080;font-weight:bold;"><?= $success ?></p><?php endif; ?>

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
  <hr>
  <form method="post" action="">
    <?= \App\Core\Csrf::field(); ?>
    <input type="hidden" name="seller_id" value="<?= $seller_id ?>">
    <input type="text"  name="category" placeholder="Category name" required>
    <input type="number" name="category_code"
           placeholder="Code (suggest <?= $suggest ?>)" min="1" max="99" required>
    <button type="submit">Add</button>
  </form>

  <?php if ($rows): ?>
    <table border="1" cellpadding="6" style="margin-top:12px;">
      <tr><th>ID</th><th>Category</th><th>Code</th><th>Action</th></tr>
      <?php foreach ($rows as $c): ?>
        <tr>
          <td><?= $c['cat_id'] ?></td>
          <td><?= htmlspecialchars($c['category']) ?></td>
          <td><?= $c['category_code'] ?></td>
          <td>
            <form method="post" action="" style="display:inline;">
              <?= \App\Core\Csrf::field(); ?>
              <input type="hidden" name="seller_id" value="<?= $seller_id ?>">
              <input type="hidden" name="delete_cat_id" value="<?= $c['cat_id'] ?>">
              <button type="submit"
                      onclick="return confirm('Delete this code?');">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  <?php else: ?>
    <p>No category codes for this seller.</p>
  <?php endif; ?>
<?php endif; ?>
