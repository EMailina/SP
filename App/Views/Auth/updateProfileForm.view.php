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

                <form onsubmit="return hesloKontrola()" class="row g-3" action="?c=auth&a=changeProfile" method="post">
                    <div class="col-md-8">
                        <label for="validationDefault01" class="form-label">Meno</label>
                        <input name="firstname" type="text" class="form-control" id="validationDefault01"
                               value="<?= $data['profil']->getFirstname() ?>" required>
                    </div>

                    <div class="col-md-8">
                        <label for="validationDefault02" class="form-label">Priezvisko</label>
                        <input name="surname" type="text" class="form-control" id="validationDefault02"
                               value="<?= $data['profil']->getLastname() ?>" required>
                    </div>

                    <div class="col-md-8">
                        <label for="exampleFormControlInput1" class="form-label">E-mail</label>
                        <input name="username" type="email" class="form-control"
                               id="exampleFormControlInput1" value="<?= $data['profil']->getUsername() ?>" required>
                    </div>

                    <!--<div class="col-md-8">
                        <label for="inputPassword4" class="form-label">Staré Heslo</label>
                        <input name="passwordOld" value="" type="password" class="form-control" id="passwd" required>
                    </div>

                    <div class="col-md-8">
                        <label for="inputPassword4" class="form-label">Nové Heslo</label>
                        <input name="password" value="" type="password" class="form-control" id="passwd" required>
                    </div>-->
                    <!--<div id="warningHeslo" class="alert alert-warning alert-dismissible fade show" role="alert">
                        <div id="info">
                            Vyplňte heslo!

                        </div>
                    </div>-->

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Uložiť zmeny</button>
                    </div>



                    <a href="?c=auth&a=updatePasswordForm">Zmeniť heslo</a>
                    <a href="?c=auth&a=deleteProfile">Vymazať profil</a>
                </form>

                <script src="public/scripty.js"></script>
            </div>


        </div>
    </div>
</main>