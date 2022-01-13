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
        <p>Priemerné hodnotenie:
            <span id="rating"><?= \App\Models\Project::getOne($data['id'])->getPriemerRating();?>
            </span>
        </p>
        <!--kod hviezdiciek mierne upraveny (zdroj) = https://codepen.io/GeoffreyCrofte/pen/jEkBL-->
        <?php if (\App\Auth::isLogged()) { ?>

            <div class="rating rating2">
                <a id="star5" class="<?= ($data['rating'] != null) ? (($data['rating'] >= 5) ? "stars" : "") : "" ?>"
                   onclick="pridajRating(<?= $data['id'] ?>,5,<?= \App\Models\Project::getOne($data['id'])->getPocetRatingov() ?>,<?= \App\Models\Project::getOne($data['id'])->getSumuRatingov() ?>)"
                   title="Give 5 stars">★</a>
                <a id="star4" class="<?= ($data['rating'] != null) ? (($data['rating'] >= 4) ? "stars" : "") : "" ?>"
                   onclick="pridajRating(<?= $data['id'] ?>,4,<?= \App\Models\Project::getOne($data['id'])->getPocetRatingov() ?>,<?= \App\Models\Project::getOne($data['id'])->getSumuRatingov() ?>)"
                   title="Give 4 stars">★</a>
                <a id="star3" class="<?= ($data['rating'] != null) ? (($data['rating'] >= 3) ? "stars" : "") : "" ?>"
                   onclick="pridajRating(<?= $data['id'] ?>,3,<?= \App\Models\Project::getOne($data['id'])->getPocetRatingov() ?>,<?= \App\Models\Project::getOne($data['id'])->getSumuRatingov() ?>)"
                    title="Give 3 stars">★</a>
                <a id="star2" class="<?= ($data['rating'] != null) ? (($data['rating'] >= 2) ? "stars" : "") : "" ?>"
                   onclick="pridajRating(<?= $data['id'] ?>,2,<?= \App\Models\Project::getOne($data['id'])->getPocetRatingov() ?>,<?= \App\Models\Project::getOne($data['id'])->getSumuRatingov() ?>)"
                    title="Give 2 stars">★</a>
                <a id="star1" class="<?= ($data['rating'] != null) ? (($data['rating'] >= 1) ? "stars" : "") : "" ?>"
                   onclick="pridajRating(<?= $data['id'] ?>,1,<?= \App\Models\Project::getOne($data['id'])->getPocetRatingov() ?>,<?= \App\Models\Project::getOne($data['id'])->getSumuRatingov() ?>)"
                   title="Give 1 star">★</a>
            </div>
            <?php
        } ?>

    </section>


    <section>

        <div class="container">
            <h2>Komentáre</h2>
            <div id="cardDeck" class="card-deck">
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


            <form id="form" method="post" enctype="multipart/form-data">



                <div class="input-group mb-3">
                    <input id="komentar" name="comment" type="text" class="form-control" placeholder="Komentár"
                           aria-label="Recipient's username">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary"
                                onclick="pridajKomentar(<?= $data['id'] ?>, '<?= \App\Models\Registration::getOne($_SESSION['id'])->getNameAndLastName() ?>')"
                                type="button">uverejniť
                        </button>
                    </div>
                </div>


            </form>
        </div>

    </section>

</main>