<div class="col-sm-4 col-sm-offset-2">
    <table class="table table-bordered table-striped">
        <thead>
            <th>Nome</th>
            <th></th>
        </thead>
        <tbody>
            <?php foreach($media_types as $media_type): ?>
                <tr>
                    <td><?= $media_type->name ?></td>
                    <td class="text-right">
                        <a href="/index.php/media-types/<?= $media_type->id ?>/edit" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                        <?php echo form_open("media-types/{$media_type->id}/delete", array('class' => 'form-inline inline-block')); ?>
                            <button type="submit" class="btn btn-danger confirm-required" data-message="Sei sicuro di voler rimuovere questo tipo di media?"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
