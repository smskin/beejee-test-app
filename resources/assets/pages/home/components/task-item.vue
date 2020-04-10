<template>
    <li class="list-group-item">
        ID: {{ task.id }}<br />
        User name: {{ task.userName }}<br />
        E-mail: {{ task.email }}<br />
        Статус: {{ status }}<br />
        Text: {{ task.text }}
    </li>
</template>

<script>
    export default {
        props: {
            task: {
                type: Object,
                default: {
                    id: Number,
                    userName: String,
                    email: String,
                    text: String,
                    isClosed: Boolean
                }
            }
        },
        computed: {
            status: function(){
                return (this.task.isClosed) ? 'Закрыта' : 'Открыта'
            }
        }
    }
</script>