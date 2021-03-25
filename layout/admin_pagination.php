<?php
    if (isset($_GET['page']) && $_GET['page'] <= $countPages && $_GET['page'] > 0) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    
    $objectsOnPage = (int)($_GET['objectsOnPage'] ?? '20');
 ?>

<form class="admin-pagination-form"  method="get">
    <div class="form-row">
        <div class="col-auto">
            <select class="form-control admin-pagination-select" name="objectsOnPage" >
                <option value="10" <?= $objectsOnPage == 10 ? 'selected' : '' ?>>10</option>
                <option value="20" <?= $objectsOnPage == 20 ? 'selected' : '' ?>>20</option>
                <option value="50" <?= $objectsOnPage == 50 ? 'selected' : '' ?>>50</option>
                <option value="200" <?= $objectsOnPage == 200 ? 'selected' : '' ?>>200</option>
                <option value="0" <?= $objectsOnPage == 0 ? 'selected' : '' ?>>все</option>
            </select>
        </div>
        <div class="col">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php for ($i=1; $i < $countPages + 1; $i++) { ?>
                        <?php if ($i == $page) { ?>
                            <li class="page-item active">
                              <span class="page-link"><?= $i ?> <span class="sr-only">(current)</span></span>
                            </li>
                        <?php } else { ?>
                            <li class="page-item">
                              <a class="page-link" href="?page=<?= $i ?>&objectsOnPage=<?= $objectsOnPage ?? '' ?>"><?= $i ?></a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
    <button type="submit" class="admin-pagination-button" hidden>send</button>
</form>
