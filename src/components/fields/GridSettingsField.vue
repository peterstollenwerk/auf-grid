<template>

  <div>
  <k-fieldset v-model="grid_settings" @input="input" :fields="{
    grid_column_preset: {
      label: 'Grid Item Column Preset',
      type: 'grid_column_preset'
    },
    grid_column_start_class: {
      label: 'Grid Item Column Start Class',
      type: 'grid_column_start_class',
      classes: start_classes,
      when: {
        grid_column_preset: 'grid__column--custom'
      }
    },
    grid_justify_self_class: {
      label: 'Grid Item Justify Self Class',
      type: 'grid_justify_self',
      width: '1/2',
    }
  }" />

    Value: {{value}}

  </div>

</template>

<script>
export default {
  props: {
    start_classes: Array,
    help: String,
    label: String,
    after: String,
    before: String,
    disabled: Boolean,
    required: Boolean,
    value: String,
  },
  data() {
    return {
      grid_settings: {}
    }
  },
  created() {
    this.load();
  },
  methods: {
    load() {
      if(this.value) {
        this.grid_settings = JSON.parse(this.value);
      }
    },
    input() {
      console.log(this.grid_settings);
      this.$emit("input", JSON.stringify(this.grid_settings, function(key, value){
        // only store actual values
        if (value.length < 1) { return undefined; }
        return value;
      }, ' '));
    },
  }
}
</script>

<style>
  /* optional scoped styles for the component */
</style>