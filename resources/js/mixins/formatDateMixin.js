export default {
    methods: {
        formatDate(value) {
            var opciones = { year: 'numeric', month: 'short', day: 'numeric' };
            var fecha = new Date(value)
            .toLocaleDateString('es',opciones)
            .replace(/ /g,'/')
            .replace('.','')
            .replace(/-([a-z])/, function (x) {return '-' + x[1].toUpperCase()});
            return fecha;
        }
    }
  };
