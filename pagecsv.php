<div class="wrap">
    <?php
    echo '<h1 class="wp-heading-inline">'.get_admin_page_title().'</h1>';
    $plugindir= plugin_dir_path(__FILE__);
    $pluginName = explode("/", $plugindir);
    ?>

    <br><br><br>
    <?php
  require_once('../wp-load.php');
  $cat=get_categories();
  $pages=get_pages();
    if (isset($_GET['message'])) {
        ?>
    <div id="message" class="notice notice-success is-dismissible">
        <p><?php echo $_GET['message']?>.</p><button type="button" class="notice-dismiss"><span
                class="screen-reader-text">Descartar este aviso.</span></button>
    </div>
    <?php
    }
  ?>
    <form name="uploadCsv" id="uploadCsv" class="validate" enctype="multipart/form-data" method="POST"
        action="<?php echo site_url().'/wp-content/plugins/'.$pluginName[count($pluginName)-2].'/core/loadfile.php'?>">
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
                    <th scope="row">
                        <label for="ivory">ID del Ivory Search
                            <span class="description">(obligatorio)</span></label>
                        <a href="<?php echo site_url().'/wp-admin/admin.php?page=ivory-search&post=1853&action=edit'?>"
                            target="_blank">ver Ivory Search ID</a>

                    </th>
                    <td>
                        <input name="ivory" type="text" id="csv" value="" placeholder="1853" required />
                    </td>
                </tr>
                <tr class="form-field form-required">
                    <th scope="row">
                        <label for="category">Categoria de las Entradas
                            <span class="category">(obligatorio)</span></label>
                    </th>
                    <td>
                        <select name="category" required id="category">
                            <?php foreach ($cat as $value) {
      echo  '<option value="'.$value->cat_ID.'">'.$value->cat_name.'</option>';
  }?>
                        </select>
                    </td>
                </tr>
                <tr class="form-field form-required">
                    <th scope="row">
                        <label for="page">Pagina Pedre de la Publicacion
                            <span class="page">(obligatorio)</span></label>
                    </th>
                    <td>
                        <select name="page" required id="page">
                            <?php foreach ($pages as $value) {
      echo  '<option value="'.$value->ID.'">'.$value->post_title.'</option>';
  }?>
                        </select>
                    </td>
                </tr>
                <tr class="form-field form-required">
                    <th scope="row"><label for="description">Descripción por defecto </label></th>
                    <td><textarea style="color:black" id="description" disabled cols="30"
                            rows="3"><?php echo "<p><strong>Lista de precios actualizada #date </strong> para los todos los vehículos <strong> #carName </strong> en sus diferentes versiones, revise detalladamente cual es su versión correcta para que obtenga el valor comercial correcto para su vehículo y compartalo con quien desee desde el botón que se encuentra en la parte inferior.</p>"?></textarea>
                    </td>
                </tr>
                <tr class="form-field form-required">
                    <th scope="row"><label for="description">Descripción para los entradas <span
                                class="description">(Opcional)</span></label></th>
                    <td><textarea name="description" id="" cols="30" rows="10"></textarea></td>
                </tr>
                <tr class="form-field form-required">
                    <th scope="row"><label for="description2">Descripción Inferior</label></th>
                    <td>
                        <p>Si la descripción se deja vaciá no se insertara nada en la parte inferior del entradas</p>
                    </td>
                </tr>
                <tr class="form-field form-required">
                    <th scope="row"><label for="description2">Descripción Inferior para los entradas <span
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