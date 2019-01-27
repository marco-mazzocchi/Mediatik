<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
    <?php echo validation_errors(); ?>

      <?php echo form_open("journalistic-heads/$journalistic_head->id/edit", array('class' => 'form-horizontal')); ?>

         <fieldset>

            <div class="form-group">
               <label for="name" class="col-sm-2 control-label">Nome</label>
               <div class="col-sm-10">
                   <input type="text" class="form-control" id="name" name="name" value="<?= $journalistic_head->name ?>">
               </div>
            </div>

            <div class="form-group">
                <label for="national_circulation" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <div class="checkbox">
                      <label>
                        <?php $checked = ($journalistic_head->national_circulation === "1") ? 'checked' : ''; ?>
                        <input type="checkbox" id="national_circulation" name="national_circulation" value="1" <?= $checked ?>> Tiratura nazionale
                      </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="province" class="col-sm-2 control-label">Città</label>
                <div class="col-sm-10">
                   <select class="form-control" id="province" name="province">
                     <?php include('application/views/templates/provinces.php') ?>
                   </select>
                </div>
            </div>

            <div class="form-group">
                <label for="periodicity" class="col-sm-2 control-label">Periodicità</label>
                <div class="col-sm-10">
                   <select class="form-control" id="periodicity" name="periodicity">
                     <option>Seleziona</option>
                     <?php foreach($periocity_types as $periodicity): ?>
                         <?php
                         $selected = ($periodicity->id == $journalistic_head->periodicity) ? 'selected' : '';
                         ?>
                       <option value="<?= $periodicity->id ?>" <?= $selected ?>><?= $periodicity->name ?></option>
                     <?php endforeach; ?>
                   </select>
                </div>
            </div>

            <div class="form-group">
               <label for="media_types[]" class="col-sm-2 control-label">Tipi di media</label>
               <div class="col-sm-10">
                  <select id="media_types" name="media_types[]" data-placeholder="Seleziona i tipi di media" multiple class="chosen-select form-control">
                    <?php foreach($media_types as $media_type): ?>
                       <?php
                           $selected = in_array($media_type->id, $journalistic_head_media_types) ? 'selected' : '';
                       ?>
                      <option value="<?= $media_type->id ?>" <?= $selected ?>><?= $media_type->name ?></option>
                    <?php endforeach; ?>
                  </select>
               </div>
            </div>

            <div class="form-group">
                <label for="notes" class="col-sm-2 control-label">Note</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="notes" name="notes"><?= $journalistic_head->notes ?></textarea>
                </div>
            </div>

            <div class="form-group">
              <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Aggiorna</button>
            </div>

         </fieldset>
      </form>
</div>
</div>
