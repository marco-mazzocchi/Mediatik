<h2>Giornalisti che collaborano con la testata</h2>
<table class="table table-bordered table-striped">
   <thead>
      <th>Nome</th>
      <th>Cognome</th>
      <th>E-mail</th>
      <th></th>
   </thead>
   <tbody>
      <?php foreach($journalists as $journalist): ?>
         <tr>
            <td><?= $journalist->name ?></td>
            <td><?= $journalist->surname ?></td>
            <td><?= $journalist->email ?></td>
            <td class="text-right">
               <a href="/index.php/journalists/<?= $journalist->id ?>/edit" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
         </td>
      </tr>
   <?php endforeach; ?>
</tbody>
</table>
