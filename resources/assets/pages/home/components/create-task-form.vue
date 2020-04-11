<template>
    <validation-observer ref="form" v-slot="{ handleSubmit }" slim>
        <form @submit.prevent="handleSubmit(onSubmit)">
            <div class="form-group">
                <label>Имя пользователя</label>
                <validation-provider vid="userName" name="имя пользователя" v-slot="{ errors, classes }" rules="required" tag="div" slim>
                    <!--suppress HtmlFormInputWithoutLabel -->
                    <input
                            v-model="userName"
                            class="form-control"
                            placeholder="Имя пользователя"
                            :class="classes"
                            autofocus>
                    <span class="invalid-feedback" role="alert">{{ errors[0] }}</span>
                </validation-provider>
            </div>
            <div class="form-group">
                <label>E-mail</label>
                <validation-provider vid="email" name="E-mail" v-slot="{ errors, classes }" rules="required|email" tag="div" slim>
                    <!--suppress HtmlFormInputWithoutLabel -->
                    <input
                            v-model="email"
                            class="form-control"
                            placeholder="E-mail"
                            :class="classes">
                    <span class="invalid-feedback" role="alert">{{ errors[0] }}</span>
                </validation-provider>
            </div>
            <div class="form-group">
                <label>Текст задачи</label>
                <validation-provider vid="text" name="текст задачи" v-slot="{ errors, classes }" rules="required" tag="div" slim>
                    <!--suppress HtmlFormInputWithoutLabel -->
                    <textarea
                            v-model="text"
                            class="form-control"
                            placeholder="Текст задачи"
                            :class="classes"></textarea>
                    <span class="invalid-feedback" role="alert">{{ errors[0] }}</span>
                </validation-provider>
            </div>
            <button class="btn btn-primary" type="submit">Создать задачу</button>
        </form>
    </validation-observer>
</template>

<script>
    export default {
        data: function(){
            return {
                userName: '',
                email: '',
                text: ''
            }
        },
        methods: {
            prepareData(){
                const formData = new FormData;
                formData.append('userName', this.userName);
                formData.append('email', this.email);
                formData.append('text', this.text);
                return formData;
            },
            onSubmit: function(){
                this.$http.post(
                    '/api/tasks',
                    this.prepareData()
                ).then((response) => {
                    this.$emit('task-created', response.data);
                    this.showToast();
                    this.userName = '';
                    this.email = '';
                    this.text = '';
                }).catch(err => {
                    this.$refs.form.setErrors(err.response.data.errors);
                })
            },
            showToast(){
                this.$bvToast.toast(`Задача успешно добавлена`, {
                    title: 'Успех',
                    autoHideDelay: 5000
                })
            }
        }
    }
</script>