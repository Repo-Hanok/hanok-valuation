<div id="contenedor_form_nuevo">



<?php /* @var string $nonce_field */ ?>

<div id="mapa_valoracion_vivienda"></div>

<form id="form_valoracion_vivienda" class="comprar" method="post">

<div id="hanok_step_indicators">
  <h1 id="hanok_titulo">Valora tu vivienda</h1>
</div>

<?php echo $nonce_field; ?>

<input type="hidden" name="hanok_submit" value="1" />

<div id="form-paso-1" class="form-paso" data-meta-paso="Dirección">
  <label for="hanok_address_input_" id="hanok_address_input">
    Dirección de la propiedad:
    <input type="text" id="hanok_address_input_" name="hanok_address_input" value="" required />
  </label>
</div>

<div id="form-paso-2" class="form-paso" data-meta-paso="Interés e info sobre el lead" hidden>

  <fieldset id="hanok_comprar_interes_zona" class="hanok_radio_input">
    <legend>¿Estás interesado únicamente en este inmueble o estás valorando también sus alrededores?</legend>

    <label for="comprar_interes_zona_no">
      <input type="radio" id="comprar_interes_zona_no" name="hanok_comprar_interes_zona" value="solo_inmueble">
      <span>Sólo este inmueble</span>
    </label>

    <label for="comprar_interes_zona_si">
      <input type="radio" id="comprar_interes_zona_si" name="hanok_comprar_interes_zona" value="interes_zona">
      <span>Me interesa la zona</span>
    </label>
  </fieldset>

  <fieldset id="hanok_comprar" class="hanok_radio_input">
    <legend>¿Qué tipo de compra vas a hacer?</legend>

    <label for="hanok_comprar_primera_vivienda">
      <input type="radio" id="hanok_comprar_primera_vivienda" name="hanok_tipo_compra" value="primera_vivienda">
      <span>Primera vivienda</span>
    </label>

    <label for="hanok_comprar_segunda_residencia">
      <input type="radio" id="hanok_comprar_segunda_residencia" name="hanok_tipo_compra" value="segunda_residencia">
      <span>Segunda residencia</span>
    </label>

    <label for="hanok_comprar_cambio_vivienda">
      <input type="radio" id="hanok_comprar_cambio_vivienda" name="hanok_tipo_compra" value="cambio_vivienda">
      <span>Cambio de vivienda</span>
    </label>

    <label for="hanok_comprar_inversion">
      <input type="radio" id="hanok_comprar_inversion" name="hanok_tipo_compra" value="inversion">
      <span>Compra como inversión</span>
    </label>
  </fieldset>

  <fieldset id="hanok_hipoteca" class="hanok_radio_input" hidden>
    <legend>¿Tienes pensado solicitar una hipoteca?</legend>

    <label for="hanok_hipoteca_si">
      <input type="radio" id="hanok_hipoteca_si" name="hanok_hipoteca" value="si">
      <span>Sí, necesitaré hipoteca</span>
    </label>

    <label for="hanok_hipoteca_no">
      <input type="radio" id="hanok_hipoteca_no" name="hanok_hipoteca" value="no">
      <span>No</span>
    </label>
  </fieldset>

  <fieldset id="hanok_tasacion_oficial" class="hanok_radio_input" hidden>
    <legend>¿Estás interesado en obtener una tasación oficial para este inmueble?</legend>

    <label for="tasacion_oficial_si">
      <input type="radio" id="tasacion_oficial_si" name="hanok_tasacion_oficial" value="si">
      <span>Sí, quiero mi tasación oficial</span>
    </label>

    <label for="tasacion_oficial_no">
      <input type="radio" id="tasacion_oficial_no" name="hanok_tasacion_oficial" value="no">
      <span>No</span>
    </label>
  </fieldset>

  <fieldset id="hanok_2_viv_vender" class="hanok_radio_input" hidden>
    <legend>¿Necesitas vender tu propiedad actual para comprar la segunda?</legend>

    <label for="hanok_2_viv_vender_si">
      <input type="radio" id="hanok_2_viv_vender_si" name="hanok_2_viv_vender" value="si">
      <span>Sí, venderé mi casa</span>
    </label>

    <label for="hanok_2_viv_vender_no">
      <input type="radio" id="hanok_2_viv_vender_no" name="hanok_2_viv_vender" value="no">
      <span>No</span>
    </label>
  </fieldset>

</div>

<div id="form-paso-3" class="form-paso" data-meta-paso="Tipo de inmueble y su estado" hidden>

  <label for="hanok_superficie_" id="hanok_superficie">
    ¿Cuántos metros cuadrados tiene?
    <input type="number" id="hanok_superficie_" name="hanok_superficie" min="1" max="10000">
  </label>

  <fieldset id="hanok_dormitorios" class="hanok_radio_input">
    <legend>¿Cuántos dormitorios tiene?</legend>

    <label for="dormitorios_1">
      <input type="radio" id="dormitorios_1" name="hanok_dormitorios" value="1">
      <span>1</span>
    </label>

    <label for="dormitorios_2">
      <input type="radio" id="dormitorios_2" name="hanok_dormitorios" value="2">
      <span>2</span>
    </label>

    <label for="dormitorios_3">
      <input type="radio" id="dormitorios_3" name="hanok_dormitorios" value="3">
      <span>3</span>
    </label>

    <label for="dormitorios_4+">
      <input type="radio" id="dormitorios_4+" name="hanok_dormitorios" value="4+">
      <span>4+</span>
    </label>
  </fieldset>

  <fieldset id="hanok_wc" class="hanok_radio_input">
    <legend>¿Cuántos baños?</legend>

    <label for="wc_1">
      <input type="radio" id="wc_1" name="hanok_wc" value="1">
      <span>1</span>
    </label>

    <label for="wc_2">
      <input type="radio" id="wc_2" name="hanok_wc" value="2">
      <span>2</span>
    </label>

    <label for="wc_3+">
      <input type="radio" id="wc_3+" name="hanok_wc" value="3+">
      <span>3+</span>
    </label>
  </fieldset>

</div>

<div id="form-paso-4" class="form-paso" data-meta-paso="Tipo de inmueble y su estado" hidden>

  <fieldset id="hanok_tipo_vivienda" class="hanok_radio_input">
    <legend>¿Cómo es la vivienda?</legend>

    <label for="hanok_tipo_vivienda_piso">
      <input type="radio" id="hanok_tipo_vivienda_piso" name="hanok_tipo_vivienda" value="piso">
      <span>Piso</span>
    </label>

    <label for="hanok_tipo_vivienda_chalet_adosado">
      <input type="radio" id="hanok_tipo_vivienda_chalet_adosado" name="hanok_tipo_vivienda" value="chalet_adosado">
      <span>Chalet adosado</span>
    </label>

    <label for="hanok_tipo_vivienda_casa_independiente">
      <input type="radio" id="hanok_tipo_vivienda_casa_independiente" name="hanok_tipo_vivienda" value="casa_independiente">
      <span>Casa independiente</span>
    </label>

    <label for="hanok_tipo_vivienda_estudio">
      <input type="radio" id="hanok_tipo_vivienda_estudio" name="hanok_tipo_vivienda" value="estudio">
      <span>Estudio</span>
    </label>
  </fieldset>

  <fieldset id="hanok_antiguedad_viv" class="hanok_radio_input" hidden>
    <legend>¿Cuál es la antigüedad de la vivienda?</legend>

    <label for="antiguedad_viv_nueva">
      <input type="radio" id="antiguedad_viv_nueva" name="hanok_antiguedad_viv" value="nueva">
      <span>Nueva construcción</span>
    </label>

    <label for="antiguedad_viv_segunda_mano">
      <input type="radio" id="antiguedad_viv_segunda_mano" name="hanok_antiguedad_viv" value="segunda_mano">
      <span>Vivienda de segunda mano</span>
    </label>
  </fieldset>

  <fieldset id="hanok_estado_inmueble" class="hanok_radio_input">
    <legend>Estado general del inmueble</legend>

    <label for="condicion_excelente">
      <input type="radio" id="condicion_excelente" name="hanok_estado_inmueble" value="excelente">
      <span>Condición excelente</span>
    </label>

    <label for="condicion_aceptable">
      <input type="radio" id="condicion_aceptable" name="hanok_estado_inmueble" value="aceptable">
      <span>Aceptable</span>
    </label>

    <label for="condicion_mala">
      <input type="radio" id="condicion_mala" name="hanok_estado_inmueble" value="necesita_reforma">
      <span>Necesita reformas</span>
    </label>
  </fieldset>

</div>

<div id="form-paso-5" class="form-paso" data-meta-paso="Tipo de inmueble y su estado" hidden>

  <fieldset id="hanok_viv_extras" class="hanok_radio_input">
    <legend>¿Dispone de trastero, garaje, terraza, ascensor o piscina?</legend>

    <label for="viv_extras_si">
      <input type="radio" id="viv_extras_si" name="hanok_viv_extras" value="si">
      <span>Sí</span>
    </label>

    <label for="viv_extras_no">
      <input type="radio" id="viv_extras_no" name="hanok_viv_extras" value="no">
      <span>No</span>
    </label>
  </fieldset>

  <fieldset id="hanok_extras" class="hanok_check_group" hidden>
    <legend>Servicios de la vivienda:</legend>

    <label for="hanok_trastero">
      <input type="checkbox" name="trastero" id="hanok_trastero">
      Trastero
    </label>
    <label for="hanok_garaje">
      <input type="checkbox" name="garaje" id="hanok_garaje">
      Garaje
    </label>
    <label for="hanok_terraza">
      <input type="checkbox" name="terraza" id="hanok_terraza">
      Terraza
    </label>
    <label for="hanok_ascensor">
      <input type="checkbox" name="ascensor" id="hanok_ascensor">
      Ascensor
    </label>
    <label for="hanok_piscina">
      <input type="checkbox" name="piscina" id="hanok_piscina">
      Piscina
    </label>
  </fieldset>

  <fieldset id="hanok_cuando_comprar" class="hanok_radio_input" hidden>
    <legend>¿Cuándo te gustaría comprar tu nueva vivienda?</legend>

    <label for="cuando_comprar_ya">
      <input type="radio" id="cuando_comprar_ya" name="hanok_cuando_comprar" value="ya">
      <span>Cuanto antes</span>
    </label>

    <label for="cuando_comprar_3_6_m">
      <input type="radio" id="cuando_comprar_3_6_m" name="hanok_cuando_comprar" value="3_6_meses">
      <span>Entre 3 a 6 meses</span>
    </label>

    <label for="cuando_comprar_+6_m">
      <input type="radio" id="cuando_comprar_+6_m" name="hanok_cuando_comprar" value="+6_meses">
      <span>Más de 6 meses</span>
    </label>
  </fieldset>

  <fieldset id="hanok_interes_ahorro_suministros" class="hanok_radio_input">
    <legend>¿Estás interesado en ahorrar en tus facturas de suministros (agua, luz, gas, internet…)?</legend>

    <label for="interes_ahorro_suministros_si">
      <input type="radio" id="interes_ahorro_suministros_si" name="hanok_interes_ahorro_suministros" value="si">
      <span>Sí</span>
    </label>

    <label for="interes_ahorro_suministros_no">
      <input type="radio" id="interes_ahorro_suministros_no" name="hanok_interes_ahorro_suministros" value="no">
      <span>No</span>
    </label>
  </fieldset>

</div>

<div id="form-paso-6" class="form-paso" data-meta-paso="Datos personales" hidden>

  <label for="hanok_nombre_" id="hanok_nombre">
    Nombre:
    <input type="text" id="hanok_nombre_" name="hanok_nombre" placeholder="Nombre">
  </label>

  <label for="hanok_email_" id="hanok_email">
    Email:
    <input type="email" id="hanok_email_" name="hanok_nombre" placeholder="Correo electrónico">
  </label>

  <!-- TELEFONO -->
  <fieldset id="hanok_telefono" style="">
    <legend>Validar teléfono</legend>

    <div id="hanok_step1">
      <input type="tel" id="hanok_tel" name="hanok_tel" placeholder="Tu teléfono" style="">
      <button type="button" id="hanok_sendOtp" style="">Enviar código</button>
    </div>

    <div id="hanok_step2" style="display:none;">
      <input type="text" id="hanok_otp" placeholder="Código OTP" style="">
      <button type="button" id="hanok_verifyOtp" style="">Verificar</button>
    </div>

    <p id="hanok_msg" style=""></p>
  </fieldset>

  <fieldset class="tratamientos-sutil hanok_check_group">
    <label for="aceptacion-politica">
      <input type="checkbox" name="politica" id="aceptacion-politica" required>
      He leído y acepto la
      <a href="/politica-privacidad" target="_blank" rel="noreferrer noopener">Política de Privacidad</a>
      <img class="icono-privacidad popup-privacidad sg-popup-id-4144" src="http://valoracionvivienda.com/wp-content/uploads/2024/10/icono-priv.svg" alt="Icono de información">
    </label>

    <label for="aceptacion-comercial">
      <input type="checkbox" name="comercial" id="aceptacion-comercial">
      Acepto recibir comunicaciones comerciales para completar el informe.
    </label>

    <label for="aceptacion-partners">
      <input type="checkbox" name="partners" id="aceptacion-partners">
      Consiento la comunicación de mis datos personales a los colaboradores del sector vivienda con los que Valoración Vivienda tenga acuerdos suscritos, para recibir comunicaciones adaptadas a mis intereses.
    </label>
  </fieldset>

</div>

<div id="hanok_ui">
  <button id="hanok_ui_back" type="button" onclick="" hidden>Volver</button>
  <button id="hanok_ui_submit" type="submit" hidden>Obtener valoración</button>
  <button id="hanok_ui_next" type="button" onclick="">Siguiente</button>
</div>

</form>

<div id="hanok_procesando_datos" hidden>
  Espere mientras procesamos los datos de su vivienda.
</div>

</div>

