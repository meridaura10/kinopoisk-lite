<?php
/**
 * @var \App\Kernel\View\Contracts\ViewInterface $view
 */
?>

<?php $view->component('start'); ?>

<main>
    <div class="container">
        <h3 class="mt-3">Новинки</h3>
        <hr>
        <div class="movies">
            <?php
            foreach ($movies as $movie) {
                $view->component('movie', ['movie' => $movie]);
            }
?>
        </div>
    </div>
</main>

<?php $view->component('end'); ?>