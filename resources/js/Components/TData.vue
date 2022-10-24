<script setup>
import { computed } from "vue";

const { type } = defineProps(["type"]);

const classes = computed(() => {
  switch (type) {
    case "first":
      return "py-2.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6";
    case "normal":
      return "hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell";
    case "action":
      return "relative py-3.5 pl-3 pr-4 sm:pr-6";
    default:
      break;
  }
});
</script>

<template>
  <td :class="classes">
    <slot />
  </td>
</template>

<style lang="scss" scoped></style>
