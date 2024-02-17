<?php
/**
 * @var \App\Kernel\View\Contracts\ViewInterface $view
 * @var \App\Kernel\Session\Contracts\SessionInterface $session
 * @var array<\App\Models\Category> $categories
 * @var \App\Models\Movie $movie
 */
?>

<?php $view->component('start'); ?>
    <main>
        <div class="container">
            <h3 class="mt-3">Редагування фільма</h3>
            <hr>
        </div>
        <div class="container">
            <form action="/admin/movies/update" method="post" enctype="multipart/form-data" class="d-flex flex-column justify-content-center w-50 gap-2 mt-5 mb-5">
                <input type="hidden" value="<?php echo $movie->id ?>" name="id">
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input
                                type="text"
                                class="form-control <?php echo $session->has('name') ? 'is-invalid' : '' ?>"
                                id="name"
                                value="<?php echo $movie->name ?>"
                                name="name"
                                placeholder="Пацаны"
                            >
                            <label for="name">Назва</label>
                            <?php if ($session->has('name')) { ?>
                                <div id="name" class="invalid-feedback">
                                    <?php echo $session->getFlash('name')[0] ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <textarea
                                style="height: 100px"
                                type="text"
                                class="form-control <?php echo $session->has('description') ? 'is-invalid' : '' ?>"
                                id="description"
                                name="description"
                                placeholder="Крутой фильм про..."
                            ><?php echo $movie->description ?></textarea>
                            <label for="name">Опис</label>
                            <?php if ($session->has('description')) { ?>
                                <div id="name" class="invalid-feedback">
                                    <?php echo $session->getFlash('description')[0] ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="mb-3">
                            <label for="image" class="form-label">
                                Нове зображення</label>
                            <input class="form-control" type="file" name="image" id="image">
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <select class="form-select" name="category">
                        <option disabled value="null">Жанр</option>
                        <?php foreach ($categories as $category) { ?>
                            <option value="<?php echo $category->id ?>" <?php echo $category->id === $movie->category_id ? 'selected' : ''?>>
                                <?php echo $category->name ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="row g-2">
                    <button class="btn btn-success">Зберегти</button>
                </div>
            </form>
        </div>
    </main>

<?php $view->component('end'); ?>