<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var array<\App\Models\Hotel> $hotels
 */
?>

<?php $view->component('start'); ?>

    <main>
        <div class="container">
            <h3 class="mt-3">Отели</h3>
            <hr>
            <div class="movies">
                <?php foreach ($hotels as $hotel) { ?>
                    <?php $view->component('hotel', ['hotel' => $hotel]); ?>
                <?php } ?>
            </div>
        </div>
    </main>

<?php $view->component('end'); ?>