<h4>Sellers Management</h4>

<!-- feedback -->
<?php if (!empty($error)):  ?>
  <p style="color:#c00;font-weight:bold;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<?php if (!empty($success)): ?>
  <p style="color:#080;font-weight:bold;"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<!-- Add Seller Form -->
<form method="post" action="">
  <?= \App\Core\Csrf::field(); ?>
  <input type="text" name="seller_name" placeholder="Enter seller name" required>
  <button type="submit">Add Seller</button>
</form>

<hr>

<!-- Seller List -->
<?php if (!empty($sellers)): ?>
  <table border="1" cellpadding="6">
    <tr>
      <th>ID</th>
      <th>Seller Name</th>
      <th>Action</th>
    </tr>
    <?php foreach ($sellers as $seller): ?>
      <tr>
        <td><?= (int)$seller['seller_id'] ?></td>
        <td><?= htmlspecialchars($seller['seller_name']) ?></td>
        <td>
          <form method="post" action="" style="display:inline;">
            <?= \App\Core\Csrf::field(); ?>
            <input type="hidden" name="delete_seller_id"
                   value="<?= (int)$seller['seller_id'] ?>">
            <button type="submit"
                    onclick="return confirm('Delete this seller?');">
              Delete
            </button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php else: ?>
  <p>No sellers found.</p>
<?php endif; ?>
