<template>



</template>

<script>
    import {mapState} from 'vuex';

    export default {
        data() {

        },
        computed: {
            ...mapState([ 'sessionId' ]),
        }
    }
</script>
