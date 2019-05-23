<div class="content-wrapper">
    <div class="container-fluid ">
        <div class="card mb-3">
            <div class="alert alert-light" role="alert">
                <form action="/account/add" method="post">
                    <div class="form-group col-md-0">
                        <div class="text-secondary font-weight-bold text-left">Имя:</div>
                        <input class="form-control" type="text" name="name" placeholder="Name">
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Добавить</button>
                </form>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <?php if (empty($list)):?>
                            <p>Список постов пуст</p>
                        <?php else: ?>
                            <table class="table">
                                <tr>
                                    <th>Название</th>
                                    <th>Удалить</th>
                                </tr>
                                <?php foreach ($list as $post):?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?></td>
                                        <?php //debug($post['id']);?>
                                        <td><a href="/account/delete/<?php echo $post['id'];?>" class="btn btn-danger">Удалить</a> </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php endif; ?>
                        <?php //debug($list);?>
                        <?php echo $pagination?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>