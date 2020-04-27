<template>
    <div class="bg-blue-900 h-screen w-screen text-center flex flex-col items-center">
        <countdown-timer :display="readingCompleted" ref="countdown"></countdown-timer>
        <p class="text-shadow-sm text-yellow-600 text-vh-4">
            {{ category }}<br/>
            ${{dollarValue}}
        </p>
        <h3 class="text-shadow-sm text-white text-vh-6 flex-grow flex items-center">
            <read-aloud @finished="enableBuzzing">
                This drama was about the survivors of the crash of Oceanic flight 815
            </read-aloud>
        </h3>
    </div>
</template>

<script>
    import ReadAloud from "./ReadAloud";
    export default {
        components: {ReadAloud},
        data() {
            return {
                category: "ONE-WORD TV TITLES",
                dollarValue: 200,
                readingCompleted: false,
            }
        },
        methods: {
            enableBuzzing() {
                this.readingCompleted = true;
                this.$refs.countdown.start();
            }
        },

        mounted() {
        }
    }
</script>
