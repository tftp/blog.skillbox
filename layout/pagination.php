<?php
    if (isset($_GET['page']) && $_GET['page'] <= $countPages && $_GET['page'] > 0) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

 ?>

<nav aria-label="Page navigation">
    <ul class="pagination">
        <?php for ($i=1; $i < $countPages + 1; $i++) { ?>
            <?php if ($i == $page) { ?>
                <li class="page-item active">
                  <span class="page-link"><?= $i ?> <span class="sr-only">(current)</span></span>
                </li>
            <?php } else { ?>
                <li class="page-item">
                  <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php } ?>
        <?php } ?>
    </ul>
</nav>
