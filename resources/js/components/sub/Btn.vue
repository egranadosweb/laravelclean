<template>
    <button class="btn">{{ props.btnText }}</button>
</template>

<script setup>
const props = defineProps(["btnName", "btnText"])
</script>

<style scoped>

</style>