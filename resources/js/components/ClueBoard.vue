<template>
    <div class="board h-screen w-screen text-center flex h-full w-full bg-blue-900 text-yellow-600 font-black">
        <div v-for="category in categories" class="flex flex-col items-center justify-center h-full w-1/6">
            <span class="text-shadow-sm text-vh-6 category-name border-4 border-black w-full h-1/6 text-white">{{ category }}</span>
            <div v-for="value in [ 200, 400, 600, 800, 1000 ]" class="p-2 text-vh-8 h-1/6 w-full flex flex-col items-center justify-center border-4 border-black">
                <span class="text-shadow-lg">${{ value }}</span>
            </div>


        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: [
                    'one',
                    'two',
                    'three',
                    'four',
                    'five',
                    'six',
                ]
            }
        }
    }
</script>

<style>
</style>
