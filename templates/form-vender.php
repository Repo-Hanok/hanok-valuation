<div id="contenedor_form_nuevo">



<?php /* @var string $nonce_field */ ?>

<div id="mapa_valoracion_vivienda"></div>

<form id="form_valoracion_vivienda" class="vender" method="post">

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

    <fieldset id="hanok_cuando_vender" class="hanok_radio_input">
      <legend>¿Cuándo tienes pensado vender tu vivienda?</legend>

      <label for="hanok_cuando_vender_ya">
        <input type="radio" id="hanok_cuando_vender_ya" name="hanok_cuando_vender" value="ya" />
        <span>Ya está en venta</span>
      </label>

      <label for="hanok_cuando_vender_cuanto_antes">
        <input type="radio" id="hanok_cuando_vender_cuanto_antes" name="hanok_cuando_vender" value="cuanto_antes" />
        <span>Cuanto antes</span>
      </label>

      <label for="hanok_cuando_vender_3_a_6_meses">
        <input type="radio" id="hanok_cuando_vender_3_a_6_meses" name="hanok_cuando_vender" value="3_a_6_meses" />
        <span>En 3 a 6 meses</span>
      </label>

      <label for="hanok_cuando_vender_mas_6_meses">
        <input type="radio" id="hanok_cuando_vender_mas_6_meses" name="hanok_cuando_vender" value="mas_6_meses" />
        <span>Más de 6 meses</span>
      </label>
    </fieldset>

    <fieldset id="hanok_donde_casa_anunciada" class="hanok_radio_input" hidden>
      <legend>¿Dónde la tienes anunciada?</legend>

      <label for="hanok_anunciada_plataformas">
        <input type="radio" id="hanok_anunciada_plataformas" name="hanok_donde_casa_anunciada" value="anunciada_en_plataformas">
        <span>En plataformas digitales (Idealista, Fotocasa...)</span>
      </label>

      <label for="hanok_anunciada_rrss">
        <input type="radio" id="hanok_anunciada_rrss" name="hanok_donde_casa_anunciada" value="anunciada_en_rrss">
        <span>En redes sociales</span>
      </label>

      <label for="hanok_anunciada_inmobiliaria">
        <input type="radio" id="hanok_anunciada_inmobiliaria" name="hanok_donde_casa_anunciada" value="anunciada_en_inmobiliaria">
        <span>Con una inmobiliaria</span>
      </label>
    </fieldset>

    <fieldset id="hanok_venta_exclusiva" class="hanok_radio_input" hidden>
      <legend>¿La tienes en exclusiva con una inmobiliaria?</legend>

      <label for="hanok_venta_exclusiva_si">
        <input type="radio" id="hanok_venta_exclusiva_si" name="hanok_venta_exclusiva" value="si">
        <span>Sí, con exclusiva</span>
      </label>

      <label for="hanok_venta_exclusiva_no">
        <input type="radio" id="hanok_venta_exclusiva_no" name="hanok_venta_exclusiva" value="no">
        <span>No, sin exclusiva</span>
      </label>
    </fieldset>

    <label for="hanok_exclusiva_cuantos_meses_" id="hanok_exclusiva_cuantos_meses" hidden>
      ¿Durante cuántos meses?
      <input type="number" id="hanok_exclusiva_cuantos_meses_" name="hanok_exclusiva_cuantos_meses" min="1" max="100" />
    </label>

    <fieldset id="hanok_motivo_vender" class="hanok_radio_input" hidden>
      <legend>¿Cuál es el motivo principal por el que quieres vender?</legend>

      <label for="hanok_motivo_cambio_casa">
        <input type="radio" id="hanok_motivo_cambio_casa" name="hanok_motivo_vender" value="cambio_casa">
        <span>Cambio de casa</span>
      </label>

      <label for="hanok_motivo_necesidad_economica">
        <input type="radio" id="hanok_motivo_necesidad_economica" name="hanok_motivo_vender" value="necesidad_economica">
        <span>Necesidad económica</span>
      </label>

      <label for="hanok_motivo_herencia">
        <input type="radio" id="hanok_motivo_herencia" name="hanok_motivo_vender" value="herencia">
        <span>Herencia</span>
      </label>

      <label for="hanok_motivo_cambio_ciudad">
        <input type="radio" id="hanok_motivo_cambio_ciudad" name="hanok_motivo_vender" value="cambio_ciudad">
        <span>Cambio de ciudad/trabajo</span>
      </label>

      <label for="hanok_motivo_otro">
        <input type="radio" id="hanok_motivo_otro" name="hanok_motivo_vender" value="otro">
        <span>Otro</span>
      </label>
    </fieldset>

    <fieldset id="hanok_motivo_3m" class="hanok_radio_input" hidden>
      <legend>¿Por qué estás esperando ese plazo?</legend>

      <label for="hanok_mot_3m_reforma">
        <input type="radio" id="hanok_mot_3m_reforma" name="hanok_motivo_3m" value="reforma">
        <span>Estoy reformando la vivienda</span>
      </label>

      <label for="hanok_mot_3m_mejor_valoracion">
        <input type="radio" id="hanok_mot_3m_mejor_valoracion" name="hanok_motivo_3m" value="mejor_valoracion">
        <span>Esperando una mejor valoración del mercado</span>
      </label>

      <label for="hanok_mot_3m_asuntos_pers">
        <input type="radio" id="hanok_mot_3m_asuntos_pers" name="hanok_motivo_3m" value="asuntos_personales">
        <span>Asuntos personales o familiares</span>
      </label>

      <label for="hanok_mot_3m_otro">
        <input type="radio" id="hanok_mot_3m_otro" name="hanok_motivo_3m" value="otro">
        <span>Otro</span>
      </label>
    </fieldset>

    <fieldset id="hanok_mot_6m" class="hanok_radio_input" hidden>
      <legend>¿Cuál es la razón de esperar más de 6 meses?</legend>

      <label for="hanok_mot_6m_no_prisa">
        <input type="radio" id="hanok_mot_6m_no_prisa" name="hanok_mot_6m" value="no_prisa">
        <span>No tengo prisa</span>
      </label>

      <label for="hanok_mot_6m_situacion_legal">
        <input type="radio" id="hanok_mot_6m_situacion_legal" name="hanok_mot_6m" value="situacion_legal">
        <span>Estoy esperando una herencia/divorcio/situación legal</span>
      </label>

      <label for="hanok_mot_6m_segunda_viv">
        <input type="radio" id="hanok_mot_6m_segunda_viv" name="hanok_mot_6m" value="segunda_vivienda">
        <span>Es una segunda vivienda</span>
      </label>

      <label for="hanok_mot_6m_otro">
        <input type="radio" id="hanok_mot_6m_otro" name="hanok_mot_6m" value="otro">
        <span>Otro</span>
      </label>
    </fieldset>

  </div>

  <div id="form-paso-3" class="form-paso" data-meta-paso="Tipo de inmueble y su estado" hidden>

    <label for="hanok_precio_esperado_" id="hanok_precio_esperado" hidden>
      Cuál es el precio por el que te gustaría vender tu vivienda?
      <input type="number" id="hanok_precio_esperado_" name="hanok_precio_esperado" min="1" max="10000000" />
    </label>

    <fieldset id="hanok_intento_venta_anterior" class="hanok_radio_input" hidden>
      <legend>¿Has intentado venderla anteriormente?</legend>

      <label for="venta_anterior_si_solo">
        <input type="radio" id="venta_anterior_si_solo" name="hanok_intento_venta_anterior" value="si_solo">
        <span>Sí, por mi cuenta</span>
      </label>

      <label for="venta_anterior_si_agencia">
        <input type="radio" id="venta_anterior_si_agencia" name="hanok_intento_venta_anterior" value="si_agencia">
        <span>Sí, por agencia</span>
      </label>

      <label for="venta_anterior_no">
        <input type="radio" id="venta_anterior_no" name="hanok_intento_venta_anterior" value="no">
        <span>No, sería la primera vez</span>
      </label>
    </fieldset>

    <fieldset id="hanok_tipo_vivienda" class="hanok_radio_input">
      <legend>¿Qué tipo de vivienda es?</legend>

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

    <fieldset id="hanok_relacion_inmueble" class="hanok_radio_input" hidden>
      <legend>¿Qué relación tienes con el inmueble?</legend>

      <label for="rel_inmueble_propi">
        <input type="radio" id="rel_inmueble_propi" name="hanok_relacion_inmueble" value="propietario">
        <span>Propietario</span>
      </label>

      <label for="rel_inmueble_inquilino">
        <input type="radio" id="rel_inmueble_inquilino" name="hanok_relacion_inmueble" value="inquilino">
        <span>Inquilino</span>
      </label>

      <label for="rel_inmueble_comprador">
        <input type="radio" id="rel_inmueble_comprador" name="hanok_relacion_inmueble" value="comprador">
        <span>Comprador</span>
      </label>

      <label for="rel_inmueble_agente">
        <input type="radio" id="rel_inmueble_agente" name="hanok_relacion_inmueble" value="agente">
        <span>Agente inmobiliario</span>
      </label>
    </fieldset>

    <fieldset id="hanok_estado_inmueble" class="hanok_radio_input">
      <legend>¿En qué estado se encuentra la vivienda?</legend>

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

  <div id="form-paso-4" class="form-paso" data-meta-paso="Tipo de inmueble y su estado" hidden>

    <label for="hanok_superficie_" id="hanok_superficie">
      ¿Cuántos metros cuadrados tiene?
      <input type="number" id="hanok_superficie_" name="hanok_superficie" min="1" max="10000" />
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

  <div id="form-paso-5" class="form-paso" data-meta-paso="Datos personales" hidden>

    <fieldset id="hanok_viv_exterior" class="hanok_radio_input">
      <legend>¿La vivienda es exterior?</legend>

      <label for="viv_exterior_si">
        <input type="radio" id="viv_exterior_si" name="hanok_viv_exterior" value="si">
        <span>Sí</span>
      </label>

      <label for="viv_exterior_no">
        <input type="radio" id="viv_exterior_no" name="hanok_viv_exterior" value="no">
        <span>No</span>
      </label>
    </fieldset>

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

    <fieldset id="hanok_viv_en_uso" class="hanok_radio_input">
      <legend>¿Hay alguien viviendo/alquilado actualmente en la vivienda?</legend>

      <label for="viv_en_uso_si">
        <input type="radio" id="viv_en_uso_si" name="hanok_viv_en_uso" value="si">
        <span>Sí</span>
      </label>

      <label for="viv_en_uso_no">
        <input type="radio" id="viv_en_uso_no" name="hanok_viv_en_uso" value="no">
        <span>No</span>
      </label>
    </fieldset>

    <fieldset id="hanok_intento_venta_anterior" class="hanok_radio_input">
      <legend>¿Has intentado venderla anteriormente?</legend>

      <label for="intento_venta_anterior_si">
        <input type="radio" id="intento_venta_anterior_si" name="hanok_intento_venta_anterior" value="si">
        <span>Sí</span>
      </label>

      <label for="intento_venta_anterior_no">
        <input type="radio" id="intento_venta_anterior_no" name="hanok_intento_venta_anterior" value="no">
        <span>No</span>
      </label>
    </fieldset>

  </div>

  <div id="form-paso-6" class="form-paso" data-meta-paso="Datos personales" hidden>

    <fieldset id="hanok_libre_de_hipoteca" class="hanok_radio_input">
      <legend>¿La vivienda está libre de hipoteca?</legend>

      <label for="libre_de_hipoteca_si">
        <input type="radio" id="libre_de_hipoteca_si" name="hanok_libre_de_hipoteca" value="si">
        <span>Sí</span>
      </label>

      <label for="libre_de_hipoteca_no">
        <input type="radio" id="libre_de_hipoteca_no" name="hanok_libre_de_hipoteca" value="no">
        <span>No</span>
      </label>
    </fieldset>

    <fieldset id="hanok_viv_okupada" class="hanok_radio_input">
      <legend>¿La vivienda está ocupada ilegalmente?</legend>

      <label for="viv_okupada_si">
        <input type="radio" id="viv_okupada_si" name="hanok_viv_okupada" value="si">
        <span>Sí</span>
      </label>

      <label for="viv_okupada_no">
        <input type="radio" id="viv_okupada_no" name="hanok_viv_okupada" value="no">
        <span>No</span>
      </label>
    </fieldset>

    <fieldset id="hanok_proceso_venta" class="hanok_radio_input">
      <legend>¿Qué es lo que más te interesa en este proceso de venta?</legend>

      <label for="proceso_venta_rapido">
        <input type="radio" id="proceso_venta_rapido" name="hanok_proceso_venta" value="vender_rapido">
        <span>Vender rápido</span>
      </label>

      <label for="proceso_venta_precio">
        <input type="radio" id="proceso_venta_precio" name="hanok_proceso_venta" value="mejor_precio">
        <span>Obtener el mejor precio</span>
      </label>

      <label for="proceso_venta_sencillo">
        <input type="radio" id="proceso_venta_sencillo" name="hanok_proceso_venta" value="proceso_sencillo">
        <span>Que el proceso sea sencillo</span>
      </label>
    </fieldset>

    <fieldset id="hanok_canal_contacto" class="hanok_radio_input">
      <legend>¿Cómo prefieres ser contactado?</legend>

      <label for="canal_contacto_llamada">
        <input type="radio" id="canal_contacto_llamada" name="hanok_canal_contacto" value="llamada">
        <span>Llamada</span>
      </label>

      <label for="canal_contacto_whatsapp">
        <input type="radio" id="canal_contacto_whatsapp" name="hanok_canal_contacto" value="whatsapp">
        <span>WhatsApp</span>
      </label>

      <label for="canal_contacto_email">
        <input type="radio" id="canal_contacto_email" name="hanok_canal_contacto" value="email">
        <span>Email</span>
      </label>
    </fieldset>

  </div>

  <div id="form-paso-7" class="form-paso" data-meta-paso="Datos personales" hidden>

    <label for="hanok_nombre_" id="hanok_nombre">
      Nombre:
      <input type="text" id="hanok_nombre_" name="hanok_nombre" placeholder="Nombre">
    </label>

    <label for="hanok_email_" id="hanok_email">
      Email:
      <input type="email" id="hanok_email_" name="hanok_email" placeholder="Correo electrónico">
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
