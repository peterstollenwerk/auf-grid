<template>
  <k-field 
    class="k-grid-field"
    :disabled="disabled"
    :help="help"
    :label="label"
    :required="required"
  >

    Test Prop: {{test}}

    <k-input
      v-model="value"
      :options="[
          { value: 'main', text: 'Main' },
          { value: 'aside', text: 'Aside' },
          { value: 'custom', text: 'Custom...' }
      ]"
      name="grid__column__class"
      type="select"
      theme="field"
      @input="onChange"

    />
    <div v-if="isCustom">Custom Column! ; )</div>
    <p>Counter: {{ counter }}</p>

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
    test: String
  },
  data: function() {
    return {
      counter: 1
    }
  },
  computed: {
    isCustom: function() {
      this.counter += 1;
      return this.value === 'custom';
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
  /* optional scoped styles for the component */
</style>