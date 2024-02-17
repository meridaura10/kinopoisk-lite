
<?php $view->component('start'); ?>

<main>
    <div class="container">
        <div class="one-movie">
            <div class="card mb-3 mt-3 one-movie__item">
                <div class="row g-3">
                    <div class="col-md-8">
                        <div class="card-body">
                            <img src="<?php echo $storage->url($movie->preview) ?>" height="300px" class="card-img-top" alt="<?php echo $movie->name ?>">
                            <h1 class="card-title"><?php echo $movie->name ?></h1>
                            <p class="card-text">Oцінка <span class="badge bg-warning warn__badge">7.2</span></p>
                            <p class="card-text"><?php echo $movie->description ?></p>
                            <p class="card-text"><small class="text-body-secondary">Добавлен <?php echo $movie->created_at ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $view->component('end'); ?>