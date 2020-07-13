<template>
  <k-field 
    class="k-grid-field"
    :disabled="disabled"
    :help="help"
    :label="label"
    :required="required"
  >

    <k-image src="/media/plugins/auf/grid/images/icons_align-items_align-items--center.svg" />

    <k-input
      v-model="value"
      :options="options"
      name="inline_grid_items_span_class"
      type="select"
      theme="field"
      @input="onChange"
    />

    <k-icon :type="active" size="large" />

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
      this.active = value;
      this.$emit("input", value);
    }
  }
}
</script>

<style>
.k-icon {
  justify-content: initial;
}
.k-icon[data-size=large] svg {
    width: 10rem;
    height: 10rem;
}
</style>