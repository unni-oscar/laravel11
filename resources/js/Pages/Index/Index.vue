<template>
  <div>
    Index     
    <div>This message is {{ message }}</div>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps(["message"]);
</script>
