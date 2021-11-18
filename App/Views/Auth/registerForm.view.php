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
            <form class="row g-3" action="?c=auth&a=register" method="post">
                <div class="col-md-8">
                    <label for="validationDefault01" class="form-label">First name</label>
                    <input name="firstname" type="text" class="form-control" id="validationDefault01" value="Mark" required>
                </div>

                <div class="col-md-8">
                    <label for="validationDefault02" class="form-label" >Last name</label>
                    <input name="surname" type="text" class="form-control" id="validationDefault02" value="Otto" required>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input name="username" type="email" class="form-control" name="login" id="exampleFormControlInput1" required>
                </div>

                <div class="col-md-8">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="">
                </div>

                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Registrovať sa</button>
                </div>
                <a href="?c=auth&a=loginForm">Prihlásiť sa</a>
            </form>

        </div>
    </div>
</div>
</main>