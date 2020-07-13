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
      name="inline_grid_items_span_class"
      type="select"
      theme="field"
      @input="onChange"

    />

  </k-field>


</template>

<script>
export default {
  props: {
    classes: Array,

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
      options: []
    }
  },
  created() {
    this.load();
  },
  methods: {
    load() {
      const options = [];
      const classesCount = this.classes.length;
      let i = 1;
      this.classes.forEach(item => {
        options.push({value: item, text: 'span ' + i++ });
      });
      this.options = options;
      // this.$api.site.get()
      //   .then(res => {
      //     const gridColumnPresets = res.content.grid_column_presets;
      //     gridColumnPresets.push(this.gridColumnCustomPreset);
      //     const options = [];
      //     gridColumnPresets.forEach(preset => {
      //       options.push({value: preset.grid_column_class, text: preset.grid_column_label});
      //     });
      //     this.options = options;
      //   });
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