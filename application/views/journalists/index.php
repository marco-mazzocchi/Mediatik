<nav class="navbar navbar-default navbar-fixed-top toolbar">
  <div class="container-fluid">
     <ul class="nav navbar-nav navbar-right">
        <li>
           <a href="/index.php/journalists/create" title="Crea giornalista"><span class="glyphicon glyphicon-plus"></span> Crea un nuovo giornalista</a>
        </li>
        <li>
           <a href="#" id="copy-to-clipboard" title="Copia negli appunti"><span class="glyphicon glyphicon-copy"></span> Copia negli appunti</a>
        </li>
        <li>
           <a href="#" id="filter-btn" title="Mostra i filtri"><span class="glyphicon glyphicon-filter"></span> Mostra i filtri</a>
        </li>
  </div>
</nav>

<div id="journalists"></div>


<div class="modal fade" id="email-address-list-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Elenco email selezionate</h4>
      </div>
      <div class="modal-body">
        <p id="email-address-list-text"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>
        <button type="button" class="btn btn-primary clipboard" data-clipboard-target="#email-address-list-text"  data-dismiss="modal">Copia e chiudi</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<select id="hidden-province-option-list" class="hidden">
   <?php $province = null; ?>
   <?php include('application/views/templates/provinces.php') ?>
</select>
