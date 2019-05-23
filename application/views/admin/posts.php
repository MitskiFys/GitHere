<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">Посты</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <?php if (empty($list)):?>
                            <p>Список постов пуст</p>
                        <?php else: ?>
                        <table class="table">
                            <tr>
                                <th>Название</th>
                                <th>Редактировать</th>
                                <th>Удалить</th>
                            </tr>
                            <?php foreach ($list as $post):?>
                                <tr>
                                    <td><?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?></td>
                                    <?php //debug($post['id']);?>
                                    <td><a href="/admin/edit/<?php echo $post['id'];?>" class="btn btn-primary">Редактировать</a> </td>
                                    <td><a href="/admin/delete/<?php echo $post['id'];?>" class="btn btn-danger">Удалить</a> </td>
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