<?php
/**
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var \App\Models\Hotel $hotel
 */
?>

<a href="/hotel?id=<?php echo $hotel->id() ?>" class="card text-decoration-none movies__item">
    <img src="<?php echo $storage->url($hotel->preview()) ?>" height="200px" class="card-img-top" alt="<?php echo $hotel->name() ?>">
    <div class="card-body">
        <h5 class="card-title"><?php echo $hotel->name() ?></h5>
        <p class="card-text">Оценка <span class="badge bg-warning warn__badge"><?php echo $hotel->avgRating() ?></span></p>
        <p class="card-text"><?php echo $hotel->description() ?></p>
    </div>
</a>