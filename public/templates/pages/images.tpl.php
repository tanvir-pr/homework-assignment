<?php
try {
    $stmt = db()->query('SELECT * FROM gallery_images ORDER BY created_at DESC');
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $images = [];
    $errormessage = 'Error: ' . $e->getMessage();
}
?>
<section>
    <h2>Images Gallery</h2>
    <?php if (isset($_SESSION['login'])) { ?>
        <form action="upload-image" method="post" enctype="multipart/form-data" class="mb-4">
            <div class="input-group">
                <input type="file" class="form-control" name="image" accept="image/*" required>
                <button class="btn btn-primary">Upload image</button>
            </div>
        </form>
    <?php } else { ?>
        <p class="alert alert-warning">You must login to upload images.</p>
    <?php } ?>
    <div class="row g-3">
        <?php foreach ($images as $image) { ?>
            <div class="col-sm-6 col-lg-3">
                <img src="./assets/uploads/<?= htmlspecialchars($image['file_name']) ?>" class="img-fluid rounded border" alt="Gallery image">
            </div>
        <?php } ?>
    </div>
</section>
