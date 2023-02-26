<script>
export default {
    name: 'ThankYou',
    components: {

    },
    data() {
        return {
        }
    },
    methods: {
        timingRedirect() {
            this.$router.push({ name: 'home' });
        }

    },
    mounted() {
        setTimeout(this.timingRedirect, 3000);
    }
}
</script>
<template>
    THANK YOU PAGE
</template>

<style></style>
