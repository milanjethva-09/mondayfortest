<?php $this->extend('layouts/app'); ?>
<?php $this->section('content'); ?>

<h2 class="mb-3">Brands Management</h2>

<!-- seller selector -->
<form class="mb-4" method="get">
    <label class="form-label">Select Seller:</label>
    <select name="seller" class="form-select" onchange="this.form.submit()">
        <option value="">-- choose --</option>
        <?php foreach ($sellers as $row): ?>
            <option value="<?= $row['seller_id']; ?>"
                    <?= $seller_id == $row['seller_id'] ? 'selected' : ''; ?>>
                <?= htmlspecialchars($row['seller_name']); ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
<?php elseif ($success): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success); ?></div>
<?php endif; ?>

<?php if ($seller_id): ?>
    <!-- add-brand form -->
    <form method="post" class="card card-body mb-4 shadow-sm">
        <?= \App\Core\Csrf::field(); ?>   <!-- hidden token -->
        <div class="row g-2 align-items-end">
            <div class="col-sm-6">
                <label class="form-label">Brand name</label>
                <input type="text"
                       name="brand_name"
                       class="form-control"
                       required>
            </div>
            <div class="col-sm-3">
                <button class="btn btn-primary w-100">Save</button>
            </div>
        </div>
    </form>

    <!-- brand list -->
    <?php if ($brands): ?>
        <table class="table table-striped table-hover">
            <thead>
            <tr><th>#</th><th>Brand</th><th style="width:120px">Actions</th></tr>
            </thead>
            <tbody>
            <?php foreach ($brands as $row): ?>
                <tr>
                    <td><?= $row['brand_id']; ?></td>
                    <td><?= htmlspecialchars($row['brand_name']); ?></td>
                    <td>
                        <a href="?seller=<?= $seller_id; ?>&delete=<?= $row['brand_id']; ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Delete this brand?');">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-muted">No brands added yet.</p>
    <?php endif; ?>

<?php else: ?>
    <p class="text-muted">Choose a seller to begin adding brands.</p>
<?php endif; ?>

<?php $this->endSection(); ?>
