<template>
  <div>

    <Head :title="form.name" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link
        class="text-indigo-400 hover:text-indigo-600"
        href="/admin/topics"
      >Topics</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name }}
    </h1>
    <trashed-message
      v-if="topic.deleted_at"
      class="mb-6"
      @restore="restore"
    > This topic has been deleted. </trashed-message>
    <div class="bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input
            v-model="form.name"
            :error="form.errors.name"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Name"
          />
          <textarea-input
            v-model="form.description"
            :error="form.errors.description"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Description"
          />

          <file-input
            v-model="form.photo"
            :error="form.errors.photo"
            class="pb-8 pr-6 w-full lg:w-1/2"
            type="file"
            accept="image/*"
            label="Badge"
          />
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button
            v-if="!topic.deleted_at"
            class="text-red-600 hover:underline"
            tabindex="-1"
            type="button"
            @click="destroy"
          >Delete Topic</button>
          <loading-button
            :loading="form.processing"
            class="btn-indigo ml-auto"
            type="submit"
          >Update Topic</loading-button>
        </div>
      </form>
    </div>
    <h2 class="mt-12 text-2xl font-bold">Questions</h2>
    <div class="mt-6 bg-white rounded shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">ID</th>
          <th class="pb-4 pt-6 px-6">Question</th>
        </tr>
        <tr
          v-for="question in topic.questions"
          :key="question.id"
          class="hover:bg-gray-100 focus-within:bg-gray-100"
        >
          <td class="border-t">
            <Link
              class="flex items-center px-6 py-4 focus:text-indigo-500"
              :href="`/admin/questions/${question.id}/edit`"
            >
            {{ question.id }}
            <icon
              v-if="topic.deleted_at"
              name="trash"
              class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400"
            />
            </Link>
          </td>
          <td class="border-t">
            <Link
              class="flex items-center px-6 py-4"
              :href="`/admin/questions/${question.id}/edit`"
              tabindex="-1"
            >
            {{ question.content }}
            </Link>
          </td>
          <td class="w-px border-t">
            <Link
              class="flex items-center px-4"
              :href="`/admin/questions/${question.id}/edit`"
              tabindex="-1"
            >
            <icon
              name="cheveron-right"
              class="block w-6 h-6 fill-gray-400"
            />
            </Link>
          </td>
        </tr>
        <tr v-if="topic.questions.length === 0">
          <td
            class="px-6 py-4 border-t"
            colspan="4"
          >No questions found.</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Icon from "@/Shared/Icon";
import Layout from "@/Shared/Layout";
import TextInput from "@/Shared/TextInput";
import TextareaInput from "@/Shared/TextareaInput";
import LoadingButton from "@/Shared/LoadingButton";
import TrashedMessage from "@/Shared/TrashedMessage";
import FileInput from "@/Shared/FileInput";
export default {
  components: {
    Head,
    Icon,
    Link,
    LoadingButton,
    TextareaInput,
    TextInput,
    TrashedMessage,
    FileInput,
  },
  layout: Layout,
  props: {
    topic: Object,
  },
  remember: "form",
  data() {
    return {
      form: this.$inertia.form({
        name: this.topic.name,
        description: this.topic.description,
        photo: null,
      }),
    };
  },
  methods: {
    update() {
      this.form.put(`/admin/topics/${this.topic.id}`);
    },
    destroy() {
      if (confirm("Are you sure you want to delete this topic?")) {
        this.$inertia.delete(`/admin/topics/${this.topic.id}`);
      }
    },
    restore() {
      if (confirm("Are you sure you want to restore this topic?")) {
        this.$inertia.put(`/admin/topics/${this.topic.id}/restore`);
      }
    },
  },
};
</script>
