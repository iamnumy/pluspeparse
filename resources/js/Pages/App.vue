<template>
  <div id="app">
      <router-view />
    </div>
</template>

<script>

import Sidebar from "@/Components/views/NavBar.vue";

export default {
    name: "App",
    components: {Sidebar},
    props: {
        isMobile: Boolean,
        isDesktop: Boolean
    },
    data: function () {
        return {
            theme: 'dark',
        }
    },
    methods: {
        switchTheme() {
            this.theme = this.theme == '' ? 'dark' : '';

        },
    },
};
</script>

<style>

</style>
