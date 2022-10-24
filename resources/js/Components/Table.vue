<script setup>
defineProps(["paginator"]);
</script>

<template>
  <div
    class="-mx-4 mt-8 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md-mx-0 md-rounded-lg"
  >
    <table class="min-w-full divide-y divide-gray-300">
      <thead class="bg-gray-50">
        <tr>
          <slot name="headColumns" />
        </tr>
      </thead>

      <tbody class="divide-y divide-gray-200 bg-white">
        <slot name="tableRows" />
      </tbody>
    </table>
    <template v-if="paginator">
      <div
        class="flex flex-1 justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
      >
        <div class="flex-flex-1 justify-between sm:hidden">
          <a
            href="#"
            class="relative inline-flex items-center rounded-md border border-gray-300 bg-white"
          ></a>
          <a
            href="#"
            class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white"
          ></a>
        </div>
      </div>

      <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <div>
          <p class="text-sm text-gray-700">
            Showing

            <span class="font-medium">
              {{ paginator.from }}
            </span>

            to

            <span class="font-medium">
              {{ paginator.to }}
            </span>

            of

            <span class="font-medium">
              {{ paginator.total }}
            </span>

            results.
          </p>
        </div>

        <div>
          <nav
            class="isolate inline-flex -space-x-px rounded-md shadow-sm"
            aria-label="Pagination"
          >
            <a
              :href="paginator.prev_page_url"
              class="cursor-pointer relative inline-flex items-center px-4 rounded-l-md border border-gray-300 bg-white"
            >
              <span class="font-medium text-black"> Previous </span>
            </a>

            <template v-for="(link, index) in paginator.links" :key="link.label">
              <a
                v-if="link.label == index"
                :href="link.url"
                :class="{
                  'z-10 bg-indigo-50 border-indigo-500 text-indigo-600': link.active,
                }"
                class="relative items-center border border-gray-300 px-4 py-2 text-black"
              >
                {{ link.label }}
              </a>
            </template>

            <a
              :href="paginator.next_page_url"
              class="cursor-pointer relative px-4 inline-flex items-center rounded-r-md"
            >
              <span class="font-medium text-black"> Next </span>
            </a>
          </nav>
        </div>
      </div>
    </template>
  </div>
</template>

<style lang="scss" scoped></style>
