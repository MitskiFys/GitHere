<header class="masthead" style="background-image: url('/public/images/home-b.jpg')">
    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-md-10 mx-auto">

                <div class="site-heading">

                    <?php if (empty($_SESSION['authorize']['id'])):?>
                        <h2>Ваш личный помощник при покупках</h2>
                        <h5>Войдите или зарегистрируйтеь для создания или редактировния списка покупок</h5>
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#Login">Войти</button>
                        <div class="modal fade " id="Login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-primary" id="exampleModalLabel">Авторизация</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/account/login" method="post">
                                            <div class="form-group">
                                                <div class="text-secondary font-weight-bold text-left">Логин:</div>
                                                <input class="form-control" type="text" name="login" placeholder="Login">
                                            </div>
                                            <div class="form-group">
                                                <div class="text-secondary font-weight-bold text-left">Пароль:</div>
                                                <input class="form-control" type="password" name="password" placeholder="Password">
                                            </div>
                                            <button type="submit" class="btn btn-outline-primary">Login</button>
                                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#Register">Регистрация</button>
                        <div class="modal fade" id="Register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-primary" id="exampleModalLabel">Регистрация</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <form action="/account/register" method="post">
                                            <div class="form-group">
                                                <div class="text-secondary font-weight-bold text-left">Имя:</div>
                                                <input class="form-control" type="text" name="name" placeholder="Name">
                                            </div>
                                            <div class="form-group">
                                                <div class="text-secondary font-weight-bold text-left">Фамилия:</div>
                                                <input class="form-control" type="text" name="surname" placeholder="Surname">
                                            </div>
                                            <div class="form-group">
                                                <div class="text-secondary font-weight-bold text-left">Логин:</div>
                                                <input class="form-control" type="text" name="login" placeholder="Login">
                                            </div>
                                            <div class="form-group">
                                                <div class="text-secondary font-weight-bold text-left">E-mail:</div>
                                                <input class="form-control" type="email" name="email" placeholder="example@example.com">
                                            </div>
                                            <div class="form-group">
                                                <div class="text-secondary font-weight-bold text-left">Пароль:</div>
                                                <input class="form-control" type="password" name="firstPassword" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <div class="text-secondary font-weight-bold text-left">Повторите пароль:</div>
                                                <input class="form-control" type="password" name="secondPassword" placeholder="Confirm password">
                                            </div>
                                            <button type="submit" class="btn btn-outline-primary">Login</button>
                                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <h2><?php echo $name?></h2>
                    <h5>Здесь вы можете отредактировать свой список покупок...</h5>
                    <a href="/account/list">
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#Login">Список покупок</button>
                    </a>
                        <a href="/maphere/view">
                            <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#Login">Карта</button>
                        </a>
                    <a href="/account/logout">
                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#Login">Выйти</button>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">

            <?php if (empty($list)):?>
                <p>Список постов пуст</p>
            <?php else: ?>
                <?php foreach ($list as $post):?>
                        <div class="post-preview">
                            <a href="/post/<?php echo $post['id']; ?>">

                                <h2 class="post-title"><?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?></h2>

                                <h5 class="post-subtitle"><?php echo htmlspecialchars($post['description'], ENT_QUOTES); ?></h5>
                            </a>
                            <p class="post-meta">Идентфикатор этого поста <?php echo $post['id']; ?></p>
                        </div>
                <hr>
                <?php endforeach; ?>
                <div class="clearfix">
                    <?php echo $pagination; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>