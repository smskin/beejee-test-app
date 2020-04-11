import './index.scss';
import TaskItem from './components/task-item.vue';
import CreateTaskForm from './components/create-task-form.vue';
import TaskFilter from './components/task-filter.vue';
import Pagination from './components/pagination.vue';

Promise.all([
    import('modules/vue' /* webpackChunkName: "vue-module" */).then((a) => {return a.default}),
    import('lodash' /* webpackChunkName: "lodash" */).then((a) => {return a.default}),
]).then(([Vue, _]) => {

    new Vue({
        el: '#tasks',
        components: {
            TaskItem,
            CreateTaskForm,
            TaskFilter,
            Pagination
        },
        data: {
            user: {
                authorized: false
            },
            tasks: [],
            filter: 'userName',
            filterDirect: 'asc',
            pagination: {
                page: 1,
                limit: 3,
                pages: 1
            }
        },
        computed: {
            isGuest: function(){
                return !this.user.authorized;
            },
            isAuthorized: function(){
                return this.user.authorized;
            }
        },
        watch: {
            filter: function(){
                this.loadTasks();
            },
            filterDirect: function(){
                this.loadTasks();
            }
        },
        methods: {
            loadTasks(){
                const query = [
                    'filter=' + this.filter,
                    'filterDirect=' + this.filterDirect,
                    'page=' + this.pagination.page,
                    'limit=' + this.pagination.limit
                ];

                this.$http.get(
                    '/api/tasks?' + query.join('&')
                ).then((response) => {
                    this.pagination.limit = response.data.limit;
                    this.pagination.page = response.data.page;
                    this.pagination.pages = response.data.pages;
                    this.tasks = response.data.tasks;
                })
            },
            onTaskCreated: function(){
                this.loadTasks();
                // this.tasks.push(task);
            },
            onChangePage: function(page){
                this.pagination.page = page;
                this.loadTasks();
            },
            updateTask: function(task){
                const index = _.findIndex(this.tasks, function(item) {
                    return item.id === task.id;
                });
                this.tasks[index] = task;
            },
            onChangeFilter: function(model){
                this.filter = model.filter;
                this.filterDirect = model.filterDirect;
            },
            logout: function(){
                this.$http.post(
                    '/api/auth/logout'
                ).then(() => {
                    const event = new Event('logout');
                    document.dispatchEvent(event);

                    this.$bvToast.toast(`Вы успешно вышли из системы`, {
                        title: 'Успех',
                        autoHideDelay: 5000
                    })
                })
            }
        },
        mounted(){
            this.loadTasks();

            document.addEventListener('userLoaded', (e) => {
                this.user = e.detail;
            }, false);
        }
    });
});