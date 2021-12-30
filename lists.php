<!-- Behöver jag verkligen denna?? -->
<?php require __DIR__ . '/app/lists/getLists.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article class="list-page">
    <h1>Your Lists, woooo</h1>

    <section class="create-list-container">

        <form action="app/lists/create.php" method="post">
            <div class="mb-3">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" placeholder="An amazing title" required>
                <small class="form-text">Please enter a title for your list.</small>
            </div>
            <button type="submit" class="btn btn-danger">Create list</button>
        </form>
        <?php
        if (isset($_SESSION['user'])) : ?>
            <section>
                <?php
                foreach (getLists($_SESSION['user']['id'], $database) as $list) : ?>
                    <article class="list-container">
                        <div class="headline-container">
                            <h3 class="list-title"><?= htmlspecialchars($list['title']); ?></h3>
                            <button class="edit-task-btn edit-list-btn"><img class="btn-check-icon btn-icon" src="/assets/images/edit-regular.svg" alt=""></button>
                        </div>
                        <span>Created: </span><span><?= $list['created_at']; ?></span>

                        <?php foreach (getTasksForList($list['id'], $database) as $task) : ?>
                            <div class="task-container">
                                <h5 class="task-title"><?= htmlspecialchars($task['title']); ?></h5>
                                <p class="task-description"><?= htmlspecialchars($task['description']); ?></p>
                                <span>Deadline: </span><span><?= $task['completed_at']; ?></span>
                                <div class="flex-btn-container">
                                    <form action="app/tasks/done.php" method="POST">
                                        <button class="btn btn-primary done-task-btn" type="submit">Task Done</button>
                                        <input type="hidden" id="redirect" name="redirect" value="1">
                                        <input type="hidden" id="done_id" name="done_id" value="<?= $task['id'] ?>">
                                    </form>
                                    <form action="app/lists/remove-task.php" method="POST">
                                        <button class="btn btn-primary done-list-btn" type="submit">remove task from list</button>
                                        <input type="hidden" id="id" name="id" value="<?= $task['id'] ?>">
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <form action="app/lists/done.php" method="POST">
                            <button class="btn btn-danger done-list-btn" type="submit">List Done</button>
                            <input type="hidden" id="done_id" name="done_id" value="<?= $list['id'] ?>">
                        </form>


                        <div class="edit-list-container hidden">
                            <form action="app/lists/update.php" method="post">
                                <div class="mb-3">
                                    <label for="title">Title</label>
                                    <input class="form-control" type="text" name="title" id="title" placeholder="An amazing title">
                                    <small class="form-text">Please enter a title for your task.</small>
                                </div>
                                <input type="hidden" id="id" name="id" value="<?= $list['id'] ?>">
                                <button type="submit" class="btn btn-danger">Update Title</button>
                            </form>
                            <div class="flex-btn-container">
                                <form action="app/lists/delete.php" method="post">
                                    <input type="hidden" id="delete_id" name="delete_id" value="<?= $list['id'] ?>">
                                    <button type="submit" class="btn btn-danger">Delete List</button>
                                </form>
                                <form action="app/lists/delete-list-tasks.php" method="post">
                                    <input type="hidden" id="delete_id" name="delete_id" value="<?= $list['id'] ?>">
                                    <button type="submit" class="btn btn-danger">Delete list incl tasks</button>
                                </form>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
    </section>
</article>
<?php require __DIR__ . '/views/footer.php'; ?>
