<?php /** @var Array $data */ ?>
<main>
    <div class="navigation-space"></div>
    <section style="margin-bottom: 80px;">
        <div class="container">

            <h2> Portfólio</h2>


            <p>Tu môžete vidieť portfóliá prihlásených uživateľov, v ktorom nájdete všetko od loga, letákov pre rôzne
                firmy
                až po vektorovú
                grafiku. Takže ponorte sa do sveta grafiky a inšpirujte sa.</p>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <?php foreach ($data['projects'] as $project) { ?>
                    <a href="?c=portfolio&a=ukazkaProjektu&id=<?= $project->getId() ?>">
                        <div class="card mb-5 " style="max-width: 100%;">
                            <div class="row g-0">
                                <div class="col-md-2">
                                    <img src="<?= \App\Config\Configuration::UPLOAD_DIR . $project->getImage() ?>"
                                         class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">   <?= $project->getName() ?></h5>
                                        <p class="card-text">   <?= $project->getText() ?></p>
                                        <p class="card-text"><small
                                                    class="text-muted">   <?= $project->getUser() ?></small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                <?php } ?>
            </div>

        </div>
    </section>

</main>






