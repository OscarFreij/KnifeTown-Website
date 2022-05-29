<div class="col">
    <div class="card h-100">
        <?php
            if (is_null($item['imageURL']))
            {
                ?>
                <svg class="bd-placeholder-img card-img-top" width="100%" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#868e96"></rect>
                    <text x="50%" y="50%" fill="#dee2e6" dy=".3em" dominant-baseline="middle" text-anchor="middle">
                        Placeholder Image
                    </text>
                </svg>
                <?php
            }
            else
            {
                ?>
                <img class="card-img-top" src="<?=$item['imageURL']?>" alt="pictue of product" width="100%" height="140">
                <?php
            }
        ?>
        <div class="card-body">
            <h5 class="card-title"><?=$item['name']?></h5>
            <p class="card-text"><?=$item['description']?></p>
        </div>
        <div class="card-footer">
            <small class="text-muted"><?=$item['price']?> kr</small>
        </div>
    </div>
</div>