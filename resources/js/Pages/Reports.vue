<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Table from "@/Components/Table.vue";
import THead from "@/Components/THead.vue";
import TData from "@/Components/TData.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Dialog from "@/Components/Dialog.vue";

const { exports, flash } = defineProps(["exports", "flash"]);
</script>

<template>
  <AuthenticatedLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <Table :paginator="exports">
          <template #headColumns>
            <THead type="first" label="Name" />
            <THead type="action" label="Download" />
            <THead type="action" label="Delete" />
          </template>

          <template #tableRows>
            <tr v-for="report in exports.data" :key="report.id">
              <TData type="first">
                {{ report.file_name }}
              </TData>

              <TData type="action">
                <a
                  :href="route('reports.show', report.id)"
                  class="flex flex-col items-center mx-auto p-4 bg-blue-900 text-white rounded-md"
                >
                  Download
                </a>
              </TData>

              <TData type="action">
                <Link
                  :href="route('reports.destroy', report.id)"
                  method="delete"
                  class="flex mx-auto p-4 bg-red-600 text-white rounded-md"
                  as="button"
                >
                  Delete
                </Link>
              </TData>
            </tr>
          </template>
        </Table>
      </div>
    </div>

    <Dialog
      :open="flash.success"
      title="Sucesso!"
      :description="flash.message"
      button="Ok!"
    />
  </AuthenticatedLayout>
</template>

<style lang="scss" scoped></style>
