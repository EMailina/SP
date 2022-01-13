<?php /** @var Array $data */ ?>

<main>
<div class="container">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <?php if($data['error'] != ""){?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?= $data['error']?>
                </div>
            <?php }?>

            <form  onsubmit ="return hesloKontrola()" class="row g-3" action="?c=auth&a=register" method="post">
                <div class="col-md-8">
                    <label for="validationDefault01" class="form-label">Meno</label>
                    <input name="firstname" type="text" class="form-control" id="validationDefault01" value="" required>
                </div>

                <div class="col-md-8">
                    <label for="validationDefault02" class="form-label" >Priezvisko</label>
                    <input name="surname" type="text" class="form-control" id="validationDefault02" value="" required>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">E-mail</label>
                    <input name="username" type="email" class="form-control"  id="exampleFormControlInput1" required>
                </div>

                <div class="col-md-8">
                    <label for="passwd" class="form-label">Heslo</label>
                    <input name="password" value="" type="password" class="form-control" id="passwd" required>
                </div>
                <div id="warningHeslo" class="alert alert-warning alert-dismissible fade show" role="alert">
                    <div id="info">
                        Vyplňte heslo!

                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Registrovať sa</button>
                </div>
                <a href="?c=auth&a=loginForm">Prihlásiť sa</a>
            </form>
            <script src="public/scripty.js" ></script>
        </div>
    </div>
</div>
</main>