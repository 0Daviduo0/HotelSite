<template>
    <!-- ... altri elementi ... -->
    <div id="dropin-container"></div>
    <button id="submit-button">Paga ora</button>
    <!-- ... altri elementi ... -->
</template>

<script setup>
import { ref, onMounted } from 'vue';

const instance = ref(null);

onMounted(async () => {
    await initializeBraintree();
});

async function initializeBraintree() {
    // Ottieni il client token dal tuo backend
    const response = await fetch('http://localhost:8000/api/braintree/token');
    const data = await response.json();
    const clientToken = data.token;

    // Inizializza il drop-in UI
    braintree.dropin.create({
        authorization: clientToken,
        container: '#dropin-container'
    }, (createErr, braintreeInstance) => {
        if (createErr) {
            console.error('Errore nella creazione del drop-in:', createErr);
            return;
        }
        instance.value = braintreeInstance;
    });
}

async function processPayment() {
    instance.value.requestPaymentMethod(async (requestPaymentMethodErr, payload) => {
        if (requestPaymentMethodErr) {
            console.error('Errore nella richiesta del metodo di pagamento:', requestPaymentMethodErr);
            return;
        }

        // Invia il nonce al tuo server per effettuare il pagamento
        const response = await fetch('http://localhost:8000/api/braintree/payment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nonce: payload.nonce,
                // Imposta l'importo del pagamento. Questo dovrebbe provenire dal tuo frontend o backend.
                amount: '10.00' 
            })
        });

        const data = await response.json();
        if (data.success) {
            alert('Pagamento effettuato con successo!');
        } else {
            alert('Errore nel pagamento:', data.message);
        }
    });
}

</script>
