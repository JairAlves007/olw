<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Select from "@/Components/Select.vue";
import Table from "@/Components/Table.vue";
import THead from "@/Components/THead.vue";
import TData from "@/Components/TData.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Dialog from "@/Components/Dialog.vue";

const { filters } = defineProps(["beers", "meals", "filters", "flash"]);

const form = useForm("getparams", {
  beer_name: filters.beer_name,
  malt: filters.malt,
  food: filters.food,
  ibu_gt: filters.ibu_gt,
});

const submit = () => {
  form.get(route("beers"));
};

const downloadFile = () => {
  form.post(route("beers.export"));
};
</script>

<template>
  <AuthenticatedLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form @submit.prevent="submit">
          <div class="grid grid-cols-8 gap-4 flex-row items-end">
            <div class="col-span-4 lg:col-span-2">
              <InputLabel for="beer_name" value="Name" />
              <TextInput
                placeholder="Name of the beer"
                id="beer_name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.beer_name"
              />
            </div>

            <div class="col-span-4 lg:col-span-1">
              <InputLabel for="malt" value="Malt" />
              <TextInput
                placeholder="Malt of the beer"
                id="malt"
                type="text"
                class="mt-1 block w-full"
                v-model="form.malt"
              />
            </div>

            <div class="col-span-4 lg:col-span-2">
              <InputLabel for="food" value="Food" />
              <Select
                v-model="form.food"
                placeholder="Choose..."
                :options="meals"
                option-value="name"
                option-label="name"
                class="mt-1 block w-full"
              />
            </div>

            <div class="col-span-4 lg:col-span-1">
              <InputLabel for="ibu_gt" value="IBU" />
              <TextInput
                placeholder="IBU of the beer"
                id="ibu_gt"
                type="text"
                class="mt-1 block w-full"
                v-model="form.ibu_gt"
              />
            </div>

            <div class="col-span-4 lg:col-span-2">
              <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Search
              </PrimaryButton>

              <a
                @click.prevent="downloadFile"
                class="cursor-pointer ml-4 inline-flex items-center px-4 py-1.5 text-white bg-blue-800 border-transparent rounded-md"
              >
                Download
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <Table>
        <template #headColumns>
          <THead type="first" label="Name" />
          <THead type="first" label="Tagline" />
          <THead type="normal" label="First Brewed" />
          <THead type="normal" label="Description" />
        </template>

        <template #tableRows>
          <tr v-for="beer in beers" :key="beer.id">
            <TData type="first">
              {{ beer.name }}
            </TData>

            <TData type="first">
              {{ beer.tagline }}
            </TData>

            <TData type="normal">
              {{ beer.first_brewed }}
            </TData>

            <TData type="normal">
              {{ beer.description }}
            </TData>
          </tr>
        </template>
      </Table>
    </div>

    <Dialog :open="flash.success" title="Sucesso!" :description="flash.message" button="Ok!" />
  </AuthenticatedLayout>
</template>

<style lang="scss" scoped></style>
