<?php /** @var Array $data */ ?>

<main>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 offset-sm-4">
                <h2>Úprava profilu</h2>
                <?php if ($data['error'] != "") { ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= $data['error'] ?>
                    </div>
                <?php } ?>

                <?php if ($data['success'] != "") { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $data['success'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>

                <form onsubmit="return hesloKontrola()" class="row g-3" action="?c=auth&a=updatePassword" method="post">

                    <div class="col-md-8">
                        <label for="passwd1" class="form-label">Staré Heslo</label>
                        <input name="passwordOld" value="" type="password" class="form-control" id="passwd1" required>
                    </div>

                    <div class="col-md-8">
                        <label for="passwd" class="form-label">Nové Heslo</label>
                        <input name="password" value="" type="password" class="form-control" id="passwd" required>
                    </div>
                    <div id="warningHeslo" class="alert alert-warning alert-dismissible fade show" role="alert">
                        <div id="info">
                            Vyplňte heslo!

                        </div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Uložiť zmeny</button>
                    </div>



                    <a href="?c=auth&a=updateProfileForm">Zmeniť osobné údaje</a>

                </form>

                <script src="public/scripty.js"></script>
            </div>


        </div>
    </div>
</main>