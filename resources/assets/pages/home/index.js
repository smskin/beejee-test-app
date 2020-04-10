import './index.scss';
import TaskItem from './components/task-item.vue';
import CreateTaskForm from './components/create-task-form.vue';
import TaskFilter from './components/task-filter.vue';

Promise.all([
    import('modules/vue' /* webpackChunkName: "vue-module" */).then((a) => {return a.default})
]).then(([Vue]) => {
    new Vue({
        el: '#tasks',
        components: {
            TaskItem,
            CreateTaskForm,
            TaskFilter
        },
        data: {
            tasks: [],
            filter: 'userName',
            page: 1,
            limit: 3
        },
        watch: {
            filter: function(){
                this.loadTasks();
            }
        },
        methods: {
            loadTasks(){
                const query = [
                    'filter=' + this.filter,
                    'page=' + this.page,
                    'limit=' + this.limit
                ];

                this.$http.get(
                    '/tasks?' + query.join('&')
                ).then((response) => {
                    console.log(response.data);
                    this.tasks = response.data.tasks;
                })
            },
            onTaskCreated: function(){
                this.loadTasks();
                // this.tasks.push(task);
            }
        },
        mounted(){
            this.loadTasks();
        }
    });
});