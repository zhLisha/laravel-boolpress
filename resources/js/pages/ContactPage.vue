<template>
    <section>
        <div class="container">
            <h1>Contattaci</h1>

            <!-- Success Message -->
            <div v-if="sentMessage" class="alert alert-success" role="alert">
               <p>Grazie per averci contattato.</p>
            </div>

           <form @submit.prevent="submitMessage">
                <!-- Name -->
                <div class="mb-3">
                    <label for="user-name" class="form-label">Nome</label>
                    <input v-model="userName" type="text" class="form-control" id="user-name" placeholder="Es. Maria">
                </div>
                <!-- ErrorMessage -->
                <div v-if="errorSubmit">
                    <div v-for="error, index in errors.name" :key="index" class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <div>
                            <span>{{error}}</span>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="user-email" class="form-label">Email </label>
                    <input v-model="userEmail" type="email" class="form-control" id="user-email" placeholder="Es maria-rossi@example.com">
                </div>
                <!-- ErrorMessage -->
                <div v-if="errorSubmit">
                    <div v-for="error, index in errors.email" :key="index" class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <div>
                            <span>{{error}}</span>
                        </div>
                    </div>
                </div>

                
                <!-- Message -->
                <div class="mb-3">
                    <label for="user-message" class="form-label">Messaggio</label>
                    <textarea v-model="userMessage" class="form-control" id="user-message" rows="10"></textarea>
                </div>
                <!-- ErrorMessage -->
                <div v-if="errorSubmit">
                    <div v-for="error, index in errors.message" :key="index" class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <div>
                            <span>{{error}}</span>
                        </div>
                    </div>
                </div>


                <input type="submit" class="btn btn-primary">
           </form>
        </div>
    </section>
</template>

<script>
export default {
    name: 'ContactPage',
    data() {
        return {
            userName: '',
            userEmail: '',
            userMessage: '',
            sentMessage: false,
            errors: {},
            errorSubmit: false
        }
    },

    methods: {
        submitMessage() {
            axios.post('/api/leads', {
                name: this.userName,
                email: this.userEmail,
                message: this.userMessage
            })
            .then((response) => {
                if(response.data.success !== false) {
                    this.sentMessage = true;
                    this.errorSubmit = false;
                    
                    this.userName = '';
                    this.userEmail = '';
                    this.userMessage = '';
                }else {
                    this.errors = response.data.errors;
                    this.errorSubmit = true
                }
            })
        }
    }
}
</script>