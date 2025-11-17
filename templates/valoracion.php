<!-- hanok_template_cassandra.php -->

<div class="hanok-report">


  <!-- CAPA DE CONTENIDO ENCIMA DEL MAPA -->
  <div class="hanok-report-content">

    <?php
      // Ajusta estos nombres a lo que tengas en tu flujo
      $nombreInquilino = (isset($nombre) && $nombre !== '') ? $nombre : '____';
      $calleInmueble   = (isset($calle) && $calle !== '') ? $calle : '______';
    ?>

    <!-- CABECERA / SALUDO -->
    <header class="hanok-report-header">
      <h1 class="hanok-report-greeting">
        <span class="hanok-report-saludo">Hola <?= htmlspecialchars($nombreInquilino) ?>. Esta es la valoración de tu inmueble en:</span><br>
        <?= htmlspecialchars($calleInmueble) ?>.
      </h1>
      <p class="hanok_num_rooms" hidden>Dorm: <?php echo($dormitorios) ?></p>
      <p class="hanok_num_wc" hidden>WC: <?php echo($wc) ?></p>

    </header>

    <!-- BLOQUE PRINCIPAL: VALORACIÓN + MEDIA BARRIO -->
    <section class="hanok-report-main">



      <!-- MAPA DE FONDO -->
      <div
        class="hanok-report-map"
        id="hanok-report-map"
        data-lat="<?= esc_attr( $latitude ); ?>"
        data-lng="<?= esc_attr( $longitude ); ?>"
      ></div>



      <?php if (!empty($avm_valuation)): ?>

        <div class="hanok-report-cards">

          <!-- Caja 1: valoración inmueble -->
          <article class="hanok-report-card hanok-report-card--valoracion">
            <p class="hanok-report-title">
              Valoración estimada:
              <br>
              <b class="hanok-report-valoracion-monto">
                <?= number_format($avm_valuation, 0, ',', '.') ?> €
              </b>
      </p>
            

            <?php if (!empty($precio_m2)): ?>
              <p class="hanok-report-text">
                Precio por m²:
                <br>
                <b>
                  <?= number_format($precio_m2, 0, ',', '.') ?> €/m²
                </b>
              </p>
            <?php endif; ?>
          </article>

          <!-- Caja 2: media barrio + diferencia -->
          <article class="hanok-report-card hanok-report-card--zona">

            <?php if (!empty($precio_medio_m2)): ?>
              <p class="hanok-report-text">
                Precio medio en la zona:
                <br>
                <b>

                  <?= number_format($precio_medio_m2, 0, ',', '.') ?> €/m²
                </b>
              </p>
            <?php endif; ?>

            <?php if ($dif_precio_medio !== null): ?>
              <?php 
                $signo = $dif_precio_medio > 0 ? '+' : '';
              ?>
              <p class="hanok-report-text hanok-report-text--diferencia">
                Diferencia respecto a la media:
                  <br>
                  <b>

                    <?= $signo ?><?= $dif_precio_medio ?>%
                  </b>
              </p>
            <?php endif; ?>

          </article>

        </div><!-- /.hanok-report-cards -->

      <?php else: ?>

        <p class="hanok-report-text hanok-report-text--error">
          No se pudo calcular la valoración.
        </p>

      <?php endif; ?>

    </section>

    <!-- LISTA DE COMPARABLES -->
    <section class="hanok-report-comparables">

      <?php if (!empty($comparables)): ?>

        <h3 class="hanok-report-subtitle">
          Inmuebles similares en venta en la zona
        </h3>

        <div class="comparables-list">


        <article class="comparable-header">

              <p class="comparable-title">
                <strong>Calle:</strong>
              </p>

              <p class="comparable-text">
                <strong>Precio:</strong>
              </p>

              <p class="comparable-text">
                <strong>Superficie:</strong>
              </p>

              <p class="comparable-text">
                <strong>Habitaciones:</strong> 
              </p>

              <p class="comparable-text">
                <strong>Distancia:</strong>
              </p>

            </article>




          <?php foreach ($comparables as $c): 
            if (!empty($c['url'])) {
            
            ?>

            <article class="comparable-card">

              <p class="comparable-title">
                <?= htmlspecialchars($c['full_address'] ?? 'Dirección no disponible') ?>
            </p>

              <p class="comparable-text">
                <?= number_format($c['local_price'] ?? 0, 0, ',', '.') ?> €
              </p>

              <p class="comparable-text">
                <?= $c['area'] ?? '-' ?> m²
              </p>

              <p class="comparable-text">
                <i class="fa-solid fa-bed"></i> <?= $c['n_rooms'] ?? '-' ?>
                <span style="color:transparent">-</span>
                <i class="fa-solid fa-toilet"></i> <?= $c['n_baths'] ?? '-' ?>
              </p>

              <p class="comparable-text">
                <?= $c['distance'] ?? '-' ?> m
              </p>

              <?php if (!empty($c['url'])): ?>
                <a class="comparable-link"
                   href="<?= htmlspecialchars($c['url']) ?>" target="_blank">
                  Ver en Idealista →
                </a>
              <?php endif; ?>

            </article>
          <?php  }  endforeach;// aqui termino el if de arriba y si no hay url, no muestro el item ?>
        </div>

      <?php else: ?>

        <p class="hanok-report-text hanok-report-text--no-comparables">
          No se encontraron comparables cercanos.
        </p>

      <?php endif; ?>

    </section>

  </div><!-- /.hanok-report-content -->

</div>
