<template>
  <div>

    <Head :title="form.content" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link
        class="text-indigo-400 hover:text-indigo-600"
        href="/admin/questions"
      >Questions</Link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.content }}
    </h1>
    <trashed-message
      v-if="question.deleted_at"
      class="mb-6"
      @restore="restore"
    > This question has been deleted. </trashed-message>
    <div class="bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <textarea-input
            v-model="form.content"
            :error="form.errors.content"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Description"
          />
          <text-input
            v-model="form.answer1"
            :error="form.errors.answer1"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Answer1"
          />
          <text-input
            v-model="form.answer2"
            :error="form.errors.answer2"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Answer2"
          />
          <text-input
            v-model="form.answer3"
            :error="form.errors.answer3"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Answer3"
          />
          <text-input
            v-model="form.answer4"
            :error="form.errors.answer4"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Answer4"
          />
          <text-input
            v-model="form.correct_answer"
            :error="form.errors.correct_answer"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Correct Answer"
          />
        </div>
        <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100">
          <button
            v-if="!question.deleted_at"
            class="text-red-600 hover:underline"
            tabindex="-1"
            type="button"
            @click="destroy"
          >Delete Question</button>
          <loading-button
            :loading="form.processing"
            class="btn-indigo ml-auto"
            type="submit"
          >Update Question</loading-button>
        </div>
      </form>
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
  },
  layout: Layout,
  props: {
    question: Object,
  },
  remember: "form",
  data() {
    return {
      form: this.$inertia.form({
        content: this.question.content,
        answer1: this.question.answer1,
        answer2: this.question.answer2,
        answer3: this.question.answer3,
        answer4: this.question.answer4,
        correct_answer: this.question.correct_answer,
      }),
    };
  },
  methods: {
    update() {
      this.form.put(`/admin/questions/${this.question.id}`);
    },
    destroy() {
      if (confirm("Are you sure you want to delete this question?")) {
        this.$inertia.delete(`/admin/questions/${this.question.id}`);
      }
    },
    restore() {
      if (confirm("Are you sure you want to restore this question?")) {
        this.$inertia.put(`/admin/questions/${this.question.id}/restore`);
      }
    },
  },
};
</script>
