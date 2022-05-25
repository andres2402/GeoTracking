<script>
    export default {
        data() {
            return {
                csrf: document.querySelector("meta[name=token]").content,
                parameters: [],
                errors:{},
                method:'POST',
                action:'/valores-parametros',
                methodValue:'POST',
                current: null,
                parameterChoosen:null,
                name:"",
                valueName:"",
                valueDescription:"",
                state:0,
                description:"",
                valueChoosen:null,
                showModal: false,
            }
        },
        methods: {
            async saveValues() {
                if (!this.$refs['formValues'].checkValidity()) {
                    this.$refs['formValues'].classList.add('was-validated')
                    return 
                }

                myAlert.load();
                let req = await fetch('/values', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': this.csrf,
                        'accept': 'application/json'
                    },
                    body: new FormData(this.$refs['formValues'])
                 })
                let res = await req.json()
                if (req.ok) {
                    this.current.parameters_values.push({...res.data,state:'Activo'})
                    this.$refs['formValues'].reset()
                    this.clearValue()
                }
                else {
                    this.errors=res;
                }
                myAlert.stopLoad();
            },
            async updateValues(){
                if (!this.$refs['formValues'].checkValidity()) {
                    this.$refs['formValues'].classList.add('was-validated')
                    return 
                }

                myAlert.load();
                let req = await fetch('/values/'+this.valueChoosen.id, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': this.csrf,
                        'accept': 'application/json'
                    },
                    body: new FormData(this.$refs['formValues'])
                 })
                let res = await req.json()
                if (req.ok) {
                    myAlert.stopLoad();
                    let id=this.current.parameters_values.findIndex(item=>item.id==this.valueChoosen.id);
                    this.current.parameters_values[id].name=res.data.name;
                    this.current.parameters_values[id].description=res.data.description;
                    this.current.parameters_values[id].state=res.data.state;
                    
                    myAlert.success('Actualizar valor')
                    this.$refs['formValues'].classList.remove('was-validated')
                    this.$refs['formValues'].reset();
                    this.clearValue();
                }
                else {
                    this.errors=res;
                    myAlert.stopLoad();
                }
            },
            selectedParameter(param){
                this.parameterChoosen=param;
                this.method='PUT';
                this.name= param.name
                this.description=param.description
                this.action='/valores-parametros/'+param.id
            },
            clearParameter(){
                this.parameterChoosen=null;
                this.method='POST';
                this.name=""
                this.description=""
                this.action='/valores-parametros'
            },
            selectedValue(param){
                this.valueChoosen=param;
                this.methodValue='PUT';
                this.valueName=param.name
                this.valueDescription=param.description
            },
            clearValue(){
                this.valueChoosen=null;
                this.methodValue='POST';
                this.valueName=""
                this.valueDescription=""
            },
            async getData() {
                let req = await fetch('/api/parameters')
                let res = await req.json()
                this.parameters = res.data
            },
            async remove(url, id,reload=true) {
                let result=await deleteResource(url, id,reload)
                if (result) {
                    let index=this.current.parameters_values.findIndex(item=>item.id==id);
                    console.log(index)
                    this.current.parameters_values.splice(index,1)
                }
            }
        },
        mounted() {
            this.getData();
        }
    }
</script>