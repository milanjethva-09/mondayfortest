<h4>Master SKU Management</h4>

<?php if($error):   ?><p style="color:#c00;font-weight:bold;"><?=htmlspecialchars($error)?></p><?php endif;?>
<?php if($success): ?><p style="color:#080;font-weight:bold;"><?=htmlspecialchars($success)?></p><?php endif;?>

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

<!-- Brand dropdown -->
<?php if($seller_id):?>
<form method="get" action="" style="margin-top:6px;">
  <input type="hidden" name="seller" value="<?=$seller_id?>">
  <label>Brand:</label>
  <select name="brand" onchange="this.form.submit()">
    <option value="">-- choose --</option>
    <?php foreach($brands as $b):?>
      <option value="<?=$b['brand_id']?>" <?=$brand_id==$b['brand_id']?'selected':''?>>
        <?=htmlspecialchars($b['brand_name'])?>
      </option>
    <?php endforeach;?>
  </select>
</form>
<?php endif;?>

<!-- Line dropdown -->
<?php if($brand_id):?>
<form method="get" action="" style="margin-top:6px;">
  <input type="hidden" name="seller" value="<?=$seller_id?>">
  <input type="hidden" name="brand"  value="<?=$brand_id?>">
  <label>Line:</label>
  <select name="line" onchange="this.form.submit()">
    <option value="">-- choose --</option>
    <?php foreach($lines as $ln):?>
      <option value="<?=$ln['line_id']?>" <?=$line_id==$ln['line_id']?'selected':''?>>
        <?=htmlspecialchars($ln['line_name'])?>
      </option>
    <?php endforeach;?>
  </select>
</form>
<?php endif;?>

<!-- Product dropdown -->
<?php if($line_id):?>
<form method="get" action="" style="margin-top:6px;">
  <input type="hidden" name="seller" value="<?=$seller_id?>">
  <input type="hidden" name="brand"  value="<?=$brand_id?>">
  <input type="hidden" name="line"   value="<?=$line_id?>">
  <label>Product:</label>
  <select name="product" onchange="this.form.submit()">
    <option value="">-- choose --</option>
    <?php foreach($products as $p):?>
      <option value="<?=$p['product_id']?>" <?=$product_id==$p['product_id']?'selected':''?>>
        <?=htmlspecialchars($p['product_name'])?>
      </option>
    <?php endforeach;?>
  </select>
</form>
<?php endif;?>

<!-- Variation dropdown -->
<?php if($product_id):?>
<form method="get" action="" style="margin-top:6px;">
  <input type="hidden" name="seller" value="<?=$seller_id?>">
  <input type="hidden" name="brand"  value="<?=$brand_id?>">
  <input type="hidden" name="line"   value="<?=$line_id?>">
  <input type="hidden" name="product" value="<?=$product_id?>">
  <label>Variation:</label>
  <select name="variation" onchange="this.form.submit()">
    <option value="">-- choose --</option>
    <?php foreach($variations as $v):?>
      <option value="<?=$v['variation_id']?>" <?=$variation_id==$v['variation_id']?'selected':''?>>
        <?=htmlspecialchars($v['variation_desc'])?>
      </option>
    <?php endforeach;?>
  </select>
</form>
<?php endif;?>

<?php if($variation_id):?>
<hr>

<!-- Add Master SKU -->
<form method="post" action="">
  <?=\App\Core\Csrf::field();?>
  <input type="hidden" name="seller_id"    value="<?=$seller_id?>">
  <input type="hidden" name="brand_id"     value="<?=$brand_id?>">
  <input type="hidden" name="line_id"      value="<?=$line_id?>">
  <input type="hidden" name="product_id"   value="<?=$product_id?>">
  <input type="hidden" name="variation_id" value="<?=$variation_id?>">

  <input type="text" name="master_sku_code" placeholder="SKU code" required>
  <input type="text" name="pack_size"       placeholder="Pack size">
  <input type="text" name="combo_desc"      placeholder="Combo description">
  <button type="submit">Add Master SKU</button>
</form>

<!-- Master SKU list -->
<?php if($skus):?>
  <table border="1" cellpadding="6" style="margin-top:10px;">
    <tr><th>ID</th><th>SKU Code</th><th>Pack</th><th>Combo</th><th>Action</th></tr>
    <?php foreach($skus as $m):?>
      <tr>
        <td><?=$m['master_sku_id']?></td>
        <td><?=htmlspecialchars($m['master_sku_code'])?></td>
        <td><?=htmlspecialchars($m['pack_size'])?></td>
        <td><?=htmlspecialchars($m['combo_desc'])?></td>
        <td>
          <form method="post" action="" style="display:inline;">
            <?=\App\Core\Csrf::field();?>
            <input type="hidden" name="delete_sku_id" value="<?=$m['master_sku_id']?>">
            <button type="submit" onclick="return confirm('Delete this SKU?');">Delete</button>
          </form>
        </td>
      </tr>
    <?php endforeach;?>
  </table>
<?php else:?>
  <p>No Master SKUs for this variation.</p>
<?php endif;?>
<?php endif;?>
