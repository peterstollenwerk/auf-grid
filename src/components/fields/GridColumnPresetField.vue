<template>
  <k-field 
    class="k-grid-field"
    :disabled="disabled"
    :help="help"
    :label="label"
    :required="required"
  >

    <k-input
      v-model="value"
      :options="options"
      name="grid_column_preset"
      type="select"
      theme="field"
      @input="onChange"

    />

  </k-field>


</template>

<script>
export default {
  props: {
    after: String,
    before: String,
    disabled: Boolean,
    help: String,
    label: String,
    required: Boolean,
    value: String,
  },
  data: function() {
    return {
      gridColumnCustomPreset: { 
        grid_column_class: "grid__column--custom", 
        grid_column_label: "Custom..."},
      options: []
    }
  },
  created() {
    this.load();
  },
  methods: {
    load() {
      this.$api.site.get()
        .then(res => {
          const gridColumnPresets = res.content.grid_column_presets;
          gridColumnPresets.push(this.gridColumnCustomPreset);
          const options = [];
          gridColumnPresets.forEach(preset => {
            options.push({value: preset.grid_column_class, text: preset.grid_column_label});
          });
          this.options = options;
        });
    },
    onChange(value) {
      this.$emit("input", value);
    }
  }
}
</script>

<style>
  /* optional scoped styles for the component */
</style>