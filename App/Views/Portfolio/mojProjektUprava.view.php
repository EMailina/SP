<?php /** @var Array $data */ ?>
<main>


    <section class="portfolio">
        <div class="container">

            <?php if ($data['error'] != "") { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?= $data['error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <?php if ($data['success'] != "") { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $data['success'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <form action="?c=portfolio&a=saveChange&id=<?= $_GET['id'] ?>" enctype="multipart/form-data" method="post">


                <div class="row g-3">
                    <div class="col-sm-10">
                        <h2> <?= $p = \App\Models\Project::getOne($_GET['id'])->getName(); ?></h2>
                        <img alt="obrazok" src="<?= \App\Config\Configuration::UPLOAD_DIR . \App\Models\Project::getOne($_GET['id'])->getImage(); ?>">
                        <div class="mb-3">
                            <label for="form1" class="form-label">Titulný obrázok</label>
                            <input name="projectImage" class="form-control" type="file" id="form1">
                        </div>
                        <div class="form-floating">

                            <textarea name="name" class="form-control" placeholder="Leave a comment here"
                                      id="floatingTextarea"><?= $p = \App\Models\Project::getOne($_GET['id'])->getName(); ?></textarea>
                            <label for="floatingTextarea"> Zmeniť názov</label>
                        </div>
                    </div>

                    <div class="col-sm-10">


                        <div class="form-floating">
                <textarea name="text" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                          style="height: 100px"><?= $p = \App\Models\Project::getOne($_GET['id'])->getText(); ?></textarea>
                            <label for="floatingTextarea2">Popis</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="mbtn">Potvrdiť zmeny</button>



        </form>
        </div>
    </section>
    <section class="portfolio">

        <h2>Obrázky</h2>
        <?php if ($data['projectImages'] == null) { ?>
            <p>Zatiaľ bez obrázkov.</p>

        <?php } ?>
        <div class="portfolio-grid">

            <?php foreach ($data['projectImages'] as $projectImage) { ?>
                <div class="box">
                    <form action="?c=portfolio&a=aktualizujObrazok&id=<?= $projectImage->getId() ?>" method="post">
                        <button class="btn btn-update"><i class="bi bi-arrow-repeat"></i></button>
                    </form>
                    <!-- <form action="?c=portfolio&a=deleteImage&id=<? /*= $projectImage->getId() */ ?>" method="post">-->
                    <button onclick="deleteFromPortfolio(<?= $projectImage->getId() ?>,this)" class="btn-close"
                            aria-label="Close"></button>
                    <!--</form>-->
                    <img  src="<?= \App\Config\Configuration::UPLOAD_DIR . $projectImage->getImage() ?>"
                         alt="Obrazok loga">
                    <div class="detail"><?= $projectImage->getName() ?></div>
                </div>


            <?php } ?>


        </div>
    </section>
    <section>
        <div class="container">
            <h2>Komentáre</h2>
            <div class="card-deck">
                <?php foreach ($data['comments'] as $comments) { ?>
                    <div class="card">

                        <div class="card-body">

                            <p class="card-text"><?= $comments->getText() ?></p>
                            <p class="card-text" style="text-align: right"><small
                                        class="text-muted"><?= $comments->getAuthor() ?></small></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php if ($data['comments'] == null) { ?>
                <p>Zatiaľ bez komentárov</p>
            <?php } ?>
        </div>


    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-4 offset-sm-4">
                    <h2 style="text-align: center">Pridanie obrázka</h2>
                    <form method="post" enctype="multipart/form-data"

                          action="?c=portfolio&a=uploadIntoProject&id=<?= $_GET['id'] ?>">
                        <div>
                            <div class="mb-3">
                                <label for="form2" class="form-label">Titulný obrázok</label>
                                <input name="titleImage" class="form-control"  type="file" id="form2">
                            </div>
                            <div class="mb3">
                                <label for="validationDefault01" class="form-label">Názov</label>
                                <input name="name" type="text" class="form-control" id="validationDefault01" value=""
                                >
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="mbtn stred">Pridať</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</main>