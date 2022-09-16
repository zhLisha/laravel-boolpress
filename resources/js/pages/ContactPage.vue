<template>
    <section>
        <div class="container">
            <h1>Contattaci</h1>
           <form>
                <!-- Name -->
                <div class="mb-3">
                    <label for="user-name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="user-name" placeholder="Es. Maria">
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="user-email" class="form-label">Email </label>
                    <input type="email" class="form-control" id="user-email" placeholder="Es maria-rossi@example.com">
                </div>
                
                <!-- Message -->
                <div class="mb-3">
                    <label for="user-message" class="form-label">Messaggio</label>
                    <textarea class="form-control" id="user-message" rows="10"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Invia</button>
           </form>
        </div>
    </section>
</template>

<script>
export default {
    name: 'ContactPage'
}
</script>