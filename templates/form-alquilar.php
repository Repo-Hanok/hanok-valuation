<div id="contenedor_form_nuevo">



<?php /* @var string $nonce_field */ ?>

<div id="mapa_valoracion_vivienda"></div>

<form id="form_valoracion_vivienda" class="alquilar" method="post">

<div id="hanok_step_indicators">

  <h1 id="hanok_titulo">Valora tu vivienda</h1>
</div>

  <?php echo $nonce_field; ?>

  <input type="hidden" name="hanok_submit" value="1" />





  <div id="form-paso-1" class="form-paso" data-meta-paso="Dirección">



      <label for="hanok_address_input_" id="hanok_address_input">¿Dónde se encuentra la vivienda?

        <input type="text" id="hanok_address_input_" name="hanok_address_input" value="" required />

      </label>

  </div>



<!--////// -->
  <div id="form-paso-2" class="form-paso" data-meta-paso="Dirección" hidden>

    <label for="hanok_precio_alquiler_" id="hanok_precio_alquiler">
        ¿Por cuánto dinero te gustaría alquilar tu vivienda al mes?
        <input type="number" id="hanok_precio_alquiler_" name="hanok_precio_alquiler" min="1" max="10000000" />
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
      <label for="hanok_tipo_vivienda_estudio">

        Estudio

        <input type="radio" id="hanok_tipo_vivienda_estudio" name="hanok_tipo_vivienda" value="estudio" />

      </label>

    </fieldset>


    <fieldset id="hanok_estado_inmueble" class="hanok_radio_input">

      <legend>¿En qué estado se encuentra la vivienda?</legend>

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

  </div>


<!--////// -->
  <div id="form-paso-3" class="form-paso" data-meta-paso="Dirección" hidden>
    <label for="hanok_superficie_" id="hanok_superficie">

        ¿Cuántos metros cuadrados tiene?

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

<!--////// -->
  <div id="form-paso-4" class="form-paso" data-meta-paso="Dirección" hidden>

    <fieldset id="hanok_viv_amueblada" class="hanok_radio_input">
      <legend>¿Está amueblada?</legend>
      <label for="viv_amueblada_si">
        Sí
        <input type="radio" id="viv_amueblada_si" name="hanok_viv_amueblada" value="si" >
      </label>
      <label for="viv_amueblada_no">
        No
        <input type="radio" id="viv_amueblada_no" name="hanok_viv_amueblada" value="no" >
      </label>
    </fieldset>

    <fieldset id="hanok_viv_extras" class="hanok_radio_input" >
        <legend>¿Dispone de trastero, garaje, terraza, ascensor o piscina?</legend>
        <label for="viv_extras_si">
            Sí
            <input type="radio" id="viv_extras_si" name="hanok_viv_extras" value="si" >
        </label>
        <label for="viv_extras_no">
            No
            <input type="radio" id="viv_extras_no" name="hanok_viv_extras" value="no" >
        </label>
    </fieldset>

  </div>

<!--////// -->
  <div id="form-paso-5" class="form-paso" data-meta-paso="Dirección" hidden>

    <fieldset id="hanok_alquiler_parcial" class="hanok_radio_input" >
      <legend>¿Quieres alquilar la vivienda entera o por habitaciones?
      </legend>
      <label for="alquiler_parcial_no">
        Alquiler de la vivienda entera
        <input type="radio" id="alquiler_parcial_no" name="hanok_alquiler_parcial" value="viv_entera" >
      </label>
      <label for="alquiler_parcial_si">
        Alquiler por habitaciones
        <input type="radio" id="alquiler_parcial_si" name="hanok_alquiler_parcial" value="por_habitaciones" >
      </label>
    </fieldset>

    <fieldset id="hanok_alquiler_temporada" class="hanok_radio_input" >
      <legend>¿Va a ser alquiler de temporada o de larga estancia?
      </legend>
      <label for="alquiler_temporada">
        Temporada
        <input type="radio" id="alquiler_temporada" name="hanok_alquiler_temporada" value="temporada" >
      </label>
      <label for="alquiler_larga_estancia">
        Larga estancia
        <input type="radio" id="alquiler_larga_estancia" name="hanok_alquiler_temporada" value="larga_estancia" >
      </label>
    </fieldset>

    <fieldset id="hanok_tiempo_alquiler" class="hanok_radio_input" hidden>
      <legend>¿Durante cuánto tiempo quieres alquilar tu vivienda?</legend>
      <label for="tiempo_alquiler_1_ano">
        1 año
        <input type="radio" id="tiempo_alquiler_1_ano" name="hanok_tiempo_alquiler" value="1_ano" >
      </label>
      <label for="tiempo_alquiler_3_anos">
        3 años
        <input type="radio" id="tiempo_alquiler_3_anos" name="hanok_tiempo_alquiler" value="3_anos" >
      </label>
      <label for="tiempo_alquiler_+5_anos">
        +5 años
        <input type="radio" id="tiempo_alquiler_+5_anos" name="hanok_tiempo_alquiler" value="+5_anos" >
      </label>
    </fieldset>

    <fieldset id="hanok_seguro_impago_alq" class="hanok_radio_input" >
      <legend>¿Vas a contratar un seguro de impago del alquiler?</legend>
      <label for="seguro_impago_alq_si">
        Sí
        <input type="radio" id="seguro_impago_alq_si" name="hanok_seguro_impago_alq" value="si" >
      </label>
      <label for="seguro_impago_alq_no">
        No
        <input type="radio" id="seguro_impago_alq_no" name="hanok_seguro_impago_alq" value="no" >
      </label>
      <label for="seguro_impago_alq_no_se">
        No lo sé
        <input type="radio" id="seguro_impago_alq_no_se" name="hanok_seguro_impago_alq" value="no_se" >
      </label>
    </fieldset>
  </div>


<!--////// -->
  <div id="form-paso-6" class="form-paso" data-meta-paso="Dirección" hidden>
    <fieldset id="hanok_alquiler_inicio" class="hanok_radio_input" >
      <legend>¿Cuándo te gustaría empezar a alquilarla?</legend>
      <label for="alquiler_inicio_ya">
        Cuanto antes
        <input type="radio" id="alquiler_inicio_ya" name="hanok_alquiler_inicio" value="ya" >
      </label>
      <label for="alquiler_inicio_3_6_meses">
        En los próximos 3-6 meses
        <input type="radio" id="alquiler_inicio_3_6_meses" name="hanok_alquiler_inicio" value="3_6_meses" >
      </label>
      <label for="alquiler_inicio_+6_meses">
        Dentro de más de 6 meses
        <input type="radio" id="alquiler_inicio_+6_meses" name="hanok_alquiler_inicio" value="+6_meses" >
      </label>
    </fieldset>

    <fieldset id="hanok_interes_ahorro_suministros" class="hanok_radio_input" >
      <legend>¿Estás interesado en ahorrar en tus facturas de suministros (agua, luz, gas, internet…)?</legend>
      <label for="interes_ahorro_suministros_si">
        Sí
        <input type="radio" id="interes_ahorro_suministros_si" name="hanok_interes_ahorro_suministros" value="si" >
      </label>
      <label for="interes_ahorro_suministros_no">
        No
        <input type="radio" id="interes_ahorro_suministros_no" name="hanok_interes_ahorro_suministros" value="no" >
      </label>
    </fieldset>

    <fieldset id="hanok_interes_agencia_alquiler" class="hanok_radio_input" >
      <legend>¿Estás interesado en que una agencia especializada en alquiler gestione el proceso?</legend>
      <label for="interes_agencia_alquiler_si">
        Sí
        <input type="radio" id="interes_agencia_alquiler_si" name="hanok_interes_agencia_alquiler" value="si" >
      </label>
      <label for="interes_agencia_alquiler_no">
        No
        <input type="radio" id="interes_agencia_alquiler_no" name="hanok_interes_agencia_alquiler" value="no" >
      </label>
    </fieldset>
  </div>




  <div id="form-paso-7" class="form-paso" data-meta-paso="Datos personales" hidden>

        <label for="hanok_nombre_" id="hanok_nombre">

          Nombre:

          <input type="text" id="hanok_nombre_" placeholder="Nombre">

        </label>



      <label for="hanok_email_" id="hanok_email">

        Email:

        <input type="email" id="hanok_email_" placeholder="Correo electrónico">

      </label>



        <!-- TELEFONO -->

        <fieldset id="hanok_telefono" style="">

          <legend>Validar teléfono</legend>



          <div id="hanok_step1">

            <input type="tel" id="hanok_tel" placeholder="Tu teléfono" style="">

            <button type="button" id="hanok_sendOtp" style="">Enviar código</button>

          </div>



          <div id="hanok_step2" style="display:none;">

            <input type="text" id="hanok_otp" placeholder="Código OTP" style="">

            <button type="button" id="hanok_verifyOtp" style="">Verificar</button>

          </div>



          <p id="hanok_msg" style=""></p>

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






      <span class="tratamientos-sutil">

      <label id="aceptacion-politica">
          <input type="checkbox" name="politica" required>
          He leído y acepto la 
          <a href="/politica-privacidad" target="_blank" rel="noreferrer noopener">Política de Privacidad</a>
          <img class="icono-privacidad popup-privacidad sg-popup-id-4144" src="http://valoracionvivienda.com/wp-content/uploads/2024/10/icono-priv.svg" alt="Icono de información">
      </label>

      <label id="aceptacion-comercial">
          <input type="checkbox" name="comercial">
          Acepto recibir comunicaciones comerciales para completar el informe.
      </label>

      <label id="aceptacion-partners">
          <input type="checkbox" name="partners">
          Consiento la comunicación de mis datos personales a los colaboradores del sector vivienda con los que Valoración Vivienda tenga acuerdos suscritos, para recibir comunicaciones adaptadas a mis intereses.
      </label>

      </span>




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
