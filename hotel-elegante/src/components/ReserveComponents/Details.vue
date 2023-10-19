<script setup>
import { ref, defineProps, defineEmits } from 'vue';

const { collectFormData } = defineProps();
const emit = defineEmits();

const nameSurname = ref("");
const email = ref("");
const password = ref("");

function submitForm() {
    // Verifica dell'indirizzo email
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email.value)) {
        alert("Inserisci un indirizzo email valido");
        return;
    }

    const details = {
        nameSurname: nameSurname.value,
        email: email.value,
        password: password.value
    };
    
    emit('update-details', details);
}
</script>


<template>
    <!-- ... altre parti del componente ... -->
    <div class="formWrapper">
        <form @submit.prevent="submitForm">
            <div class="p-inputgroup flex-1 inputgroup">
                <span class="p-inputgroup-addon">
                    <i class="pi pi-user"></i>
                </span>
                <InputText id="nameSurname" v-model="nameSurname" required class="custom-input" />
            </div>

            <div class="p-inputgroup flex-1 inputgroup">
                <span class="p-inputgroup-addon">
                    <i class="pi pi-at"></i>
                </span>
                <InputText id="email" type="email" v-model="email" required class="custom-input" />
            </div>

            <div class="p-inputgroup flex-1 inputgroup">
                <span class="p-inputgroup-addon">
                    <i class="pi pi-lock"></i>
                </span>
                <Password v-model="password" toggleMask class="custom-input">
                    <template #header>
                        <h6>Pick a password</h6>
                    </template>
                    <template #footer>
                        <Divider />
                        <p class="mt-2">Suggestions</p>
                        <ul class="pl-2 ml-2 mt-0" style="line-height: 1.5">
                            <li>At least one lowercase</li>
                            <li>At least one uppercase</li>
                            <li>At least one numeric</li>
                            <li>Minimum 8 characters</li>
                        </ul>
                    </template>
                </Password>
            </div>

            <div @click="submitForm" class="submitInfos"> Proceed to Payment </div>
        </form>
    </div>
    
</template>

<style>
/* Stilizzazione personalizzata dei campi del form */
.custom-input {
    height: 50px;
    width: 300px;
    font-size: 16px;
    display: flex;
    justify-content: center;
}

.p-inputtext{
    padding-left: 10px;
}

.p-password-input{
    padding-left: 10px;
}

.p-icon{
    margin-top: -7px;
}

.formWrapper{
    margin-top: 20px;
    display: flex;
    flex-direction: column;
}

.inputgroup{
    margin-bottom: 30px;
}

.submitInfos{
    padding: 10px 7px;
    border: 1px solid black;
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.submitInfos:hover{
    border: 1px solid #b97533;
    background-color: #b97533;
    color: #fff;
}
</style>

