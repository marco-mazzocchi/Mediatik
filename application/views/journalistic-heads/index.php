<div class="col-sm-8">
    <table class="table table-bordered table-striped">
        <thead>
            <th>Nome</th>
            <th>Nazionale</th>
            <th>Città</th>
            <th>Periodicità</th>
            <th>Tipi di media</th>
            <th>Note</th>
            <th></th>
        </thead>
        <tbody>
            <?php foreach($journalistic_heads as $journalistic_head): ?>
                <tr>
                    <td><?= $journalistic_head->name ?></td>
                    <td><?= $journalistic_head->national_circulation == 1 ? 'si' : 'no' ?></td>
                    <td><?= $journalistic_head->province ?></td>
                    <td><?= $journalistic_head->periodicity_name ?></td>
                    <td><?= $journalistic_head->media_types ?></td>
                    <td><?= $journalistic_head->notes ?></td>
                    <td class="text-right">
                       <a href="/index.php/journalistic-heads/<?= $journalistic_head->id ?>" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></a>
                        <a href="/index.php/journalistic-heads/<?= $journalistic_head->id ?>/edit" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                        <?php echo form_open("journalistic-heads/{$journalistic_head->id}/delete", array('class' => 'form-inline inline-block')); ?>
                            <button type="submit" class="btn btn-danger confirm-required" data-message="Sei sicuro di voler rimuovere questa testata?"><span class="glyphicon glyphicon-trash"></span></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
