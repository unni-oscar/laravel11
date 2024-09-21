<template>
  <div>
    <Link href="/">Index</Link>&nbsp; 
    <Link href="/hello">Show</Link>&nbsp;
    <div>The page with time {{ timer }} </div>
    <slot></slot>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
const timer = ref(0);
setInterval(() => timer.value++, 1000);
</script>