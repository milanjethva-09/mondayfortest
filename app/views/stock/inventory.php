<h4>Inventory Management</h4>

<?php if($error):?><p style="color:#c00;font-weight:bold;"><?=htmlspecialchars($error)?></p><?php endif;?>
<?php if($success):?><p style="color:#080;font-weight:bold;"><?=htmlspecialchars($success)?></p><?php endif;?>

<!-- Seller dropdown -->
<form method="get" action="">
  <label>Seller:</label>
  <select name="seller" onchange="this.form.submit()">
    <option value="">-- choose --</option>
    <?php foreach($sellers as $s):?>
      <option value="<?=$s['seller_id']?>" <?=$seller_id==$s['seller_id']?'selected':''?>>
        <?=htmlspecialchars($s['seller_name'])?>
      </option>
    <?php endforeach;?>
  </select>
</form>

<!-- Master SKU dropdown -->
<?php if($seller_id):?>
<form method="get" action="" style="margin-top:6px;">
  <input type="hidden" name="seller" value="<?=$seller_id?>">
  <label>Master SKU:</label>
  <select name="sku" onchange="this.form.submit()">
    <option value="">-- choose --</option>
    <?php foreach($masters as $m):?>
      <option value="<?=$m['master_sku_id']?>" <?=$master_id==$m['master_sku_id']?'selected':''?>>
        <?=htmlspecialchars($m['master_sku_code'])?>
      </option>
    <?php endforeach;?>
  </select>
</form>
<?php endif;?>

<?php if($master_id):?>
<hr>

<!-- Add / update stock row -->
<form method="post" action="">
  <?=\App\Core\Csrf::field();?>
  <input type="hidden" name="seller_id"     value="<?=$seller_id?>">
  <input type="hidden" name="master_sku_id" value="<?=$master_id?>">
  <input type="text"  name="warehouse"      placeholder="Warehouse name" required>
  <input type="number" name="current_stock" placeholder="Stock qty" required>
  <button type="submit">Save</button>
</form>

<!-- List inventory -->
<?php if($rows):?>
  <table border="1" cellpadding="6" style="margin-top:10px;">
    <tr><th>ID</th><th>Warehouse</th><th>Stock</th><th>Updated</th><th>Action</th></tr>
    <?php foreach($rows as $r):?>
      <tr>
        <td><?=$r['inv_id']?></td>
        <td><?=htmlspecialchars($r['warehouse'])?></td>
        <td><?=$r['current_stock']?></td>
        <td><?=$r['last_update']?></td>
        <td>
          <form method="post" action="" style="display:inline;">
            <?=\App\Core\Csrf::field();?>
            <input type="hidden" name="delete_inv_id" value="<?=$r['inv_id']?>">
            <button type="submit" onclick="return confirm('Delete this row?');">Delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach;?>
  </table>
<?php else:?>
  <p>No inventory rows for this SKU.</p>
<?php endif;?>
<?php endif;?>
