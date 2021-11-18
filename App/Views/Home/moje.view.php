<?php /** @var Array $data */ ?>

<main>
    <!--<section class="portfolio">
    <div class="portfolio-grid">
        <?php /*foreach ($data['projects'] as $project) { */?>
        <div class="box">
            <img src="<?/*= \App\Config\Configuration::UPLOAD_DIR . $project->getImage() */?>" alt="Obrazok loga">
            <div class="detail"><?/*= $project->getName() */?></div>
        </div>
        <?php /*} */?>
    </div>
    </section>-->
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-start flex-wrap">
                <?php foreach ($data['projects'] as $project) { ?>
                    <a href="?c=home&a=mojProjektUprava&id=<?=$project->id?>">
                        <p>

                        </p>
                    <div class="card" style="width: 18rem; margin: 5px">

                        <img  src="<?= \App\Config\Configuration::UPLOAD_DIR . $project->getImage() ?>" class="card-img-top" alt="...">

                        <div class="card-body">


                                <div class="text-start mt-2">
                                    <?= $project->getName() ?>
                                </div>

                        </div>
                    </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>

    </section>
    <div class="stred">
        <a href="?c=home&a=addProject" class="btn stred">Pridat portfólio</a>
    </div>

</main>

