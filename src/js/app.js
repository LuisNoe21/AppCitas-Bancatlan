let paso = 1;

document.addEventListener("DOMContentLoaded", function () {
  eventListeners();
  IniciarApp();
});

function eventListeners() {
  const metodoContacto = document.querySelectorAll(
    'input[name="contacto[contacto]"]'
  );
  metodoContacto.forEach((input) =>
    input.addEventListener("click", seleccionarMetodo)
  );
}

function seleccionarMetodo(e) {
  const contactoDiv = document.querySelector("#contacto");

  if (e.target.value === "telefono") {
    contactoDiv.innerHTML = `
            <label for="telefono">Teléfono</label>
            <input type="tel" placeholder="Tu Teléfono" id="telefono"  name="contacto[telefono]" required>

            <label for="fecha">Fecha Llamada:</label>
            <input type="date" id="fecha"  name="contacto[fecha]" required>

            <label for="hora">Hora Llamada:</label>
            <input type="time" id="hora" min="09:00" max="18:00"  name="contacto[hora]" required>

        `;
  } else {
    contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required>
        `;
  }
}

function IniciarApp() {
  tabs(); //cambia la seccion cuando se presionen los tabs
}

function mostrarSeccion() {
  //Seleccionar la seccion con el paso
  const seccion = document.querySelector(`paso-${paso}`);
}

function tabs() {
  const botones = document.querySelectorAll(".tabs button");

  botones.forEach((boton) => {
    boton.addEventListener("click", function (e) {
      paso = parseInt(e.target.dataset.paso); //para saber que paso esta asociado al boton

      mostrarSeccion();
    });
  });
}
