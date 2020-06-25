<template>
  <k-field 
    class="auf-grid-column-presets-field"
    :disabled="disabled"
    :help="help"
    :label="label"
    :required="required"
  >

    <k-structure-field
      v-model="value"
      :required="false"
      label="Grid Column Presets"
      name="grid_column_presets"
      help=""
      :fields="fields"
      @input="input"
    />

    {{store}}

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
      counter: 1,
    }
  },
  created() {
  },
  computed: {
  },
  methods: {
    onChange(value) {
      this.$emit("input", value);
    }
  }
}
</script>

<style>
  /* optional scoped styles for the component */
</style>