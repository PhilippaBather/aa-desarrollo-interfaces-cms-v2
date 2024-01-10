/**
 * JavaScript - maneja el contenido visible del formulario para añadir a nuevos usuarios.
 * @type {HTMLElement}
 */

const courseInput = document.getElementById("detalles-asignatura");
const salaryInput = document.getElementById("detalles-sueldo");

function handleRoleSelection(role) {
    switch(role.toUpperCase()) {
        case "ADMIN":
            handleAdminSelection();
            break;
        case "ESTUDIANTE":
            handleStudentSelection();
            break;
        case "PROFESOR":
            handleTeacherSelection();
            break;
    }
}

function handleAdminSelection() {
    salaryInput.style.display = "block";
    courseInput.style.display = "none";
}

function handleStudentSelection() {
    courseInput.style.display = "block";
    salaryInput.style.display = "none";
}

function handleTeacherSelection() {
    courseInput.style.display = "block";
    salaryInput.style.display = "block";
}