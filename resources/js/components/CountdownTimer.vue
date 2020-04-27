<template>
    <div class="border-4 border-black bg-blue-600 w-full flex relative h-16 mb-8" :class="[ display ? '' : 'invisible' ]">
        <div class="absolute mx-auto left-0 right-0 w-full bg-red-700 h-full z-0" ref="progress"></div>
        <div class="border-r-4 h-full w-1/9 border-black z-10"></div>
        <div class="border-r-4 h-full w-1/9 border-black z-10"></div>
        <div class="border-r-4 h-full w-1/9 border-black z-10"></div>
        <div class="border-r-4 h-full w-1/9 border-black z-10"></div>
        <div class="border-r-4 h-full w-1/9 border-black z-10"></div>
        <div class="border-r-4 h-full w-1/9 border-black z-10"></div>
        <div class="border-r-4 h-full w-1/9 border-black z-10"></div>
        <div class="border-r-4 h-full w-1/9 border-black z-10"></div>
    </div>
</template>

<script>
    export default {
        props: {
            display: {
                type: Boolean,
                required: false,
                default: true,
            },
            decreaseInBlocks: {
                type: Boolean,
                required: false,
                default: false,
            },
            duration: {
                type: Number,
                required: false,
                default: 5000,
            }
        },

        methods: {
            start(duration) {
                if (duration === undefined) {
                    duration = this.duration;
                }

                const targets = this.$refs.progress;

                let decreaseInBlocks = {
                    targets,
                    duration: duration,
                    keyframes: [
                        {width: '77.7%'},
                        {width: '55.4%'},
                        {width: '33.2%'},
                        {width: '11.1%'},
                        {width: 0}
                    ],
                    easing: 'steps(1)'
                };

                let decreaseLinear = {
                    targets,
                    duration: duration,
                    easing: 'linear',
                    width: 0,
                };

                this
                    .$anime
                    .timeline()
                    .add((this.decreaseInBlocks) ? decreaseInBlocks : decreaseLinear);
            }
        },

        mounted() {

        }

    }
</script>
