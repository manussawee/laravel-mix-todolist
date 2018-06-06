<template>
  <div style="margin-top: 16px">
    <div :key="index" v-for="(item, index) in todos_" style="margin-bottom: 8px">
      <span v-if="editIndex !== index">
        {{ index + 1 }} - {{ item.title }}
        <div class="float-right">
          <button @click="() => setEditIndex(index)">EDIT</button>
          <button @click="() => onRemove(index)">REMOVE</button>
        </div>
      </span>
      <span v-else-if="editIndex === index">
        <input v-model="editInput"/>
        <button @click="() => submitEdit(index)">OK</button>
      </span>
      
    </div>
  </div>
</template>

<script>
export default {
  props: ['todos'],
  data() {
    return {
      todos_: this.todos,
      editIndex: -1,
      editInput: '',
    };
  },
  watch: {
    todos(val) {
      this.todos_ = val;
    },
  },
  methods: {
    onRemove(index) {
      this.$emit('onRemove', this.todos_[index]);
    },
    setEditIndex(index) {
      this.editIndex = index;
      this.editInput = this.todos_[index].title;
    },
    submitEdit(index) {
      let data = {
        id: this.todos_[index].id,
        title: this.editInput
      };
      this.$emit('onEdit', data);
      this.editInput = '';
      this.editIndex = -1;
    },
  }
}
</script>
