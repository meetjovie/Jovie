<template>
    <ContactSidebar/>
</template>
<script>
import ContactSidebar from '../components/ContactSidebar.vue';

export default {
    components: {
        ContactSidebar,
    },
    mounted() {
        window.onmessage = function(e) {

            var payload = JSON.parse(e.data);
            console.log('payloadpayloadpayloadpayloadpayloadpayloadpayloadpayloadpayload');
            console.log(payload);
        };
    }
};
</script>
