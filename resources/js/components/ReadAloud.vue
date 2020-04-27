<template>
    <div>
        <slot></slot>
    </div>
</template>

<script>
    export default {

        methods: {
            speak() {
                let text = this.$slots.default[0].text;
                let msg = new SpeechSynthesisUtterance(text);
                msg.onend = () => { this.$emit('finished') };
                speechSynthesis.speak(msg);
            }
        },

        mounted() {
            this.speak();
        }


    }
</script>
