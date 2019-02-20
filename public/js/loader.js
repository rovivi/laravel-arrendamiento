//let route = "http://127.0.0.1:8000/";
let route = "../";

var activeServices = [];
var services = [];

function makeApp() {
    var app = new Vue({
        el: '.app',
        data: {
            serviceT: services,
            serviceA: [],
            searchText: '',
            loaded: false,
            total: 0
        },
        mounted: function() {
            this.loaded = true;
            spiner.loaded = true;
        },
        computed: {
            activeServices() {
                return this.serviceT.filter((service) => service.count > 0);
            }
        },
        methods: {
            totalCoti() {
                var sum = 0;
                var table = this.activeService();
                for (var i of table) {
                    sum += (i.count * i.price);
                }
                return sum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            },
            activeService() {
                return this.serviceT.filter((service) => service.count > 0);
            },
            serviceSearch() {
                return this.serviceT.filter((service) => (service.name.toLowerCase().match(this.searchText.toLowerCase()) || service.description.toLowerCase().match(this.searchText.toLowerCase())));
            }
        }
    })
}
//init stuff
axios
    .get(route + 'api/getS/' + id)
    .then(response => (activeServices = response.data))
    .catch(error => console.log(error))
    .then(function() {
        axios
            .get(route + 'api/getService/')
            .then(response => (services = response.data))
            .catch(error => console.log(error))
            .then(function() {
                for (var i of activeServices) {
                    services.find(serv => serv.id === i.id).count = i.count;
                }
                makeApp()
            })
    })
//----Components
Vue.component('lista', {
    props: ['service'],
    template: '#lista-template'
})
Vue.component('table-active', {
    props: ['services', 'total'],
    methods: {
        hola() {
            var array2send = [];
            for (var i of services) {
                if ( i.count!=undefined){
                    var o2push = {idService: i.id, c: i.count, }
                    array2send.push(o2push);
                }
            }   
            console.log(array2send);
            axios.post(route + 'api/pack/', {
                    id: id,
                    services: array2send,
                })
                .then(function(response) {
                    console.log(response);
                    if (response.data=="ok"){
                        window.location.replace("/control/contrato");
                    }
                    else{
                        alert("Algo anda mal consulta al administrador!");
                    }
                })
                .catch(function(error) {
                    console.log('no valekk'+error);
                });
        }
    },
})
var spiner = new Vue({
    el: '.loader',
    data: {
        loaded: false,
    },
});