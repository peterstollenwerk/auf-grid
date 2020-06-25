<template>
  <k-view class="k-grid-settings-view">
    <k-header>Site Grid</k-header>
    settings: {{settings}}
    <br>
    site: {{site}}
    <br>
    <br>
    <k-button @click="saveSettings">Save Settings</k-button>
    <!-- <grid-preview :columnCount="columnCount"/> -->
  </k-view>
</template>

<script>
import GridPreview from "./GridPreview.vue";

export default {

    components: {
        GridPreview,
    },
    data() {
      return {
        settings: Object,
        site: Object
      }
    },
    created() {
      this.load();
    },
    methods: {
      load() {
        this.$api
        .get("grid/settings")
        .then(settings => {
          this.settings = settings;
        });
        this.$api.site.get('title')
        .then(res => {
          this.site = res;
        });
      },
      saveSettings() {
        console.log('saveSettings')
        this.$api.post('grid/set-settings', { test: 'mhhh' })
        .then(res => {
          this.site = res;
        });
      }
    }
};
</script>
<style>
.k-button {
  padding: 0.5rem;
  border: 2px solid black;
}
</style>