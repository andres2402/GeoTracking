<script>
    export default {
        data(){
            return{
                password:'',
            }
        },
        methods: {
            async generatePassword() {
                let req=await fetch('/getRandom')
                let res=await req.json()
                this.password=res.data;
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>