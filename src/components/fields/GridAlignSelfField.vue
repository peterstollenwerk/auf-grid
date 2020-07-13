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
      name="align_self_class"
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
      options: [
        {value: 'align-self--start',   text: '.align-self--start (TOP)'},
        {value: 'align-self--center',  text: '.align-self--center'},
        {value: 'align-self--end',     text: '.align-self--end (BOTTOM)'},
        {value: 'align-self--stretch', text: '.align-self--stretch'}
      ],
    }
  },
  methods: {
    onChange(value) {
      this.$emit("input", value);
    }
  }
}
</script>

<style>
</style>