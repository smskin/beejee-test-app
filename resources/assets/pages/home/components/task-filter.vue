<template>
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <!--suppress HtmlFormInputWithoutLabel -->
            <select class="custom-select" v-model="mFilter">
                <option v-for="option in filterOptions" :value="option.value">{{ option.text }}</option>
            </select>
        </div>
        <div class="col-lg-6 col-sm-12">
            <!--suppress HtmlFormInputWithoutLabel -->
            <select class="custom-select" v-model="mFilterDirect">
                <option v-for="option in directOptions" :value="option.value">{{ option.text }}</option>
            </select>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            filter: {
                type: String,
                default: 'userName'
            },
            filterDirect: {
                type: String,
                default: 'asc'
            }
        },
        data: function(){
            return {
                mFilter: 'userName',
                filterOptions: [
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
                ],
                mFilterDirect: 'asc',
                directOptions: [
                    {
                        value: 'asc',
                        text: 'По возрастанию'
                    },
                    {
                        value: 'desc',
                        text: 'По убыванию'
                    },
                ]
            }
        },
        watch: {
            mFilter: function(){
               this.emitModel();
            },
            mFilterDirect: function(){
                this.emitModel();
            },
            filter: function(value){
                this.mFilter = value;
            },
            filterDirect: function(value){
                this.mFilterDirect = value;
            }
        },
        methods: {
            emitModel(){
                this.$emit('input', {
                    filter: this.mFilter,
                    filterDirect: this.mFilterDirect
                })
            }
        },
        mounted() {
           this.mFilter = this.filter;
           this.mFilterDirect = this.filterDirect;
        }
    }
</script>