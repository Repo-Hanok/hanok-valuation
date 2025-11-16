<!-- hanok_template_cassandra.php -->
<div class="hanok-report" style="font-family:Arial,sans-serif;max-width:800px;margin:auto;line-height:1.6">
  <?php if (!empty($avm_valuation)): ?>
    <h2 style="text-align:center;color:#222;">
      Valoración estimada de tu inmueble
    </h2>
    <p style="font-size:1.4em;text-align:center;margin:10px 0;color:#0073aa;">
      <?= number_format($avm_valuation, 0, ',', '.') ?> €
    </p>

    <?php if (!empty($precio_m2)): ?>
      <p style="text-align:center;margin:5px 0;">
        <strong>Precio por m²:</strong> <?= number_format($precio_m2, 0, ',', '.') ?> €/m²
      </p>
    <?php endif; ?>

    <?php if (!empty($precio_medio_m2)): ?>
      <p style="text-align:center;margin:5px 0;">
        <strong>Precio medio en la zona:</strong> <?= number_format($precio_medio_m2, 0, ',', '.') ?> €/m²
      </p>
    <?php endif; ?>

    <?php if ($dif_precio_medio !== null): ?>
      <?php 
        $color = $dif_precio_medio > 0 ? '#2E8B57' : '#B22222';
        $signo = $dif_precio_medio > 0 ? '+' : '';
      ?>
      <p style="text-align:center;margin:5px 0;color:<?= $color ?>;">
        <strong>Diferencia respecto a la media:</strong> <?= $signo ?><?= $dif_precio_medio ?>%
      </p>
    <?php endif; ?>

  <?php else: ?>
    <p style="text-align:center;color:#777;">No se pudo calcular la valoración.</p>
  <?php endif; ?>

  <?php if (!empty($comparables)): ?>
    <h3 style="margin-top:40px;color:#333;">Inmuebles similares en venta en la zona</h3>
    <div class="comparables-list" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:16px;margin-top:20px;">
      <?php foreach ($comparables as $c): ?>
        <div class="comparable-card" style="border:1px solid #ddd;border-radius:8px;padding:12px;">
          <h4 style="margin:0 0 8px 0;color:#0073aa;">
            <?= htmlspecialchars($c['full_address'] ?? 'Dirección no disponible') ?>
          </h4>
          <p><strong>Precio:</strong> <?= number_format($c['local_price'] ?? 0, 0, ',', '.') ?> €</p>
          <p><strong>Superficie:</strong> <?= $c['area'] ?? '-' ?> m²</p>
          <p><strong>Habitaciones:</strong> <?= $c['n_rooms'] ?? '-' ?> | <strong>Baños:</strong> <?= $c['n_baths'] ?? '-' ?></p>
          <p><strong>Distancia:</strong> <?= $c['distance'] ?? '-' ?> m</p>
          <?php if (!empty($c['url'])): ?>
            <a href="<?= htmlspecialchars($c['url']) ?>" target="_blank" style="color:#0073aa;text-decoration:none;">Ver en Idealista →</a>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p style="margin-top:40px;color:#777;">No se encontraron comparables cercanos.</p>
  <?php endif; ?>
</div>
