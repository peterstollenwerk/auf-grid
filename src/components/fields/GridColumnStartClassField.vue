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
      name="grid_column_start_classes"
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
        options.push({value: item, text: item });
      });
      this.options = options;
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