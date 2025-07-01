<h4>SKU Detail</h4>

<?php if ($error):   ?><p style="color:#c00;font-weight:bold;"><?= $error   ?></p><?php endif; ?>
<?php if ($success): ?><p style="color:#080;font-weight:bold;"><?= $success ?></p><?php endif; ?>

<table border="1" cellpadding="6">
  <tr><th>Field</th><th>Value</th></tr>
  <?php foreach ($row as $k=>$v): ?>
    <tr>
      <td><?= htmlspecialchars($k) ?></td>
      <td><?= htmlspecialchars($v) ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<hr>
<h5>Edit basic fields</h5>
<form method="post" action="">
  <?= \App\Core\Csrf::field(); ?>
  <label>SKU Code:</label>
  <input type="text" name="sku_code" value="<?= htmlspecialchars($row['sku_code']) ?>" required>

  <label>MRP:</label>
  <input type="number" step="0.01" name="mrp" value="<?= $row['mrp'] ?>">

  <label>Cost Price:</label>
  <input type="number" step="0.01" name="cost_price" value="<?= $row['cost_price'] ?>">

  <button type="submit">Save</button>
</form>
