 <div class="col-sm-3 col-sm-offset-1 well">

   <?php echo validation_errors(); ?>

   <?php echo form_open("categories/index", array('class' => 'form-inline')); ?>

      <fieldset>
         <legend>Crea una nuova categoria</legend>

         <div class="form-group">
            <input type="text" class="form-control" id="name" name="name" placeholder="Nuova categoria">
         </div>

         <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span></button>

      </fieldset>
   </form>

</div>
