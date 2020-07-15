<template>

  <div>

  <k-fieldset v-model="grid_settings" @input="input" :fields="{
    grid_column_preset: {
      label: 'Column Preset',
      type: 'grid_column_preset',
      help: 'select »custom...« for custom start- and end-column',
    },
    grid_column_start_class: {
      label: 'Column Start Class',
      type: 'grid_column_start_class',
      classes: start_classes,
      width: '1/2',
      when: { 
        grid_column_preset: 'grid__column--custom' 
      }
    },
    grid_column_end_class: {
      label: 'Column End Class',
      type: 'grid_column_end_class',
      classes: end_classes,
      width: '1/2',
      when: { 
        grid_column_preset: 'grid__column--custom' 
      }
    },
    grid_settings_devider_1: {
      type: 'line',
      when: { 
        grid_column_preset: 'grid__column--custom' 
      },
    },
    grid_expert_mode_toggle: {
      label: 'Expert Mode',
      type: 'toggle',
    },
    grid_justify_self_class: {
      label: 'Justify Self Class',
      type: 'grid_justify_self',
      width: '1/2',
      help: 'horizontal alignment',
      when: { grid_expert_mode_toggle: true }
    },
    grid_align_self_class: {
      label: 'Align Self Class',
      type: 'grid_align_self',
      width: '1/2',
      help: 'vertical alignment',
      when: { grid_expert_mode_toggle: true }
    },
    grid_outset_left: {
      label: 'Outset Left',
      type: 'toggle',
      width: '1/2',
      help: 'remove left column gap',
      when: { grid_expert_mode_toggle: true }
    },
    grid_outset_right: {
      label: 'Outset Right',
      type: 'toggle',
      width: '1/2',
      help: 'remove right column gap',
      when: { grid_expert_mode_toggle: true }
    },
    grid_margin_top: {
      label: 'Margin Top',
      type: 'number',
      width: '2/4',
      after: 'rem',
      help: 'add extra space between items or...',
      when: { grid_expert_mode_toggle: true }
    },
    grid_margin_bottom: {
      label: 'Margin Bottom',
      type: 'number',
      width: '2/4',
      after: 'rem',
      help: '... use negative margins to make them overlap',
      when: { grid_expert_mode_toggle: true }
    }
  }" />

  </div>

</template>

<script>
export default {
  props: {
    start_classes: Array,
    end_classes: Array,
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

      if(this.grid_settings.grid_expert_mode_toggle === false) {
        this.grid_settings = {}
      }

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