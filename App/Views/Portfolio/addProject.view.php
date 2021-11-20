<?php /** @var Array $data */ ?>
<main>
<div class="row">
    <div class="col-sm-4 offset-sm-4">
        <?php if ($data['error'] != "") { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= $data['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <form method="post" enctype="multipart/form-data" action="?c=portfolio&a=upload">
            <div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Titulný obrázok</label>
                    <input name="titleImage" class="form-control" id="formFile" type="file">
                </div>
                <div class="col-md-8">
                    <label for="validationDefault01" class="form-label">Názov</label>
                    <input name="name" type="text" class="form-control" id="validationDefault01" value="" required>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Popis</label>
                    <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <!--<div class="mb-3">
                    <label for="formFile1" class="form-label1">Obrázky</label>
                    <input name="file1" class="form-control" id="formFile1" type="file" multiple>
                </div>-->
                <div class="mb-3">
                    <button type="submit" class="mbtn ">Vytvoriť</button>
                </div>
            </div>

        </form>
    </div>
</div>
    </main>