// ===== UTILIDADES =====

function mostrarError(campoId, errorId, mensaje) {
  const campo = document.getElementById(campoId);
  const span  = document.getElementById(errorId);
  if (campo) campo.classList.add('invalid');
  if (span)  span.textContent = mensaje;
}

function limpiarError(campoId, errorId) {
  const campo = document.getElementById(campoId);
  const span  = document.getElementById(errorId);
  if (campo) campo.classList.remove('invalid');
  if (span)  span.textContent = '';
}

function obtenerFechaHoy() {
  const hoy = new Date();
  const anio = hoy.getFullYear();
  const mes  = String(hoy.getMonth() + 1).padStart(2, '0');
  const dia  = String(hoy.getDate()).padStart(2, '0');
  return anio + '-' + mes + '-' + dia;
}

function validarContacto(valor) {
  const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const regexTel   = /^\d[\d\s\-]{6,14}\d$/;
  return regexEmail.test(valor) || regexTel.test(valor);
}

// ===== FORMULARIO DE RESERVACIÓN =====
const reservationForm = document.getElementById('reservationForm');
if (reservationForm) {
  reservationForm.addEventListener('submit', function (e) {
    let valido = true;

    const nombre   = document.getElementById('nombre').value.trim();
    const contacto = document.getElementById('contacto').value.trim();
    const fecha    = document.getElementById('fecha').value;
    const personas = document.getElementById('personas').value;

    if (nombre === '') {
      mostrarError('nombre', 'error-nombre', 'El nombre es obligatorio.');
      valido = false;
    } else { limpiarError('nombre', 'error-nombre'); }

    if (contacto === '') {
      mostrarError('contacto', 'error-contacto', 'El contacto es obligatorio.');
      valido = false;
    } else if (!validarContacto(contacto)) {
      mostrarError('contacto', 'error-contacto', 'Ingresá un correo o teléfono válido.');
      valido = false;
    } else { limpiarError('contacto', 'error-contacto'); }

    if (fecha === '') {
      mostrarError('fecha', 'error-fecha', 'La fecha es obligatoria.');
      valido = false;
    } else if (fecha < obtenerFechaHoy()) {
      mostrarError('fecha', 'error-fecha', 'La fecha no puede ser anterior a hoy.');
      valido = false;
    } else { limpiarError('fecha', 'error-fecha'); }

    if (personas === '' || parseInt(personas) <= 0) {
      mostrarError('personas', 'error-personas', 'Ingresá un número de personas mayor a cero.');
      valido = false;
    } else { limpiarError('personas', 'error-personas'); }

    if (!valido) e.preventDefault();
  });
}

// ===== FORMULARIO DE LOGIN =====
const loginForm = document.getElementById('loginForm');
if (loginForm) {
  loginForm.addEventListener('submit', function (e) {
    let valido = true;

    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value;

    if (username === '') {
      mostrarError('username', 'error-username', 'Ingresá tu usuario.');
      valido = false;
    } else { limpiarError('username', 'error-username'); }

    if (password === '') {
      mostrarError('password', 'error-password', 'Ingresá tu contraseña.');
      valido = false;
    } else { limpiarError('password', 'error-password'); }

    if (!valido) e.preventDefault();
  });
}

// ===== FORMULARIO DE REGISTRO =====
const registerForm = document.getElementById('registerForm');
if (registerForm) {
  registerForm.addEventListener('submit', function (e) {
    let valido = true;

    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value;
    const confirm  = document.getElementById('confirm').value;

    if (username === '') {
      mostrarError('username', 'error-username', 'Ingresá un nombre de usuario.');
      valido = false;
    } else { limpiarError('username', 'error-username'); }

    if (password.length < 6) {
      mostrarError('password', 'error-password', 'La contraseña debe tener al menos 6 caracteres.');
      valido = false;
    } else { limpiarError('password', 'error-password'); }

    if (confirm !== password) {
      mostrarError('confirm', 'error-confirm', 'Las contraseñas no coinciden.');
      valido = false;
    } else { limpiarError('confirm', 'error-confirm'); }

    if (!valido) e.preventDefault();
  });
}