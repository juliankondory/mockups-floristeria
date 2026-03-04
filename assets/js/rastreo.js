/* =====================================================
   RODAMEL — Lógica del portal de rastreo de guías
   Extraído de rastreo.php | Kondory Tecnología S.A.S
   ===================================================== */

(function() {
  'use strict';

  const form = document.getElementById('formRastreo');
  const btnBuscar = document.getElementById('btnBuscar');
  const seccionResultado = document.getElementById('resultado');
  const contenidoResultado = document.getElementById('resultadoContenido');

  // Función para obtener clase de badge según estado
  function getBadgeClass(estado) {
    const clases = {
      'recepcionada': 'badge-recepcionada',
      'clasificada': 'badge-clasificada',
      'en_espera': 'badge-en_espera',
      'en_despacho': 'badge-en_despacho',
      'entregada': 'badge-entregada',
      'devuelta': 'badge-devuelta',
      'novedad': 'badge-novedad'
    };
    return clases[estado] || 'badge-en_espera';
  }

  // Función para formatear nombre de estado
  function formatearEstado(estado) {
    const nombres = {
      'recepcionada': 'Recepcionada',
      'clasificada': 'Clasificada',
      'en_espera': 'En Espera',
      'en_despacho': 'En Despacho',
      'entregada': 'Entregada',
      'devuelta': 'Devuelta',
      'novedad': 'Novedad'
    };
    return nombres[estado] || estado;
  }

  // Función para formatear fecha
  function formatearFecha(fecha) {
    if (!fecha) return 'N/A';
    const d = new Date(fecha);
    const opciones = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return d.toLocaleDateString('es-CO', opciones);
  }

  // Renderizar resultado exitoso
  function renderResultadoExito(data) {
    const guia = data.guia;
    const historial = data.historial || [];

    let html = `
      <div class="result-header">
        <h2>Guía: ${guia.numero_guia}</h2>
        <span class="badge-estado ${getBadgeClass(guia.estado)}">
          ${formatearEstado(guia.estado)}
        </span>
      </div>

      <div class="info-grid">
        <div class="info-item">
          <label>Destinatario</label>
          <p>${guia.destinatario_nombre || 'N/A'}</p>
        </div>
        <div class="info-item">
          <label>Municipio destino</label>
          <p>${guia.municipio_destino || 'N/A'}</p>
        </div>
        <div class="info-item">
          <label>Dirección</label>
          <p>${guia.destinatario_direccion || 'N/A'}</p>
        </div>
        <div class="info-item">
          <label>Teléfono</label>
          <p>${guia.destinatario_telefono || 'N/A'}</p>
        </div>
        <div class="info-item">
          <label>Carrier</label>
          <p>${guia.carrier || 'N/A'}</p>
        </div>
        <div class="info-item">
          <label>Fecha de recepción</label>
          <p>${formatearFecha(guia.fecha_recepcion)}</p>
        </div>
      </div>
    `;

    // Historial
    if (historial.length > 0) {
      html += `
        <div class="historial-section">
          <h3>Historial de estados</h3>
          <div class="timeline">
      `;

      historial.reverse().forEach(item => {
        const estadoTexto = item.estadoAnterior
          ? `${formatearEstado(item.estadoAnterior)} → ${formatearEstado(item.estadoNuevo)}`
          : formatearEstado(item.estadoNuevo);

        html += `
          <div class="timeline-item">
            <div class="estado">${estadoTexto}</div>
            <div class="fecha">${formatearFecha(item.fecha)}</div>
            ${item.observacion ? `<div class="observacion">${item.observacion}</div>` : ''}
          </div>
        `;
      });

      html += `
          </div>
        </div>
      `;
    }

    // Botones de acción
    const mensajeWhatsApp = encodeURIComponent(`Hola, necesito información sobre mi guía ${guia.numero_guia}`);
    html += `
      <div class="text-center">
        <a href="https://wa.me/573012945456?text=${mensajeWhatsApp}" target="_blank" class="btn-whatsapp">
          <i class="bx bxl-whatsapp"></i>
          <span>Contactar por WhatsApp</span>
        </a>
        <button type="button" class="btn-nueva-busqueda" onclick="location.reload()">
          <i class="bx bx-search-alt"></i>
          <span>Nueva búsqueda</span>
        </button>
      </div>
    `;

    contenidoResultado.innerHTML = html;
    seccionResultado.style.display = 'block';
    seccionResultado.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  // Renderizar error
  function renderError(mensaje) {
    const html = `
      <div class="error-message">
        <i class="bx bx-error-circle"></i>
        <h3>No encontramos tu guía</h3>
        <p>${mensaje}</p>
        <button type="button" class="btn-nueva-busqueda" onclick="location.reload()">
          <i class="bx bx-search-alt"></i>
          <span>Intentar de nuevo</span>
        </button>
      </div>
    `;

    contenidoResultado.innerHTML = html;
    seccionResultado.style.display = 'block';
    seccionResultado.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  // Renderizar loading
  function renderLoading() {
    const html = `
      <div class="error-message">
        <div class="spinner" style="margin: 0 auto;"></div>
        <h3 style="margin-top: 20px;">Buscando tu guía...</h3>
        <p>Por favor espera un momento</p>
      </div>
    `;

    contenidoResultado.innerHTML = html;
    seccionResultado.style.display = 'block';
    seccionResultado.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  // Evento submit del formulario
  form.addEventListener('submit', function(e) {
    e.preventDefault();

    const numeroGuia = document.getElementById('numeroGuia').value.trim();

    if (!numeroGuia) {
      alert('Por favor ingresa un número de guía');
      return;
    }

    // Mostrar loading
    renderLoading();
    btnBuscar.disabled = true;

    // Crear FormData
    const formData = new FormData();
    formData.append('buscarGuia', '1');
    formData.append('numeroGuia', numeroGuia);

    // Hacer request con fetch
    fetch('/system/php/routing/Rastreo.php', {
      method: 'POST',
      body: formData
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Error de red');
      }
      return response.json();
    })
    .then(data => {
      btnBuscar.disabled = false;

      if (data.success) {
        renderResultadoExito(data);
      } else {
        renderError(data.message || 'No se encontró la guía solicitada');
      }
    })
    .catch(error => {
      btnBuscar.disabled = false;
      renderError('Error de conexión. Por favor verifica tu conexión a internet e intenta nuevamente.');
    });
  });

  // Inicializar AOS
  if (typeof AOS !== 'undefined') {
    AOS.init({
      duration: 1000,
      easing: "ease-in-out",
      once: true,
      mirror: false
    });
  }

})();
