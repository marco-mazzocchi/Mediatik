<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <?php echo validation_errors("<div class='alert alert-warning'>", "</div>"); ?>

        <?php echo form_open("journalists/create", array('class' => 'form-horizontal')); ?>

        <fieldset>
            <legend>Informazioni generale</legend>

            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name">
                </div>
            </div>

            <div class="form-group">
                <label for="surname" class="col-sm-2 control-label">Cognome</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="surname" name="surname">
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="col-sm-2 control-label">Indirizzo residenza</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address">
                </div>
            </div>

            <div class="form-group">
                <label for="city" class="col-sm-2 control-label">Città residenza</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="city" name="city">
                </div>
            </div>

            <div class="form-group">
                <label for="province" class="col-sm-2 control-label">Provincia</label>
                <div class="col-sm-4">
                    <select class="form-control chosen-select" id="province" name="province">
                        <?php include('application/views/templates/provinces.php') ?>
                    </select>
                </div>

                <label for="postal_code" class="col-sm-3 control-label">Codice postale</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="postal_code" name="postal_code">
                </div>
            </div>

            <div class="form-group">
                <label for="notes" class="col-sm-2 control-label">Note</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="notes" name="notes"></textarea>
                </div>
            </div>

        </fieldset>

        <fieldset>
            <legend>Contatti</legend>

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email">
                    <small class="text-muted">L'indirizzo email non deve essere già presente in archivio</small>
                </div>
            </div>

            <div class="form-group">
                <label for="phone" class="col-sm-2 control-label">Telefono</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
            </div>

            <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Cellulare</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="mobile" name="mobile">
                </div>
            </div>

            <div class="form-group">
                <label for="fax" class="col-sm-2 control-label">Fax</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="fax" name="fax">
                </div>
            </div>

        </fieldset>

        <fieldset>

            <legend>Categorie e filtri</legend>

            <div class="form-group">
                <label for="ranking" class="col-sm-2 control-label">Ranking</label>
                <div class="col-sm-10 star-rating-wrapper">
                    <?php for($i = 1; $i <= 10; $i++) {
                        $checked = ($i == 1) ? 'checked' : '';
                    ?>
                    <input type="radio" name="ranking" value="<?= $i ?>" class="rating" <?= $checked ?>>
                    <?php } ?>
                </div>
            </div>

            <div class="form-group">
                <label for="ranking" class="col-sm-2 control-label">Categorie</label>
                <div class="col-sm-10">
                    <select name="categories[]" data-placeholder="Seleziona le categorie..." multiple class="chosen-select form-control">
                        <?php foreach($categories as $category): ?>
                            <option value="<?= $category->id ?>"><?= $category->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="journalistic_heads[]" class="col-sm-2 control-label">Testate con cui collabora</label>
                <div class="col-sm-10">
                    <select name="journalistic_heads[]" data-placeholder="Seleziona le testate..." multiple class="chosen-select form-control">
                        <?php foreach($journalistic_heads as $journalistic_head): ?>
                            <option value="<?= $journalistic_head->id ?>"><?= $journalistic_head->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

        </fieldset>

        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2 text-right">
                <button type="submit" name="submit" class="btn btn-primary">Crea giornalista</button>
            </div>
        </div>

    </form>
</div>
</div>
