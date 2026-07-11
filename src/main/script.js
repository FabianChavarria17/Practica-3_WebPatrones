// ===== NAVEGACIÓN MÓVIL =====
const navToggle = document.getElementById('navToggle');
const navLinks = document.querySelector('.nav-links');

navToggle.addEventListener('click', function () {
  navLinks.classList.toggle('open');
});

// Cerrar menú al hacer clic en un enlace
navLinks.querySelectorAll('a').forEach(function (enlace) {
  enlace.addEventListener('click', function () {
    navLinks.classList.remove('open');
  });
});

// ===== REFERENCIAS DEL FORMULARIO =====
const form = document.getElementById('reservationForm');
const confirmacion = document.getElementById('confirmacion');
const confirmDetalles = document.getElementById('confirm-detalles');
const btnNueva = document.getElementById('btnNueva');

// ===== UTILIDADES =====

/**
 * Muestra un mensaje de error en un campo.
 * @param {string} campoId 
 * @param {string} errorId 
 * @param {string} mensaje 
 */
function mostrarError(campoId, errorId, mensaje) {
  const campo = document.getElementById(campoId);
  const errorSpan = document.getElementById(errorId);
  campo.classList.add('invalid');
  errorSpan.textContent = mensaje;
}

/**
 * Limpia el error de un campo.
 * @param {string} campoId 
 * @param {string} errorId 
 */
function limpiarError(campoId, errorId) {
  const campo = document.getElementById(campoId);
  const errorSpan = document.getElementById(errorId);
  campo.classList.remove('invalid');
  errorSpan.textContent = '';
}

/**
 * Valida si un string de contacto tiene formato básico válido.
 * @param {string} valor
 * @returns {boolean}
 */
function validarContacto(valor) {
  const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const regexTel = /^\d[\d\s\-]{6,14}\d$/;
  return regexEmail.test(valor) || regexTel.test(valor);
}

/**
 * Obtiene la fecha de hoy en formato YYYY-MM-DD (sin hora, en zona local).
 * @returns {string}
 */
function obtenerFechaHoy() {
  const hoy = new Date();
  const anio = hoy.getFullYear();
  const mes = String(hoy.getMonth() + 1).padStart(2, '0');
  const dia = String(hoy.getDate()).padStart(2, '0');
  return anio + '-' + mes + '-' + dia;
}

// ===== VALIDACIÓN EN TIEMPO REAL =====

document.getElementById('nombre').addEventListener('input', function () {
  if (this.value.trim() !== '') {
    limpiarError('nombre', 'error-nombre');
  }
});

document.getElementById('contacto').addEventListener('input', function () {
  if (this.value.trim() !== '') {
    limpiarError('contacto', 'error-contacto');
  }
});

document.getElementById('fecha').addEventListener('change', function () {
  if (this.value !== '') {
    limpiarError('fecha', 'error-fecha');
  }
});

document.getElementById('personas').addEventListener('input', function () {
  if (parseInt(this.value) > 0) {
    limpiarError('personas', 'error-personas');
  }
});

// ===== VALIDACIÓN COMPLETA DEL FORMULARIO =====

/**
 * Valida todos los campos del formulario.
 * @returns {boolean} 
 */
function validarFormulario() {
  let esValido = true;

  const nombre = document.getElementById('nombre').value.trim();
  const contacto = document.getElementById('contacto').value.trim();
  const fecha = document.getElementById('fecha').value;
  const personas = document.getElementById('personas').value;
  const fechaHoy = obtenerFechaHoy();

  // Validar nombre
  if (nombre === '') {
    mostrarError('nombre', 'error-nombre', 'El nombre es obligatorio.');
    esValido = false;
  } else {
    limpiarError('nombre', 'error-nombre');
  }

  // Validar contacto
  if (contacto === '') {
    mostrarError('contacto', 'error-contacto', 'El contacto es obligatorio.');
    esValido = false;
  } else if (!validarContacto(contacto)) {
    mostrarError('contacto', 'error-contacto', 'Ingresá un correo válido (ej: juan@correo.com) o un teléfono (ej: 88887777).');
    esValido = false;
  } else {
    limpiarError('contacto', 'error-contacto');
  }

  // Validar fecha
  if (fecha === '') {
    mostrarError('fecha', 'error-fecha', 'La fecha es obligatoria.');
    esValido = false;
  } else if (fecha < fechaHoy) {
    mostrarError('fecha', 'error-fecha', 'La fecha no puede ser anterior a hoy.');
    esValido = false;
  } else {
    limpiarError('fecha', 'error-fecha');
  }

  // Validar número de personas
  if (personas === '' || personas === null) {
    mostrarError('personas', 'error-personas', 'Indicá el número de personas.');
    esValido = false;
  } else if (parseInt(personas) <= 0) {
    mostrarError('personas', 'error-personas', 'El número de personas debe ser mayor a cero.');
    esValido = false;
  } else {
    limpiarError('personas', 'error-personas');
  }

  return esValido;
}

// ===== ENVÍO DEL FORMULARIO =====

form.addEventListener('submit', function (evento) {
  evento.preventDefault(); 

  if (!validarFormulario()) {
    return; 
  }

  // Recoger datos validados
  const nombre = document.getElementById('nombre').value.trim();
  const contacto = document.getElementById('contacto').value.trim();
  const fecha = document.getElementById('fecha').value;
  const personas = document.getElementById('personas').value;
  const comentarios = document.getElementById('comentarios').value.trim();

  // Formatear fecha para mostrarla de forma legible
  const fechaFormateada = fecha.split('-').reverse().join('/');

  // Construir HTML de confirmación con los datos
  confirmDetalles.innerHTML =
    '<strong>Nombre:</strong> ' + nombre + '<br>' +
    '<strong>Contacto:</strong> ' + contacto + '<br>' +
    '<strong>Fecha:</strong> ' + fechaFormateada + '<br>' +
    '<strong>Personas:</strong> ' + personas + '<br>' +
    (comentarios !== '' ? '<strong>Comentarios:</strong> ' + comentarios : '');

  // Ocultar formulario y mostrar confirmación
  form.style.display = 'none';
  confirmacion.classList.remove('hidden');

  // Desplazarse suavemente hacia la confirmación
  confirmacion.scrollIntoView({ behavior: 'smooth', block: 'center' });
});

// ===== BOTÓN "HACER OTRA RESERVACIÓN" =====

btnNueva.addEventListener('click', function () {
  // Limpiar el formulario
  form.reset();

  // Limpiar cualquier error visual residual
  var inputs = form.querySelectorAll('input, textarea');
  inputs.forEach(function (campo) {
    campo.classList.remove('invalid');
  });

  var errores = form.querySelectorAll('.error-msg');
  errores.forEach(function (span) {
    span.textContent = '';
  });

  // Volver a mostrar el formulario y ocultar la confirmación
  form.style.display = 'flex';
  confirmacion.classList.add('hidden');

  // Ir al formulario
  document.getElementById('reservacion').scrollIntoView({ behavior: 'smooth' });
});