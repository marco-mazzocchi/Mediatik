<div class="col-sm-3 col-sm-offset-1 well">

  <?php echo validation_errors(); ?>

  <?php echo form_open("media-types", array('class' => 'form-inline')); ?>

     <fieldset>
        <legend>Crea un nuovo tipo di media</legend>

        <div class="form-group">
           <input type="text" class="form-control" id="name" name="name" placeholder="Nuovo tipo di media">
        </div>

        <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></button>

     </fieldset>
  </form>

</div>
