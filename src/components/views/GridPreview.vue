<template>
  <div class="k-reviews">
    {{ reviews[0] }}
  </div>
</template>

<script>
export default {
  data() {
    return {
      reviews: [],
    };
  },
  created() {
    this.load();
  },
  methods: {
    load() {
      this.$api
        .get("moviereviews")
        .then(reviews => {
          this.reviews = reviews;
        });
    }
  }
}
</script>