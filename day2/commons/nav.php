<nav class="navbar navbar-expand-lg navbar-light bg-secondary">
    <a class="navbar-brand text-white border border-white px-2" href="#">SMART-OSC</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-white" href="./index.php">Home</a>
            </li>
        </ul>
        <form action="./index.php" method="post" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" value="<?php echo isset($keyword) ? $keyword : '' ?>" type="search" name="keyword" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>