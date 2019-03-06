function confirmarEliminar(cedula) {
                    if (confirm("¿Está seguro que desea eliminar al especilista con cédula " + String(cedula) + " ?")) {
                        window.location.replace("/especialistas/" + cedula + "/eliminarEspecialista");
                    }
                    return false;
                    }