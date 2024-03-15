<template>
  <div class="text-red-400">{{ store.x }}</div>
  <button :onClick="() => store.x++" class="px-4 py-2 bg-blue-500">+</button>
  <Icon name="uil:github" color="black" />
</template>

<script setup>
import { useTestStore } from '~/stores/testStore'
const store = useTestStore();
</script>

<style lang="scss" scoped></style>
