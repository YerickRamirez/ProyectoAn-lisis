$(function () {
                    var momento = new Date();
                    //console.log("Actual parseada: " + momento);
                    momentoInicioDia = new Date();
                    momentoInicioDia.setHours(0,0,0,0);
        $('#datetimepicker5').datetimepicker({
            minDate: momentoInicioDia, //Muestra el calendario desde el dia actual y no desde antes
            format: 'DD/MM/YYYY', //Hay que ponerle un formato a la fecha, si no se pone esto se establecen con horas
            daysOfWeekDisabled:[0,6], //Asi se bloquean los fines de semana
            //disabledDates: ["10/24/2018"] //Lista de fechas que bloquear. 
            disabledDates: [] //Lista de fechas que bloquear. 
        }).on('dp.change', function prueba() {
            });
    });