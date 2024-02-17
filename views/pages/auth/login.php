<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 */
?>

<?php $view->component('start_simple'); ?>

<main class="form-signin w-100 m-auto">
    <form action="/auth/login" method="post">
            <?php if ($session->has('error')) { ?>
                <div class="alert alert-danger">
                    <?php echo $session->getFlash('error') ?>
                </div>
            <?php } ?>
            <div class="d-flex" style="align-items: center; justify-content: space-between">
                <h2>Вхід</h2>
                <a href="/" class="d-flex align-items-center mb-5 mb-lg-0 text-white text-decoration-none">
                    <h5 class="m-0">Кінопошук <span class="badge bg-warning warn__badge">Lite</span></h5>
                </a>
            </div>
            <div class="form-floating mt-3 <?php echo $session->has('email') ? 'mb-1' : '' ?>">
                <input
                    type="email"
                    class="form-control <?php echo $session->has('email') ? 'is-invalid' : '' ?>"
                    name="email"
                    id="floatingInput"
                    placeholder="name@areaweb.su"
                >
                <label for="name">E-mail</label>
                <?php if ($session->has('email')) { ?>
                    <div id="name" class="invalid-feedback">
                        <?php echo $session->getFlash('email')[0] ?>
                    </div>
                <?php } ?>
            </div>
            <div class="form-floating mb-0 <?php echo $session->has('password') ? 'mb-1' : '' ?>">
                <input
                    type="password"
                    name="password"
                    class="form-control <?php echo $session->has('password') ? 'is-invalid' : '' ?>"
                    id="floatingPassword"
                    placeholder="Пароль"
                >
                <label for="name">Пароль</label>
                <?php if ($session->has('password')) { ?>
                    <div id="name" class="invalid-feedback">
                        <?php echo $session->getFlash('password')[0] ?>
                    </div>
                <?php } ?>
            </div>
           <div class="">
               <button class="btn btn-primary w-100 py-2" type="submit">Ввійти</button>
               <p class="mt-5 mb-3 text-body-secondary">&copy; Кінопошук Lite 2023</p>
           </div>
        </form>
    </main>

<?php $view->component('end_simple'); ?>