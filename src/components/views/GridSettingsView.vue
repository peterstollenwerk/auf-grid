<template>
  <k-view class="k-grid-settings-view">
    <k-header>Grid Settings</k-header>
    <grid-column-field />
     <grid-preview />
  </k-view>
</template>

<script>
import GridPreview from "./GridPreview.vue";
import GridColumnField from "../fields/GridColumnField.vue";

export default {
    components: {
        GridPreview,
        GridColumnField
    }
};
</script>