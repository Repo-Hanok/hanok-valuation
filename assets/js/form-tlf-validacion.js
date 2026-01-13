    document.addEventListener('DOMContentLoaded', () => {
      let otpSessionToken = null;
      const $ = (id) => document.getElementById(id);
      const msg = $('hanok_msg');

      $('hanok_sendOtp').onclick = async () => {
        const telefono = $('hanok_tel').value.trim();
        if (!telefono) return msg.textContent = 'Introduce un número.';
        msg.textContent = 'Enviando código...';

        const res = await fetch('/wp-json/hanok/v1/phone/init', {
          method: 'POST', headers: { 'Content-Type': 'application/json' },
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
          method: 'POST', headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ session: otpSessionToken, code })
        });
        const data = await res.json();
        msg.textContent = data.message || (data.ok ? 'OK' : 'Error');
        if (data.ok) {
          // aquí ya puedes habilitar el siguiente paso del formulario principal
          window.hanok.tlfOK = true
          $('hanok_tel').dispatchEvent('click')
        }
      };
    });