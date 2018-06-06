<template>
  <div class="form-inline">
    <input class="form-control" type="text" v-model="text"  />
    <button class="btn btn-primary" style="margin-left: 4px" @click="onAdd">ADD</button>
  </div>
</template>

<script>
export default {
  props: [
    'todoInput',
  ],
  data() {
    return {
      text: this.todoInput,
    };
  },
  methods: {
    onAdd() {
      this.$emit('onAdd', this.text);
      this.text = '';
    },
  },
}
</script>
