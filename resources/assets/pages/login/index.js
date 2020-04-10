import './index.scss';

Promise.all([
    import('modules/vue' /* webpackChunkName: "vue-module" */).then((a) => {return a.default})
]).then(([Vue]) => {
    new Vue({
        el: '#loginForm',
        data: {
            userName: '',
            password: ''
        },
        methods: {
            prepareData(){
                const data = new FormData;
                data.append('userName', this.userName);
                data.append('password', this.password);
                return data;
            },
            onSubmit: function(){
                this.$http.post(
                    '/login',
                    this.prepareData()
                ).then(() => {
                    window.location.href = '/'
                }).catch(err => {
                    this.$refs.form.setErrors(err.response.data.errors);
                })
            }
        }
    });
});