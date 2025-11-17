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



      <label for="hanok_address_input_" id="hanok_address_input">Dirección de la propiedad:

        <input type="text" id="hanok_address_input_" name="hanok_address_input" value="" required />

      </label>

  </div>











  <div id="form-paso-2" class="form-paso" data-meta-paso="Interés e info sobre el lead" hidden>


    <fieldset id="hanok_comprar_interes_zona" class="hanok_radio_input" >
        <legend>¿Estás interesado únicamente en este inmueble o estás valorando también sus alrededores?</legend>
        <label for="comprar_interes_zona_no">
            Sólo este inmueble
            <input type="radio" id="comprar_interes_zona_no" name="hanok_comprar_interes_zona" value="solo_inmueble" >
        </label>
        <label for="comprar_interes_zona_si">
            Me interesa la zona
            <input type="radio" id="comprar_interes_zona_si" name="hanok_comprar_interes_zona" value="interes_zona" >
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

    <fieldset id="hanok_tasacion_oficial" class="hanok_radio_input" hidden>
      <legend>¿Estás interesado en obtener una tasación oficial para este inmueble?</legend>
      <label for="tasacion_oficial_si">
        Sí, quiero mi tasación oficial
        <input type="radio" id="tasacion_oficial_si" name="hanok_tasacion_oficial" value="si" >
      </label>
      <label for="tasacion_oficial_no">
        No
        <input type="radio" id="tasacion_oficial_no" name="hanok_tasacion_oficial" value="no" >
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




    

  
  
  
  
  <div id="form-paso-4" class="form-paso" data-meta-paso="Tipo de inmueble y su estado" hidden>

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

      
        <fieldset id="hanok_antiguedad_viv" class="hanok_radio_input" hidden>
          <legend>¿Cuál es la antigüedad de la vivienda?</legend>
          <label for="antiguedad_viv_nueva">
              Nueva construcción
              <input type="radio" id="antiguedad_viv_nueva" name="hanok_antiguedad_viv" value="nueva" >
            </label>
            <label for="antiguedad_viv_segunda_mano">
                Vivienda de segunda mano
                <input type="radio" id="antiguedad_viv_segunda_mano" name="hanok_antiguedad_viv" value="segunda_mano" >
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
        
        
        
        
    </div>

    
    <div id="form-paso-5" class="form-paso" data-meta-paso="Tipo de inmueble y su estado" hidden>
  
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


      <fieldset id="hanok_cuando_comprar" class="hanok_radio_input" hidden>
          <legend>¿Cuándo te gustaría comprar tu nueva vivienda?</legend>
          <label for="cuando_comprar_ya">
              Cuanto antes
              <input type="radio" id="cuando_comprar_ya" name="hanok_cuando_comprar" value="ya" >
          </label>
          <label for="cuando_comprar_3_6_m">
              Entre 3 a 6 meses
              <input type="radio" id="cuando_comprar_3_6_m" name="hanok_cuando_comprar" value="3_6_meses" >
          </label>
          <label for="cuando_comprar_+6_m">
              Más de 6 meses
              <input type="radio" id="cuando_comprar_+6_m" name="hanok_cuando_comprar" value="+6_meses" >
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
  
  
  
    </div>



  <div id="form-paso-6" class="form-paso" data-meta-paso="Datos personales" hidden>

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

