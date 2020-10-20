<div class="wrap">
  <?php
  echo '<h1 class="wp-heading-inline">'.get_admin_page_title().'</h1>';
  ?>

  <br><br><br>
<?php
if ($_GET['message']) {
      ?>
  <div id="message" class="notice notice-success is-dismissible"><p><?php echo $_GET['message']?>.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Descartar este aviso.</span></button></div>
<?php
  }
?>
  <form name="uploadCsv" id="uploadCsv" class="validate"  enctype="multipart/form-data"
    method="POST" action="<?php echo site_url().'/wp-content/plugins/add-csv-wordpress-plugin/core/loadfile.php'?>">
    <table class="form-table" role="presentation">
      <tbody>
        <tr class="form-field form-required">
          <th scope="row">
            <label for="csv">Archivo CSV
              <span class="description">(obligatorio)</span></label>
          </th>
          <td>
            <input name="csv" type="file" id="csv" value=""
              accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
              aria-required="true" autocapitalize="none" autocorrect="off" maxlength="60" required />
          </td>
        </tr>
        <tr class="form-field form-required">
          <th scope="row"><label for="description">Descripción por defecto </label></th>
          <td><textarea  style="color:black" id="description"  disabled cols="30" rows="3"><?php echo "<p><strong>Lista de precios actualizada #date </strong> para los todos los vehículos <strong> #carName </strong> en sus diferentes versiones, revise detalladamente cual es su versión correcta para que obtenga el valor comercial correcto para su vehículo y compartalo con quien desee desde el botón que se encuentra en la parte inferior.</p>"?></textarea></td>
        </tr> 
        <tr class="form-field form-required">
          <th scope="row"><label for="description">Descripción para los post <span
                class="description">(Opcional)</span></label></th>
          <td><textarea name="description" id="" cols="30" rows="10"></textarea></td>
        </tr>
        <tr class="form-field form-required">
          <th scope="row"><label for="description2">Descripción Inferior</label></th>
          <td><p>Si la descripción se deja vaciá no se insertara nada en la parte inferior del post</p></td>
        </tr> 
        <tr class="form-field form-required">
          <th scope="row"><label for="description2">Descripción Inferior para los post <span
                class="description2">(Opcional)</span></label></th>
          <td><textarea name="description2" id="" cols="30" rows="10"></textarea></td>
        </tr>
      </tbody>
    </table>

    <p class="submit">
      <input type="submit" name="createuser" id="createusersub" class="button button-primary" value="Subir CSV" />
    </p>
  </form>
</div>