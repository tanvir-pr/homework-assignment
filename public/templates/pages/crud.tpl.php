<?php
try {
    $stmt = db()->query(
        'SELECT p.*, c.price AS category_price
         FROM pizzas p
         LEFT JOIN pizza_categories c ON c.cname = p.category_name
         ORDER BY p.id DESC'
    );
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $items = [];
    $errormessage = 'Error: ' . $e->getMessage();
}

$editing = null;
if (isset($_GET['id'])) {
    $editId = (int) $_GET['id'];
    $editStmt = db()->prepare('SELECT * FROM pizzas WHERE id = :id LIMIT 1');
    $editStmt->execute(['id' => $editId]);
    $editing = $editStmt->fetch(PDO::FETCH_ASSOC) ?: null;
}
?>
<section class="row g-4">
    <div class="col-lg-5">
        <h2><?= $editing ? 'Edit Pizza' : 'Add Pizza' ?></h2>
        <form method="post" action="<?= $editing ? 'crud-edit' : 'crud-create' ?>">
            <?php if ($editing) { ?>
                <input type="hidden" name="id" value="<?= (int) $editing['id'] ?>">
            <?php } ?>
            <div class="mb-2">
                <input class="form-control" name="pizza_name" placeholder="Pizza name" value="<?= htmlspecialchars($editing['pizza_name'] ?? '') ?>" required>
            </div>
            <div class="mb-2">
                <select class="form-select" name="category_name" required>
                    <?php $selectedCategory = $editing['category_name'] ?? 'king'; ?>
                    <option value="page" <?= $selectedCategory === 'page' ? 'selected' : '' ?>>page</option>
                    <option value="nobleman" <?= $selectedCategory === 'nobleman' ? 'selected' : '' ?>>nobleman</option>
                    <option value="knight" <?= $selectedCategory === 'knight' ? 'selected' : '' ?>>knight</option>
                    <option value="king" <?= $selectedCategory === 'king' ? 'selected' : '' ?>>king</option>
                </select>
            </div>
            <div class="mb-2 form-check">
                <input class="form-check-input" type="checkbox" name="vegetarian" id="vegetarian" <?= !empty($editing['vegetarian']) ? 'checked' : '' ?>>
                <label class="form-check-label" for="vegetarian">Vegetarian pizza</label>
            </div>
            <button class="btn btn-primary"><?= $editing ? 'Update' : 'Create' ?></button>
            <?php if ($editing) { ?>
                <a class="btn btn-secondary" href="crud">Cancel</a>
            <?php } ?>
        </form>
    </div>
    <div class="col-lg-7">
        <h2>Pizzas</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Pizza</th>
                        <th>Category</th>
                        <th>Vegetarian</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item) { ?>
                        <tr>
                            <td><?= htmlspecialchars($item['pizza_name']) ?></td>
                            <td><?= htmlspecialchars($item['category_name']) ?></td>
                            <td><?= (int) $item['vegetarian'] === 1 ? 'Yes' : 'No' ?></td>
                            <td><?= htmlspecialchars((string) ($item['category_price'] ?? 'n/a')) ?> HUF</td>
                            <td class="d-flex gap-2">
                                <a class="btn btn-sm btn-warning" href="crud&id=<?= (int) $item['id'] ?>">Edit</a>
                                <form action="crud-delete" method="post" onsubmit="return confirm('Delete this item?')">
                                    <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
