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

    <k-image v-if="active" :src="activeImagePath" ratio="3/1" />

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
      activeImagePath: '/media/plugins/auf/grid/images/' + this.value + '.svg',
      active: this.value,
      options: [
        {value: 'align-items--start',   text: '.align-items--start (TOP)'},
        {value: 'align-items--center',  text: '.align-items--center'},
        {value: 'align-items--end',     text: '.align-items--end (BOTTOM)'},
        {value: 'align-items--stretch', text: '.align-items--stretch'}
      ],
    }
  },
  methods: {
    onChange(value) {
      this.active = this.value;
      this.activeImagePath = '/media/plugins/auf/grid/images/' + this.value + '.svg';
      this.$emit("input", value);
    }
  }
}
</script>

<style>
</style>