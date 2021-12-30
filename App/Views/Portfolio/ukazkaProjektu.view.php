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

            <h2> <?= $p = \App\Models\Project::getOne($data['id'])->getName(); ?></h2>
            <p><?= $p = \App\Models\Project::getOne($data['id'])->getText(); ?></p>
            <?php if ($data['projectImages'] == null) { ?>
                <p>Portfólio je zatial prázdne.</p>
            <?php } ?>

            <div class="portfolio-grid">
                <?php foreach ($data['projectImages'] as $projectImage) { ?>
                    <div class="box">
                        <img src="<?= \App\Config\Configuration::UPLOAD_DIR . $projectImage->getImage() ?>"
                             alt="Obrazok loga">
                        <div class="detail"><?= $projectImage->getName() ?></div>
                    </div>
                <?php } ?>
            </div>
        </div>

    </section>


    <section class="portfolio">


        <h2>Hodnotenie</h2>
        <p>Priemerné hodnotenie: <?= \App\Portfolio::getPriemerRating() ?>
        </p>
        <!--kod hviezdiciek mierne upraveny (zdroj) = https://codepen.io/GeoffreyCrofte/pen/jEkBL-->
        <?php if (\App\Auth::isLogged()) { ?>

            <div class="rating rating2">
                <a class="<?= ($data['rating'] != null) ? (($data['rating'] >= 5) ? "stars" : "") : "" ?>"
                   href="?c=portfolio&a=addRating&id=<?= $data['id'] ?>&rating=5>" title="Give 5 stars">★</a>
                <a class="<?= ($data['rating'] != null) ? (($data['rating'] >= 4) ? "stars" : "") : "" ?>"
                   href="?c=portfolio&a=addRating&id=<?= $data['id'] ?>&rating=4>" title="Give 4 stars">★</a>
                <a class="<?= ($data['rating'] != null) ? (($data['rating'] >= 3) ? "stars" : "") : "" ?>"
                   href="?c=portfolio&a=addRating&id=<?= $data['id'] ?>&rating=3>" title="Give 3 stars">★</a>
                <a class="<?= ($data['rating'] != null) ? (($data['rating'] >= 2) ? "stars" : "") : "" ?>"
                   href="?c=portfolio&a=addRating&id=<?= $data['id'] ?>&rating=2>" title="Give 2 stars">★</a>
                <a class="<?= ($data['rating'] != null) ? (($data['rating'] >= 1) ? "stars" : "") : "" ?>"
                   href="?c=portfolio&a=addRating&id=<?= $data['id'] ?>&rating=1>" title="Give 1 star">★</a>
            </div>
            <?php
        } ?>

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


            <form method="post" enctype="multipart/form-data"
                  action="?c=portfolio&a=addComment&id=<?= $data['id'] ?>">


                <div class="input-group mb-3">
                    <input name="comment" type="text" class="form-control" placeholder="Komentár"
                           aria-label="Recipient's username"
                           aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">uverejniť</button>
                    </div>
                </div>


            </form>
        </div>
        <!--</section>
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-start flex-wrap">
                <?php /*foreach ($data['projectImages'] as $projectImage) { */ ?>

                    <div class="card" style="width: 18rem; margin: 5px">

                        <img src="<? /*= \App\Config\Configuration::UPLOAD_DIR . $projectImage->getImage() */ ?>"
                             class="card-img-top" alt="...">

                        <div class="card-body ">
                            <? /*=$projectImage->getName()*/ ?>


                        </div>
                    </div>
                <?php /*} */ ?>
            </div>
        </div>
    </div>

    </section>-->
    </section>

    <!--<div class="stred">
        <a href="?c=home&a=addProject" class="btn stred">Pridať Obrázok</a>
    </div>-->
</main>