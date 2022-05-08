<template>
  <div>
    <div class="mb-4">
      <Link
        class="group flex items-center py-3"
        href="/admin"
      >
      <icon
        name="dashboard"
        class="mr-2 w-4 h-4"
        :class="isUrl('admin') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'"
      />
      <div :class="isUrl('admin') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Dashboard</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link
        class="group flex items-center py-3"
        href="/admin/pages"
      >
      <icon
        name="dashboard"
        class="mr-2 w-4 h-4"
        :class="isUrl('admin/pages') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'"
      />
      <div :class="isUrl('admin/pages') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Pages</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link
        class="group flex items-center py-3"
        href="/admin/modules"
      >
      <icon
        name="dashboard"
        class="mr-2 w-4 h-4"
        :class="isUrl('admin/modules') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'"
      />
      <div :class="isUrl('admin/modules') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Modules</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link
        class="group flex items-center py-3"
        href="/admin/topics"
      >
      <icon
        name="dashboard"
        class="mr-2 w-4 h-4"
        :class="isUrl('admin/topics') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'"
      />
      <div :class="isUrl('admin/topics') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Topics</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link
        class="group flex items-center py-3"
        href="/admin/questions"
      >
      <icon
        name="dashboard"
        class="mr-2 w-4 h-4"
        :class="isUrl('admin/questions') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'"
      />
      <div :class="isUrl('admin/questions') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Questions</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link
        class="group flex items-center py-3"
        href="/admin/managers"
      >
      <icon
        name="dashboard"
        class="mr-2 w-4 h-4"
        :class="isUrl('admin/managers') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'"
      />
      <div :class="isUrl('admin/managers') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Managers</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link
        class="group flex items-center py-3"
        href="/admin/users"
      >
      <icon
        name="dashboard"
        class="mr-2 w-4 h-4"
        :class="isUrl('admin/users') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'"
      />
      <div :class="isUrl('admin/users') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Users</div>
      </Link>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import Icon from "@/Shared/Icon";
export default {
  components: {
    Icon,
    Link,
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1);
      if (urls[0] === "") {
        return currentUrl === "";
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length;
    },
  },
};
</script>
