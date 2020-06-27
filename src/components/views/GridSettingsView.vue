<template>
  <k-view class="k-grid-settings-view">
    <k-header>Site Grid</k-header>
    settings: {{settings}}
    <br>
    <br>
    <br>
    <br>
    <k-button class="auf-grid-button" @click="saveSettings">Save Settings</k-button>
  </k-view>
</template>

<script>

export default {

    data() {
      return {
        settings: Object,
        gridColumnTemplate: String,
        content: Object
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
      },
      saveSettings() {
        this.$api
        .post('grid/settings', { 
          settings: { 
            gridColumnTemplate: this.gridColumnTemplate
          } })
        .then(res => {
          this.settings = res;
          this.$store.dispatch("notification/success", {
            type: "success",
            message: "Grid Settings Saved! : )",
            timeout: 1000
          });
        })
        .catch(err => {
          console.log(err);
        });
      },
      onGridColumnInput (value) {
        this.gridColumnTemplate = value;
        this.saveSettings()
      }
    }
};
</script>
<style>
.auf-grid-button {
  padding: 0.5rem;
  border: 2px solid black;
}
</style>