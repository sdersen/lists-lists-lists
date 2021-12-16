<?php require __DIR__ . '/app/lists/getLists.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<h1>Your Lists, woooo</h1>

<section class="create-list-container">

    <form action="app/lists/create.php" method="post">
        <div class="mb-3">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" placeholder="An amazing title" required>
            <small class="form-text">Please enter a title for your list.</small>
        </div>
        <button type="submit" class="btn btn-primary">Create list</button>
    </form>
    <?php
    if (isset($_SESSION['user'])) : ?>
        <section>
            <?php
            foreach (getLists($_SESSION['user']['id'], $database) as $list) : ?>
                <article class="list-container">
                    <h3 class="list-title"><?= $list['title']; ?></h3>
                    <span>Created</span><span><?= $list['created_at']; ?></span>

                    <button class="edit_list_btn">Edit</button>
                    <form action="app/list/done.php">
                        <button>Done</button>
                    </form>
                    <div class="edit-list-container">
                        <form action="app/lists/update.php" method="post">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input class="form-control" type="text" name="title" id="title" placeholder="An amazing title">
                                <small class="form-text">Please enter a title for your task.</small>
                            </div>

                            <input type="hidden" id="id" name="id" value="<?= $list['id'] ?>">
                            <button type="submit" class="btn btn-primary">Update List</button>
                        </form>
                        <form action="app/lists/delete.php" method="post">
                            <input type="hidden" id="delete_id" name="delete_id" value="<?= $list['id'] ?>">
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </form>
                    </div>

                </article>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
</section>
<?php require __DIR__ . '/views/footer.php'; ?>
