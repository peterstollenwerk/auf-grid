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
      name="justify_items_class"
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
        {value: 'justify-items--start',   text: '.justify-items--start (LEFT)'},
        {value: 'justify-items--center',  text: '.justify-items--center'},
        {value: 'justify-items--end',     text: '.justify-items--end (RIGHT)'},
        {value: 'justify-items--stretch', text: '.justify-items--stretch'}
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