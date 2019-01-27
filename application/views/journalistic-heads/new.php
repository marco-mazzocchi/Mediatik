<div class="col-sm-4 well">

   <?php echo validation_errors(); ?>

   <?php echo form_open("journalistic-heads", array('class' => 'form')); ?>

   <fieldset>
      <legend>Crea una nuova testata giornalistica</legend>

      <div class="form-group">
         <input type="text" class="form-control" id="name" name="name" placeholder="Nuovo testata">
      </div>

      <div class="checkbox">
         <label>
            <input type="checkbox" id="national_circulation" name="national_circulation" value="1"> Tiratura nazionale
         </label>
      </div>

      <div class="form-group">
         <label>Città</label>
         <select class="form-control" id="province" name="province">
            <?php include('application/views/templates/provinces.php') ?>
         </select>
      </div>

      <div class="form-group">
         <label>Periodicità</label>
         <select class="form-control" id="periodicity" name="periodicity">
            <option>Seleziona</option>
            <?php foreach($periocity_types as $periodicity): ?>
               <option value="<?= $periodicity->id ?>"><?= $periodicity->name ?></option>
            <?php endforeach; ?>
         </select>
      </div>

      <div class="form-group">
         <label>Tipi di media</label>
         <select id="media_types" name="media_types[]" data-placeholder="Seleziona i tipi di media" multiple class="chosen-select form-control">
            <?php foreach($media_types as $media_type): ?>
               <option value="<?= $media_type->id ?>"><?= $media_type->name ?></option>
            <?php endforeach; ?>
         </select>
      </div>

      <div class="form-group">
         <textarea class="form-control" id="notes" name="notes" placeholder="Note"></textarea>
      </div>

      <div class="form-group">
         <button type="submit" name="submit" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus"></span> Crea</button>
      </div>

   </fieldset>
</form>

</div>
