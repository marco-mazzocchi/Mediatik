<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <?php echo validation_errors(); ?>

        <?php echo form_open("categories/{$category->id}/edit", array('class' => 'form-horizontal')); ?>

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Nome</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="<?= $category->name ?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2 text-right">
                <button type="submit" name="submit" class="btn btn-primary">Aggiorna</button>
            </div>
        </div>

    </form>
</div>
</div>
