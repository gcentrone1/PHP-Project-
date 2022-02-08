<body class="d-flex flex-column min-vh-100">
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">

        <a class="navbar-brand" href="#">
            <i class="fa fa-user fa-2x"></i>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>
        <?php
        $currentUrl = $_SERVER['PHP_SELF'];
        ?>
        <div class="collapse navbar-collapse" id="navbarCollapse">

            <ul class="navbar-nav mr-auto">
                <?php

                $activeIndex = (stripos($currentUrl, 'index') && empty($_GET['action']));
                $class = $activeIndex ? 'active' : '';

                ?>
                <li class="nav-item  <?= $class ?>">


                    <a class="nav-link" href="index.php">
                        <i class="fas fa-users"></i> Users
                        <?php if ($activeIndex) { ?>
                            <span class="sr-only">(current)</span>
                        <?php } ?>
                    </a>
                </li>

                <?php
                $activeIndex = (!empty($_GET['action']) && $_GET['action'] === 'insert');
                $class = $activeIndex ? 'active' : '';
                ?>

                <li class="nav-item  <?= $class ?> ">
                    <a class="nav-link" href="updateUser.php?action=insert">
                        <i class="fas fa-user-plus"></i>
                        NEW USER</a>
                </li>

            </ul>
            <form class="form-inline d-flex mt-2 mt-md-0 align-items-center" method="get" action="<?= $pageUrl ?>" id="searchForm">
                <input type="hidden" name="page" id="page" value="<?= $page ?>">
                <div class="form-group">
                    <label for="orderBy ">ORDER BY</label>

                    <select class="form-select" aria-label="Default select example" name="orderBy" class="form-control" id="orderBy" onchange="document.forms.searchForm.submit()">


                        <option value="">SELECT</option>
                        <?php
                        foreach ($orderByColumns as $val) {
                        ?>
                            <option <?= $orderBy == $val ? 'selected' : '' ?> value="<?= $val ?>"><?= $val ?></option>


                        <?php } ?>
                    </select>
                </div>&nbsp;

                <div class="form-group">
                    <label for="orderBy ">ORDER</label>

                    <select class="form-select" aria-label="Default select example" name="orderDir" class="form-control" id="orderDir" onchange="document.forms.searchForm.submit()">
                        <option <?= $orderDir == 'ASC' ? 'selected' : '' ?> value="ASC">ASC</option>
                        <option <?= $orderDir == 'DESC' ? 'selected' : '' ?> value="DESC">DESC</option>


                    </select>
                </div>&nbsp;
                <div class="form-group">
                    <label for="recordsPerPage ">RECORDS</label>

                    <select class="form-select" aria-label="Default select example" class="form-select" aria-label="Default select example" name="recordsPerPage" class="form-control" id="recordsPerPage" onchange="document.forms.searchForm.page.value=1;document.forms.searchForm.submit()">


                        <option value="">SELECT</option>
                        <?php
                        foreach ($recordsPerPageOption as $val) {
                        ?>
                            <option <?= $recordsPerPage == $val ? 'selected' : '' ?> value="<?= $val ?>"><?= $val ?></option>


                        <?php } ?>
                    </select>
                </div>&nbsp;
                <input class="form-control mr-sm-2" type="text" name="search" id="search" value="<?= $search ?>" placeholder="Search" aria-label="Search">
                <button onclick="document.forms.searchForm.page.value=1" class="btn btn-outline-success my-2 my-sm-0" type="submit">

                    Search
                </button>&nbsp;
                <button onclick="location.href='<?= $pageUrl ?>'" class="btn btn-warning my-2 my-sm-0" type="button">

                    RESET
                </button>
            </form>
        </div>
    </nav>
</header>