<template>
  <k-view class="k-grid-settings-view">
    <k-header>Site Grid</k-header>
    columnCount: {{columnCount}}
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
        columnCount: Number,
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
      }
    }
};
</script>