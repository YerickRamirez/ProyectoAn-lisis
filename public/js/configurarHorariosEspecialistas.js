function guardarHorario() {
            var recinto = $('#dropRecintos').val();
            var servicio = $('#dropServicios').val();
            var cuenta = 1;
            var manana = 0;
            var tarde = 0;
            
            array_horario_servicio = [];
            for (var dia = 1; dia < 6; dia++) {
                if(document.getElementById(cuenta).checked) { manana = 1;} else { manana = 0;}
                cuenta =  cuenta + 1;
                if(document.getElementById(cuenta).checked) { tarde = 1;} else { tarde = 0;}

                var horario_servicio = {id_dia: dia, id_recinto: recinto, id_servicio: servicio,
                disponibilidad_manana: manana, disponibilidad_tarde: tarde};
                //alert(horario_servicio.id_dia);
                array_horario_servicio.push(horario_servicio);
                cuenta =  cuenta + 1;
            }

            window.location.replace("/annadirHorarioServicioEspecialista/" + JSON.stringify(array_horario_servicio));
        }
        