<template>
  <k-view class="k-grid-settings-view">
    <k-header>Site Grid</k-header>
    columnCount: {{columnCount}}
    <br>
    settings: {{settings}}
    <grid-preview :columnCount="columnCount"/>
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
        columnCount: 111,
        settings: String
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
          this.columnCount = settings.columnCount;
        });
        this.$api
        .get("grid/set-settings")
        .then(response => {
          this.settings = response;
        });
      }
    }
};
</script>