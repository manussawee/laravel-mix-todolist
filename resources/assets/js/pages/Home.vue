<template>
  <div class="container" style="padding-top: 32px;">
    <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="card-title">
              Todo list
              <span v-if="isLoading" class="float-right" style="color: gray; font-size: 12px">Loading...</span>
            </div>
            <AddTodoItem
              :todoInput="todoInput"
              @onAdd="addTodo"
            />
            <TodoItem
              :todos="todos"
              @onEdit="onEdit"
              @onRemove="onRemove"
            />
          </div>
        </div>
    </div>
  </div>
</template>

<script>
import AddTodoItem from '../components/AddTodoItem.vue';
import TodoItem from '../components/TodoItem.vue';
import axios from 'axios';

export default {
  data() {
    return {
      todoInput: '',
      isLoading: true,
      todos: [
      ],
    }
  },
  created () {
    axios.get('/todo')
    .then(res => {
      this.todos = res.data.todos;
      this.isLoading = false;
    })
    .catch(err => {
      console.warn('GET TODO ERROR', err);
    });
  },
  methods: {
    addTodo(data) {
      if(data === '') return;
      this.isLoading = true;
      axios.post('/todo', {
        title: data,
      })
      .then(res => {
        this.todos.push(res.data.todo);
        this.isLoading = false;
      })
      .catch(err => {
        console.warn('ADD TODO ERROR', err);
      });
    },
    onRemove(data) {
      this.isLoading = true;
      axios.delete('/todo', {
        params: {
          id: data.id
        },
      })
      .then(res => {
        this.todos = this.todos.filter(todo => todo.id !== data.id);
        this.isLoading = false;
      })
      .catch(err => {
        console.warn('REMOVE TODO ERROR', err);
      });
    },
    onEdit(data) {
      if(data.title === '') return;
      this.isLoading = true;
      let idx = -1;
      this.todos.map((todo, index) => {
        if(todo.id == data.id) idx = index;
      });
      axios.put('/todo', data)
      .then(res => {
        this.todos[idx].title = data.title;
        this.isLoading = false;        
      })
      .catch(err => {
        console.warn('EDIT TODO ERROR', err);        
      });
    },
  },
  components: {
    AddTodoItem,
    TodoItem,
  },
};
</script>
