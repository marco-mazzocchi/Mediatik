<div class="col-sm-4 col-sm-offset-2">
    <table class="table table-bordered table-striped">
        <thead>
            <th>Nome</th>
            <th></th>
        </thead>
        <tbody>
            <?php foreach($categories as $category): ?>
                <tr>
                    <td><?= $category->name ?></td>
                    <td class="text-right">
                        <a href="/index.php/categories/<?= $category->id ?>/edit" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                        <?php echo form_open("categories/{$category->id}/delete", array('class' => 'form-inline inline-block')); ?>
                            <button type="submit" class="btn btn-danger confirm-required" data-message="Sei sicuro di voler rimuovere questa categoria?"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
