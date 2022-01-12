<?php /** @var Array $data */ ?>
<script src="public/scripty.js"></script>
<?php if ($data['successReg'] != "") { ?>
    <script>
        successRegistration('<?= $data['successReg']?>', '<?= $_SESSION['name']?>');
    </script>

<?php } ?>
<main>
    <section class="portfolio">
        <?php if ($data['success'] != "") { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $data['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <?php if ($data['error'] != "") { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= $data['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <h2>Moje Portfólio</h2>
        <p>Pre podrobné upravenie stlačte konkrétne portfólio.</p>
        <div class="portfolio-grid">
            <?php foreach ($data['projects'] as $project) { ?>

                <a href="?c=portfolio&a=mojProjektUprava&id=<?= $project->id ?>">

                    <div class="box">
                        <form action="?c=portfolio&a=deleteProject&id=<?= $project->getId() ?>" method="post">
                            <button class="btn-close" aria-label="Close"></button>
                        </form>
                        <img src="<?= \App\Config\Configuration::UPLOAD_DIR . $project->getImage() ?>"
                             alt="Obrazok loga">
                        <div class="detail"><?= $project->getName() ?></div>
                    </div>
                </a>
            <?php } ?>
        </div>


        <div class="stred">
            <a href="?c=portfolio&a=addProject" class="mbtn stred">Pridat portfólio</a>
        </div>
    </section>
    <section class="portfolio">
        <h2>Moj profil - <?= \App\Auth::getName() ?></h2>
        <div class="stred">
            <a href="?c=auth&a=updateProfileForm" class="mbtn stred">Upraviť profil</a>
        </div>

    </section>
</main>

