<div class="col text-dark" id="item<?=$item['id']?>">
    <div class="card h-100">
        <?php
        if (is_null($item['imageData'])) {
        ?>
            <svg class="bd-placeholder-img card-img-top menuCategoryItem-picture" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#868e96"></rect>
                <text x="50%" y="50%" fill="#dee2e6" dy=".3em" dominant-baseline="middle" text-anchor="middle">
                    Placeholder Image
                </text>
            </svg>
        <?php
        } else {
        ?>
            <img class="card-img-top menuCategoryItem-picture" src="<?=urldecode(base64_decode($item['imageData']))?>" alt="pictue of product">
        <?php
        }
        ?>
        <div class="card-body">
            <div class="mb-3 row">
                <label for="item<?= $item['id'] ?>name" class="col-sm-4 col-form-label">Namn</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="item<?= $item['id'] ?>name" value="<?= $item['name'] ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="item<?= $item['id'] ?>image" class="col-sm-4 col-form-label">Bild</label>
                <div class="col-sm-8">
                    <input type="file" class="form-control-plaintext" id="item<?= $item['id'] ?>image">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="item<?= $item['id'] ?>description" class="col-sm-4 col-form-label">Beskrivning</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="item<?= $item['id'] ?>description" rows="5"><?= $item['description']?></textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="item<?= $item['id'] ?>price" class="col-sm-4 col-form-label">Pris</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="item<?= $item['id'] ?>price" value="<?= $item['price'] ?>">
                </div>
            </div>
            <button type="button" onClick="removeItem(<?= $item['id'] ?>);" class="btn btn-danger col-12">
                    Ta bort
            </button>
        </div>
    </div>
</div>