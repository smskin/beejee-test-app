<template>
   <div class="root">
       <!-- Button trigger modal -->
       <button type="button" class="btn btn-primary" v-on:click="showModal">Редактировать</button>

       <!-- Modal -->
       <b-modal
               ref="modal"
               title="Редактирование задачи"
               :hide-footer="true"
       >
           <validation-observer ref="form" v-slot="{ handleSubmit }" slim>
               <form @submit.prevent="handleSubmit(onSubmit)">
                   <div class="modal-body">
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
                       <div class="form-check">
                           <!--suppress HtmlFormInputWithoutLabel -->
                           <input v-model="isClosed" class="form-check-input" type="checkbox">
                           <label class="form-check-label">
                               Задача закрыта
                           </label>
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" v-on:click="closeModal">Close</button>
                       <button class="btn btn-primary" type="submit">Сохранить изменения</button>
                   </div>
               </form>
           </validation-observer>
       </b-modal>
   </div>
</template>

<style scoped>
    .root {
        display: inline-block;
    }
</style>

<script>
    export default {
        props: {
            value: {
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
        data: function(){
            return {
                text: '',
                isClosed: false
            }
        },
        watch: {
            value: function(){
                this.fillData();
            }
        },
        methods: {
            showModal: function(){
                this.$refs.modal.show();
            },
            closeModal: function(){
                this.$refs.modal.hide();
            },
            onSubmit(){
                this.$http.post(
                    '/api/tasks/' + this.value.id,
                    this.prepareData()
                ).then((response) => {
                    this.$emit('input', response.data);
                    this.closeModal();
                    this.$bvToast.toast(`Задача успешно обновлена`, {
                        title: 'Успех',
                        autoHideDelay: 5000
                    })
                }).catch((e) => {
                    if (e.response.status === 401) {
                        this.$bvToast.toast(`Необходима авторизация (401)`, {
                            title: 'Ошибка',
                            autoHideDelay: 5000
                        })
                    }
                })
            },
            prepareData(){
                const formData = new FormData;
                formData.append('text', this.text);
                formData.append('isClosed', (this.isClosed) ? '1' : '0');
                return formData;
            },
            fillData(){
                this.text = this.value.text;
                this.isClosed = this.value.isClosed
            }
        },
        mounted() {
            this.fillData();
        }
    }
</script>