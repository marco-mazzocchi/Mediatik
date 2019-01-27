<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('news/create'); ?>

    <label for="title">Title</label>
    <input type="input" name="title" class="form-control" /><br />

    <label for="text">Text</label>
    <textarea name="text" class="form-control"></textarea><br />

    <button type="submit" name="submit" class="btn btn-primary">Create news item</button>

</form>
