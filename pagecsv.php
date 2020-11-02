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
                            rows="15">
        <?php echo "<p>A continuación, encontrarás la <strong>Lista de precios actualizada a #date</strong> para todas las referencias de Automovil <strong>#carName</strong> en sus diferentes versiones distribuidos en Colombia, (precios de vehículos en otros países), seleccione el valor comercial correcto.

        El precio o valor comercial es útil para calcular el valor asegurable de su Automovil sin incluir el costo de los accesorios (partes no originales del vehículo). El valor asegurado también es útil si quieres hacer un crédito de vehículo, puesto que sobre este valor es que las entidades financieras o bancos te realizarán el préstamo de vehículo.
    
        <strong>El valor comercial del #carName</strong> es solo una guía, si estás pensando en vender tu vehículo, aunque este precio es aproximado a la realidad, será la oferta, la demanda y el estado de tu vehículo quien determine el precio real de venta.

        Estos precios tienen una validez de 30 días desde la fecha de actualización.
    </p>';"?></textarea>
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