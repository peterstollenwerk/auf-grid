<template>
  <k-view class="k-grid-settings-view">
    <k-header>Site Grid</k-header>

    <div v-for="(value, name) in preset" class="auf-setting">
      <input type="text" :value="value" disabled></input>
      <label for="">{{ name }}</label>
      <br>
      <br>
    </div>

    <br>
    <br>
    <k-button class="auf-grid-button" @click="saveSettings">Generate CSS</k-button>
    <br>
    <br>
    <p>Clicking this button will generate a new css file 
      located at 'assets/auf-grid.css' based on the settings above.</p>
  </k-view>
</template>

<script>

export default {

    data() {
      return {
        preset: Object,
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
          this.preset = settings.preset;
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
.auf-setting > * {
  padding: 0.5rem;
}
</style>