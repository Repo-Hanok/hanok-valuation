<div id="contenedor_form_nuevo">

<?php /* @var string $nonce_field */ ?>
<div id="mapa_valoracion_vivienda"></div>
<form id="form_valoracion_vivienda" method="post">

  <?php echo $nonce_field; ?>
  <input type="hidden" name="hanok_submit" value="1" />


  <div id="form-paso-1" class="form-paso" data-meta-paso="Dirección">

      <label for="hanok_address_input_" id="hanok_address_input">Dirección de la propiedad:
        <input type="text" id="hanok_address_input_" name="hanok_address_input" value="" required />
      </label>
  </div>





  <div id="form-paso-2" class="form-paso" data-meta-paso="Interés e info sobre el lead" hidden>

    <fieldset id="hanok_interes" class="hanok_radio_input">
      <legend>¿Qué te interesa?</legend>
      <label for="hanok_interes_vender">
        Vender inmueble
        <input type="radio" id="hanok_interes_vender" name="hanok_interes" value="vender" />
      </label>
      <label for="hanok_interes_alquilar">
        Poner en alquiler
        <input type="radio" id="hanok_interes_alquilar" name="hanok_interes" value="alquilar" />
      </label>
      <label for="hanok_interes_comprar">
        Comprar
        <input type="radio" id="hanok_interes_comprar" name="hanok_interes" value="comprar" />
      </label>
      <label for="hanok_interes_info">
        Informarme
        <input type="radio" id="hanok_interes_info" name="hanok_interes" value="info" />
      </label>
    </fieldset>



    <fieldset id="hanok_cuando_vender" class="hanok_radio_input" hidden>
      <legend>¿Cuándo tienes pensado vender tu vivienda?</legend>
      <label for="hanok_cuando_vender_ya">
        Ya está en venta
        <input type="radio" id="hanok_cuando_vender_ya" name="hanok_cuando_vender" value="ya" />
      </label>
      <label for="hanok_cuando_vender_cuanto_antes">
        Cuanto antes
        <input type="radio" id="hanok_cuando_vender_cuanto_antes" name="hanok_cuando_vender" value="cuanto_antes" />
      </label>
      <label for="hanok_cuando_vender_3_a_6_meses">
        En 3 a 6 meses
        <input type="radio" id="hanok_cuando_vender_3_a_6_meses" name="hanok_cuando_vender" value="3_a_6_meses" />
      </label>
      <label for="hanok_cuando_vender_mas_6_meses">
        Más de 6 meses
        <input type="radio" id="hanok_cuando_vender_mas_6_meses" name="hanok_cuando_vender" value="mas_6_meses" />
      </label>
    </fieldset>

    <fieldset id="hanok_donde_casa_anunciada" class="hanok_radio_input" hidden>
      <legend>¿Dónde la tienes anunciada?</legend>
      <label for="hanok_anunciada_plataformas">
        En plataformas digitales (Idealista, Fotocasa...)
        <input type="radio" id="hanok_anunciada_plataformas" name="hanok_donde_casa_anunciada" value="anunciada_en_plataformas" >
      </label>
      <label for="hanok_anunciada_rrss">
        En redes sociales
        <input type="radio" id="hanok_anunciada_rrss" name="hanok_donde_casa_anunciada" value="anunciada_en_rrss" >
      </label>
      <label for="hanok_anunciada_inmobiliaria">
        Con una inmobiliaria
        <input type="radio" id="hanok_anunciada_inmobiliaria" name="hanok_donde_casa_anunciada" value="anunciada_en_inmobiliaria" >
      </label>
    </fieldset>

    <fieldset id="hanok_venta_exclusiva" class="hanok_radio_input" hidden>
      <legend>¿La tienes con exclusiva?</legend>
      <label for="hanok_venta_exclusiva_si">
        Sí, con exclusiva
        <input type="radio" id="hanok_venta_exclusiva_si" name="hanok_venta_exclusiva" value="si" >
      </label>
      <label for="hanok_venta_exclusiva_no">
        No, sin exclusiva
        <input type="radio" id="hanok_venta_exclusiva_no" name="hanok_venta_exclusiva" value="no" >
      </label>
    </fieldset>

      <label for="hanok_exclusiva_cuantos_meses_" id="hanok_exclusiva_cuantos_meses" hidden>
        ¿Durante cuántos meses?
        <input type="number" id="hanok_exclusiva_cuantos_meses_" name="hanok_exclusiva_cuantos_meses" min="1" max="100" />
      </label>


    
    <fieldset id="hanok_motivo_vender" class="hanok_radio_input" hidden>
      <legend>¿Cuál es el motivo principal por el que quieres vender?</legend>
      <label for="hanok_motivo_cambio_casa">
        Cambio de casa
        <input type="radio" id="hanok_motivo_cambio_casa" name="hanok_motivo_vender" value="cambio_casa" >
      </label>
      <label for="hanok_motivo_necesidad_economica">
        Necesidad económica
        <input type="radio" id="hanok_motivo_necesidad_economica" name="hanok_motivo_vender" value="necesidad_economica" >
      </label>
      <label for="hanok_motivo_herencia">
        Herencia
        <input type="radio" id="hanok_motivo_herencia" name="hanok_motivo_vender" value="herencia" >
      </label>
      <label for="hanok_motivo_cambio_ciudad">
        Cambio de ciudad/trabajo
        <input type="radio" id="hanok_motivo_cambio_ciudad" name="hanok_motivo_vender" value="cambio_ciudad" >
      </label>
      <label for="hanok_motivo_otro">
        Otro
        <input type="radio" id="hanok_motivo_otro" name="hanok_motivo_vender" value="otro" >
      </label>
    </fieldset>

    <fieldset id="hanok_motivo_3m" class="hanok_radio_input" hidden>
      <legend>¿Por qué estás esperando ese plazo?</legend>
      <label for="hanok_mot_3m_reforma">
        Estoy reformando la vivienda
        <input type="radio" id="hanok_mot_3m_reforma" name="hanok_motivo_3m" value="reforma" >
      </label>
      <label for="hanok_mot_3m_mejor_valoracion">
        Esperando una mejor valoración del mercado
        <input type="radio" id="hanok_mot_3m_mejor_valoracion" name="hanok_motivo_3m" value="mejor_valoracion" >
      </label>
      <label for="hanok_mot_3m_asuntos_pers">
        Asuntos personales o familiares
        <input type="radio" id="hanok_mot_3m_asuntos_pers" name="hanok_motivo_3m" value="asuntos_personales" >
      </label>
      <label for="hanok_mot_3m_otro">
        Otro
        <input type="radio" id="hanok_mot_3m_otro" name="hanok_motivo_3m" value="otro" >
      </label>
    </fieldset>

    <fieldset id="hanok_mot_6m" class="hanok_radio_input" hidden>
      <legend>¿Cuál es la razón de esperar más de 6 meses?</legend>
      <label for="hanok_mot_6m_no_prisa">
        No tengo prisa
        <input type="radio" id="hanok_mot_6m_no_prisa" name="hanok_mot_6m" value="no_prisa" >
      </label>
      <label for="hanok_mot_6m_situacion_legal">
        Estoy esperando una herencia/divorcio/situación legal
        <input type="radio" id="hanok_mot_6m_situacion_legal" name="hanok_mot_6m" value="situacion_legal" >
      </label>
      <label for="hanok_mot_6m_segunda_viv">
        Es una segunda vivienda
        <input type="radio" id="hanok_mot_6m_segunda_viv" name="hanok_mot_6m" value="segunda_vivienda" >
      </label>
      <label for="hanok_mot_6m_otro">
        Otro
      <input type="radio" id="hanok_mot_6m_otro" name="hanok_mot_6m" value="otro" >
      </label>
    </fieldset>



    <fieldset id="hanok_motivo_info" class="hanok_radio_input" hidden>
      <legend>¿Por qué motivo estás interesado en conocer el valor de tu vivienda?</legend>
      <label for="motivo_info_vender">
        Estoy pensando vender a corto-medio plazo
        <input type="radio" id="motivo_info_vender" name="hanok_motivo_info" value="vender_medio_plazo" >
      </label>
      <label for="motivo_info_vender_futuro">
        Quiero obtener una referencia del valor de mercado con el fin de vender en un futuro
        <input type="radio" id="motivo_info_vender_futuro" name="hanok_motivo_info" value="vender_futuro" >
      </label>
      <label for="motivo_info_comprar">
        Estoy comparando para comprar
        <input type="radio" id="motivo_info_comprar" name="hanok_motivo_info" value="comprar" >
      </label>
      <label for="motivo_info_info">
        Otro
        <input type="radio" id="motivo_info_info" name="hanok_motivo_info" value="info" >
      </label>
    </fieldset>


    <fieldset id="hanok_comprar" class="hanok_radio_input" hidden>
      <legend>¿Qué tipo de compra vas a hacer?</legend>
      <label for="hanok_comprar_primera_vivienda">
        Primera vivienda
        <input type="radio" id="hanok_comprar_primera_vivienda" name="hanok_tipo_compra" value="primera_vivienda" />
      </label>
      <label for="hanok_comprar_segunda_residencia">
        Segunda residencia
        <input type="radio" id="hanok_comprar_segunda_residencia" name="hanok_tipo_compra" value="segunda_residencia" />
      </label>
      <label for="hanok_comprar_cambio_vivienda">
        Cambio de vivienda
        <input type="radio" id="hanok_comprar_cambio_vivienda" name="hanok_tipo_compra" value="cambio_vivienda" />
      </label>
      <label for="hanok_comprar_inversion">
        Compra como inversión
        <input type="radio" id="hanok_comprar_inversion" name="hanok_tipo_compra" value="inversion" />
      </label>
    </fieldset>

    <fieldset id="hanok_hipoteca" class="hanok_radio_input" hidden>
      <legend>¿Tienes pensado solicitar una hipoteca?</legend>
      <label for="hanok_hipoteca_si">
        Sí, necesitaré hipoteca
        <input type="radio" id="hanok_hipoteca_si" name="hanok_hipoteca" value="si" >
      </label>
      <label for="hanok_hipoteca_no">
        No
        <input type="radio" id="hanok_hipoteca_no" name="hanok_hipoteca" value="no" >
      </label>
    </fieldset>

    <fieldset id="hanok_gesvalt" class="hanok_radio_input" hidden>
      <legend>¿Quieres aprovechar el descuento y tasar tu vivienda con GESVALT?</legend>
      <details>
        <summary>
          Si vas a financiar tu compra, el banco exigirá una tasación oficial
          homologada por el Banco de España para determinar el valor real del inmueble.
        </summary>
        📌 Beneficios de tasar ahora:
        ✅ Acelera la aprobación de tu hipoteca.
        ✅ Te da poder de negociación.
      </details>
      <label for="hanok_gesvalt_si">
        Sí, quiero mi tasación con descuento
        <input type="radio" id="hanok_gesvalt_si" name="hanok_gesvalt" value="si" >
      </label>
      <label for="hanok_gesvalt_no">
        No, gracias
        <input type="radio" id="hanok_gesvalt_no" name="hanok_gesvalt" value="no" >
      </label>
    </fieldset>


    <fieldset id="hanok_2_viv_vender" class="hanok_radio_input" hidden>
      <legend>¿Necesitas vender tu propiedad actual para comprar la segunda?</legend>
      <label for="hanok_2_viv_vender_si">
        Sí, venderé mi casa
        <input type="radio" id="hanok_2_viv_vender_si" name="hanok_2_viv_vender" value="si" >
      </label>
      <label for="hanok_2_viv_vender_no">
        No
        <input type="radio" id="hanok_2_viv_vender_no" name="hanok_2_viv_vender" value="no" >
      </label>
    </fieldset>


  </div>




  <div id="form-paso-3" class="form-paso" data-meta-paso="Tipo de inmueble y su estado" hidden>
      <label for="hanok_precio_esperado_" id="hanok_precio_esperado" hidden>
        ¿Tienes un precio en mente por el que te gustaría vender?
        <input type="number" id="hanok_precio_esperado_" name="hanok_precio_esperado" min="1" max="10000000" />
      </label>

    <fieldset id="hanok_tipo_vivienda" class="hanok_radio_input">
      <legend>¿Cómo es la vivienda?</legend>
      <label for="hanok_tipo_vivienda_piso">
        Piso
        <input type="radio" id="hanok_tipo_vivienda_piso" name="hanok_tipo_vivienda" value="piso" />
      </label>
      <label for="hanok_tipo_vivienda_chalet_adosado">
        Chalet adosado
        <input type="radio" id="hanok_tipo_vivienda_chalet_adosado" name="hanok_tipo_vivienda" value="chalet_adosado" />
      </label>
      <label for="hanok_tipo_vivienda_casa_independiente">
        Casa independiente
        <input type="radio" id="hanok_tipo_vivienda_casa_independiente" name="hanok_tipo_vivienda" value="casa_independiente" />
      </label>
    </fieldset>

    <fieldset id="hanok_estado_inmueble" class="hanok_radio_input">
      <legend>Estado general del inmueble</legend>
      <label for="condicion_excelente">
        Condición excelente
        <input type="radio" id="condicion_excelente" name="hanok_estado_inmueble" value="excelente" >
      </label>
      <label for="condicion_aceptable">
        Aceptable
        <input type="radio" id="condicion_aceptable" name="hanok_estado_inmueble" value="aceptable" >
      </label>
      <label for="condicion_mala">
        Necesita reformas
        <input type="radio" id="condicion_mala" name="hanok_estado_inmueble" value="necesita_reforma" >
      </label>
    </fieldset>

    <fieldset id="hanok_reforma" class="hanok_radio_input" hidden>
      <legend>¿Tienes pensado reformar la vivienda tras la compra?</legend>
      <label for="reforma_si">
        Sí, quiero reformarla
        <input type="radio" id="reforma_si" name="hanok_reforma" value="si" >
      </label>
      <label for="reforma_no_se">
        No lo sé aún
        <input type="radio" id="reforma_no_se" name="hanok_reforma" value="no" >
      </label>
      <label for="reforma_no">
        No
        <input type="radio" id="reforma_no" name="hanok_reforma" value="no_se" >
      </label>
    </fieldset>


  </div>


    
  <div id="form-paso-4" class="form-paso" data-meta-paso="Tipo de inmueble y su estado" hidden>

      <label for="hanok_superficie_" id="hanok_superficie">
        Superficie en metros cuadrados (m2)
        <input type="number" id="hanok_superficie_" name="hanok_superficie" min="1" max="10000" />
      </label>


    <fieldset id="hanok_dormitorios" class="hanok_radio_input">
      <legend>¿Cuántos dormitorios tiene?</legend>
      <label for="dormitorios_1">
        1
        <input type="radio" id="dormitorios_1" name="hanok_dormitorios" value="1" >
      </label>
      <label for="dormitorios_2">
        2
        <input type="radio" id="dormitorios_2" name="hanok_dormitorios" value="2" >
      </label>
      <label for="dormitorios_3">
        3
        <input type="radio" id="dormitorios_3" name="hanok_dormitorios" value="3" >
      </label>
      <label for="dormitorios_4+">
        4+
        <input type="radio" id="dormitorios_4+" name="hanok_dormitorios" value="4+" >
      </label>
    </fieldset>


    <fieldset id="hanok_wc" class="hanok_radio_input">
      <legend>¿Cuántos baños?</legend>
      <label for="wc_1">
        1
        <input type="radio" id="wc_1" name="hanok_wc" value="1" >
      </label>
      <label for="wc_2">
        2
        <input type="radio" id="wc_2" name="hanok_wc" value="2" >
      </label>
      <label for="wc_3+">
        3+
        <input type="radio" id="wc_3+" name="hanok_wc" value="3+" >
      </label>
    </fieldset>
    
  </div>




  <div id="form-paso-5" class="form-paso" data-meta-paso="Datos personales" hidden>
        <label for="hanok_nombre_" id="hanok_nombre">
          Nombre:
          <input type="text" id="hanok_nombre_" placeholder="Nombre">
        </label>

      <label for="hanok_email_" id="hanok_email">
        Email:
        <input type="email" id="hanok_email_" placeholder="Correo electrónico">
      </label>

        <!-- TELEFONO -->
        <fieldset id="hanok_telefono" style="max-width:320px;padding:1rem;border:1px solid #ccc;">
          <legend>Validar teléfono</legend>

          <div id="hanok_step1">
            <input type="tel" id="hanok_tel" placeholder="Tu teléfono" style="width:100%;padding:0.5rem;margin-bottom:0.5rem;">
            <button type="button" id="hanok_sendOtp" style="width:100%;padding:0.5rem;">Enviar código</button>
          </div>

          <div id="hanok_step2" style="display:none;">
            <input type="text" id="hanok_otp" placeholder="Código OTP" style="width:100%;padding:0.5rem;margin-bottom:0.5rem;">
            <button type="button" id="hanok_verifyOtp" style="width:100%;padding:0.5rem;">Verificar</button>
          </div>

          <p id="hanok_msg" style="margin-top:0.5rem;font-size:0.9rem;"></p>
        </fieldset>

        <script>
        let otpSessionToken = null;
        const $ = (id)=>document.getElementById(id);
        const msg = $('hanok_msg');


        $('hanok_sendOtp').onclick = async () => {
          const telefono = $('hanok_tel').value.trim();
          if (!telefono) return msg.textContent = 'Introduce un número.';
          msg.textContent = 'Enviando código...';

          const res = await fetch('/wp-json/hanok/v1/phone/init', {
            method:'POST', headers:{'Content-Type':'application/json'},
            body: JSON.stringify({ telefono })
          });
          const data = await res.json();
          if (data.ok) {
            otpSessionToken = data.session;
            msg.textContent = data.message || 'Código enviado.';
            $('hanok_step1').style.display = 'none';
            $('hanok_step2').style.display = '';
          } else {
            msg.textContent = data.message || 'No se pudo enviar el código.';
          }
        };

        $('hanok_verifyOtp').onclick = async () => {
          const code = $('hanok_otp').value.trim();
          if (!code) return msg.textContent = 'Introduce el código.';

          msg.textContent = 'Verificando...';
          const res = await fetch('/wp-json/hanok/v1/phone/verify', {
            method:'POST', headers:{'Content-Type':'application/json'},
            body: JSON.stringify({ session: otpSessionToken, code })
          });
          const data = await res.json();
          msg.textContent = data.message || (data.ok ? 'OK' : 'Error');
          if (data.ok) {
            // aquí ya puedes habilitar el siguiente paso del formulario principal
            window.hanok.tlfOK = true
            telefono.dispatchEvent('click')
          }
        };
        </script>




      <label for="hanok_politicas_" id="hanok_politicas">
        <input type="checkbox" id="hanok_politicas_" value="politicas" /> Acepto todos los tratamientos
      </label>

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
<!-- /////////////////////////////////////////////////////////////////////////////////// ->

<fieldset id="_______" class="hanok_radio_input" hidden>
  <legend>__________</legend>
  <label for="_______">
    <input type="radio" id="______" name="_______" value="________" >
  </label>
  <label for="_______">
    <input type="radio" id="______" name="_______" value="________" >
  </label>
  <label for="_______">
    <input type="radio" id="______" name="_______" value="________" >
  </label>
</fieldset>

<!- /////////////////////////////////////////////////////////////////////////////////// -->
