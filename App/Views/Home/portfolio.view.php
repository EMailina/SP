<?php /** @var Array $data */ ?>
<main>
    <div class="navigation-space"></div>

    <div class="container">
        <div class="row">
            <?php foreach ($data['projects'] as $project) { ?>
            <div class="card mb-5 " style="max-width: 1000px;">
                <div class="row g-0">
                    <div class="col-md-2" >
                        <img src="<?= \App\Config\Configuration::UPLOAD_DIR . $project->getImage() ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">   <?= $project->getName() ?></h5>
                            <p class="card-text">   <?= $project->getText() ?></p>
                            <p class="card-text"><small class="text-muted">   <?= $project->getUser() ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <!--<section class="portfolio">
        <h2> Portfólio</h2>


        <p>Tu môžete vidieť časť nášho portfólia, v ktorom nájdete všetko od loga, letákov pre rôzne firmy až po vektorovú
            grafiku.</p>
        <h2> Logá</h2>


        <div class="portfolio-grid">
            <div class="box">
                <img src="public/Obrazky/logo3.png" alt="Obrazok loga">
                <div class="detail">Music logo</div>
            </div>

            <div class="box">
                <img src="public/Obrazky/logo6.png" alt="Obrazok loga">
                <div class="detail">Photography by 7ven logo</div>
            </div>

            <div class="box">
                <img src="public/Obrazky/logo4.png" alt="Obrazok loga">
                <div class="detail">Homemade honey logo</div>
            </div>

            <div class="box">
                <img src="public/Obrazky/logo5.png" alt="Obrazok loga">
                <div class="detail">Yoga logo</div>
            </div>

            <div class="box">
                <img src="public/Obrazky/logo7.png" alt="Obrazok loga">
                <div class="detail">Chess club logo</div>
            </div>

            <div class="box">
                <img src="public/Obrazky/logo8.png" alt="Obrazok loga">
                <div class="detail">Cycle shop logo</div>
            </div>

            <div class="box">
                <img src="public/Obrazky/logo9.png" alt="Obrazok loga">
                <div class="detail">Solar Panels logo</div>
            </div>

            <div class="box">
                <img src="public/Obrazky/logo10.png" alt="Obrazok loga">
                <div class="detail">Tree planting logo</div>
            </div>

            <div class="box">
                <img src="public/Obrazky/logo11.png" alt="Obrazok loga">
                <div class="detail">Pumpa logo</div>
            </div>

            <div class="box">
                <img src="public/Obrazky/logo2.png" alt="Obrazok loga">
                <div class="detail">Music logo</div>
            </div>

            <div class="box">
                <img src="public/Obrazky/logo12.png" alt="Obrazok loga">
                <div class="detail">Dolphin logo</div>
            </div>

            <div class="box">
                <img src="public/Obrazky/logo13.png" alt="Obrazok loga">
                <div class="detail">Economic solutions logo</div>
            </div>

            <div class="box">
                <img src="public/Obrazky/logo14.jpg" alt="Obrazok loga">
                <div class="detail">Palstav logo</div>
            </div>



            <div class="box">
                <img src="public/Obrazky/logo16.png" alt="Obrazok loga">
                <div class="detail">Trnava logo</div>
            </div>


        </div>

    </section>

    <section class="portfolio">
        <h2> Vektorové Obrázky</h2>


        <div class="portfolio-grid">
            <div class="box-wide">
                <img src="public/Obrazky/coffeeTime.png" alt="Obrazok loga">
                <div class="detail">Coffee</div>
            </div>

            <div class="box-wide">
                <img src="public/Obrazky/Ferrari.png" alt="Obrazok loga">
                <div class="detail">Ferrari</div>
            </div>

            <div class="box-wide">
                <img src="public/Obrazky/paris.png" alt="Obrazok loga">
                <div class="detail">Paris</div>
            </div>

            <div class="box-wide">
                <img src="public/Obrazky/outlineAnimals.png" alt="Obrazok loga">
                <div class="detail">Animals</div>
            </div>
        </div>

    </section>-->
</main>






