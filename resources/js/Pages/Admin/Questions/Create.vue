<template>
  <div>

    <Head title="Create Questions" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link
        class="text-indigo-400 hover:text-indigo-600"
        href="/admin/questions"
      >Questions</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <textarea-input
            v-model="form.content"
            :error="form.errors.content"
            class="pb-8 pr-6 w-full lg:w-1/2"
            label="Content"
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
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button
            :loading="form.processing"
            class="btn-indigo"
            type="submit"
          >Create Question</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Layout from "@/Shared/Layout";
import TextInput from "@/Shared/TextInput";
import TextareaInput from "@/Shared/TextareaInput";
import LoadingButton from "@/Shared/LoadingButton";
export default {
  components: {
    Head,
    Link,
    LoadingButton,
    TextInput,
    TextareaInput,
  },
  layout: Layout,
  remember: "form",
  data() {
    return {
      form: this.$inertia.form({
        content: null,
        answer1: null,
        answer2: null,
        answer3: null,
        answer4: null,
        correct_answer: null,
      }),
    };
  },
  methods: {
    store() {
      this.form.post("/admin/questions");
    },
  },
};
</script>
