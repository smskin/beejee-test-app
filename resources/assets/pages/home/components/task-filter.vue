<template>
    <div class="form-group">
        <label>Фильтрация</label>
        <!--suppress HtmlFormInputWithoutLabel -->
        <select v-model="model">
            <option v-for="option in options" :value="option.value">{{ option.text }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: {
            value: {
                type: String,
                default: 'userName'
            }
        },
        data: function(){
            return {
                model: '',
                options: [
                    {
                        value: 'userName',
                        text: 'По имени пользователя'
                    },
                    {
                        value: 'email',
                        text: 'По e-mail'
                    },
                    {
                        value: 'status',
                        text: 'По статусу'
                    }
                ]
            }
        },
        watch: {
            model: function(value){
                this.$emit('input', value);
            },
            value: function(value){
                this.model = value;
            }
        },
        mounted() {
            this.model = this.value;
        }
    }
</script>