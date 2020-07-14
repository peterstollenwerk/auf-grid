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
      name="grid_justify_self_class"
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
        {value: 'justify-self--start',   text: 'justify-self--start (LEFT)'},
        {value: 'justify-self--center',  text: 'justify-self--center'},
        {value: 'justify-self--end',     text: 'justify-self--end (RIGHT)'},
        {value: 'justify-self--stretch', text: 'justify-self--stretch'}
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