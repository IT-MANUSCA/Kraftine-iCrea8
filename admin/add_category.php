<?php
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');
?>
<?php if (isset($_GET['msg'])): ?>
    <div style="color: green; font-weight: bold; margin-bottom: 10px;">
        <?= htmlspecialchars($_GET['msg']) ?>
    </div>
<?php endif; ?>

<head>
    <style>
        .content-box-post {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .add-category {
            border: 1px solid black;
            width: 80%;
            padding: 25px;
            border-radius: 16px;
            background-color: #f1f1f1;
        }
    </style>
</head>

<div class="content-box-post">
    <div class="add-category">
        <h1>Add New Category</h1>
        <!-- Form to Add Category -->
        <form action="save-category.php" method="POST" enctype="multipart/form-data" class="row g-3">
            <div class="col-12">
                <label for="category-name" class="form-label">Category Name</label>
                <input name="category-name" type="text" class="form-control" placeholder="Category Name..." required="required" />
            </div>

            <div class="col-12">
                <label for="category-img" class="form-label">Category Image</label>
                <input type="file" name="category-img" class="form-control" required="required" />
            </div>

            <div class="col-12">
                <button type="submit" name="submit" class="btn btn-primary">Add Category</button>
            </div>
        </form>
    </div>
</div>
