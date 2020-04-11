<template>
    <li class="list-group-item">
        <div class="row">
           <div v-bind:class="{'col-lg-10 col-sm-12': isAuthorized, 'col-12': isGuest}">
               Имя пользователя: {{ task.userName }}<br />
               E-mail: {{ task.email }}<br />
               Текст задачи: <span class="pre-formatted">{{ task.text }}</span><br />
               Статус: {{ status }}
               <span class="d-block" v-if="task.isEditedByAdmin">Отредактировано администратором</span>
           </div>
            <div v-if="isAuthorized" class="col-lg-2 col-sm-12">
                <div class="btn-group-vertical">
                    <edit-task-form v-model="task"></edit-task-form>
                </div>
            </div>
        </div>
    </li>
</template>

<style scoped>
    .pre-formatted {
        white-space: pre;
    }
</style>

<script>
    import EditTaskForm from './edit-task-form.vue';

    export default {
        components: {
            EditTaskForm
        },
        props: {
            user: {
                type: Object,
                default: {
                    authorized: false
                }
            },
            value: {
                type: Object,
                default: {
                    id: Number,
                    userName: String,
                    email: String,
                    text: String,
                    isClosed: Boolean,
                    isEditedByAdmin: Boolean
                }
            }
        },
        data: function(){
            return {
                task: {
                    id: 0,
                    userName: '',
                    email: '',
                    text: '',
                    isClosed: false,
                    isEditedByAdmin: false
                }
            }
        },
        watch: {
            value: function(value){
                this.model = value;
            },
            task: function(value){
                this.$emit('input', value)
            }
        },
        computed: {
            status: function(){
                return (this.task.isClosed) ? 'Выполнено' : 'Открыта'
            },
            isGuest: function(){
                return !this.user.authorized;
            },
            isAuthorized: function(){
                return this.user.authorized;
            }
        },
        mounted() {
            this.task = this.value;
        }
    }
</script>