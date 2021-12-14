    <nav class="navbar navbar-expand-lg navbar-light">
        <img class="nav-logo" src="/assets/images/check-double-solid.svg" alt="">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="/index.php">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/about.php">About</a>
            </li>
            <?php if (isset($_SESSION['user']) !== true) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/login.php">Login </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register.php">Register </a>
                </li>
            <?php endif; ?>

            <?php if (isset($_SESSION['user'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="/app/users/logout.php">Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/profile.php">Profile</a>
                </li>
            <?php endif; ?>

        </ul>
    </nav>
