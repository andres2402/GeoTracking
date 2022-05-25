<script>
    export default {
        data (){
            return {
                csrf: document.querySelector("meta[name=token]").content,
                customers: [],
                smsMessage: '',
                emailMessage: '',
                selected: [],
                filter_name: '',
                type: 0,
                url:'/alerting',
            }
        },
        computed: {
            selectAll: {
                get: function () {
                    return this.customers ? this.selected.length == this.customers.length : false;
                },
                set: function (value) {
                    var selected = [];
                    if (value) {
                        this.customers.forEach(function (customer) {
                            selected.push(customer);
                        });
                    }
                    this.selected = selected;
                }
            },
            filter_customer(){
                let name = this.filter_name
                if (!this.filter_name) return this.customers

                let searchText = this.filter_name.toLowerCase()

                return this.customers.filter(c => {
                    let full_name = c.user.name + ' ' + c.user.last_name
                    return full_name.toLowerCase().includes(searchText) ||
                    c.user.phone.toLowerCase().includes(searchText) ||
                    c.user.email.toLowerCase().includes(searchText)
                })
            },
        },

        methods:{
            async sendSms(){
                if(this.smsMessage == ''){
                    myAlert.error('No puede enviar un mensaje vacio')
                    return null;
                }
                if(this.selected.length == 0){
                    myAlert.error('Seleccione al menos un cliente')
                    return null;
                }
                myAlert.load();
                let req = await fetch(this.url+'/sendSms', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': this.csrf,
                        'accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        message: this.smsMessage,
                        customers: this.selected
                    })
                })
                let res = await req.json()
                if (req.ok) {
                    myAlert.stopLoad();
                    this.smsMessage = ''
                    this.selected = []
                    myAlert.correct('SMS enviados exitosamente')
                }
                else {
                    myAlert.stopLoad();
                    myAlert.error('No se pudo enviar los SMS. ' + res.error)
                }
            },

            async sendEmail(){
                if(this.emailMessage == ''){
                    myAlert.error('No puede enviar un mensaje vacio')
                    return null;
                }
                if(this.selected.length == 0){
                    myAlert.error('Seleccione al menos un cliente')
                    return null;
                }
                myAlert.load();
                let req = await fetch(this.url+'/sendEmail', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': this.csrf,
                        'accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        message: this.emailMessage,
                        customers: this.selected
                    })
                })
                let res = await req.json()
                if (req.ok) {
                    myAlert.stopLoad();
                    this.emailMessage = ''
                    this.selected = []
                    myAlert.correct('Emails enviados exitosamente')
                }
                else {
                    myAlert.stopLoad();
                    myAlert.error('No se pudo enviar los Email')
                }
            },

            async getData(){
                let req = await fetch('/api/customers')
                let res = await req.json()
                this.customers = res.data
            }
        },
        mounted(){
            this.getData();
        }
    }
</script>
