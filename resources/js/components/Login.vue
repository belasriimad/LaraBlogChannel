<template>
    <div class="container">
        <div class="col-md-6 mx-auto py-5 mt-5">
            <div class="card my-5">
                <div class="card-header">
                    Connexion
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="email" required placeholder="Email"
                            v-model="email"
                            class="form-control"
                        >
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Mot de passe"
                            v-model="password"
                            class="form-control"
                        >
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" @click="login">
                            Valider
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    data(){
        return{
            email : '',
            password : ''
        }
    },
    created () {
        if(User.isLogged()){
            this.$router.push({name : 'home'});
        }
    },
    methods: {
        login(){
            axios.post('/api/users/login',{
                email : this.email,
                password : this.password
            }).then(response => {
                console.log(response.data);
                User.storeUser(JSON.stringify(response.data));
                this.$router.go();
            }).catch(err => console.log(err));
        }
    },
}
</script>

