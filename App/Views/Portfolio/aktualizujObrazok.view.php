<?php /** @var Array $data */ ?>


<main>

    <section class="portfolio">

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
        <h2>Aktuálny obrázok</h2>
        <div class="portfolio-grid">
            <div class="box">

                <img src="<?= \App\Config\Configuration::UPLOAD_DIR . $data['project']->getImage() ?>"
                     alt="Obrazok loga">
                <div class="detail"><?= $data['project']->getName() ?></div>
            </div>

        </div>

    </section>

    <section>
        <div class="row">
            <div class="col-sm-4 offset-sm-4">
                <h2 style="text-align: center">Úprava Obrázka</h2>
                <form method="post" enctype="multipart/form-data"
                      action="?c=portfolio&a=aktualizujObrazokVPortfoliu&id=<?= $data['project']->getId() ?>">
                    <div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Obrázok</label>
                            <input name="titleImage" class="form-control" id="formFile" type="file">
                        </div>
                        <div class="mb3">
                            <label for="validationDefault01" class="form-label">Názov</label>
                            <input name="name" type="text" class="form-control" id="validationDefault01"
                                   value="<?= $data['project']->getName() ?>">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="mbtn stred">Pridať</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
</main>