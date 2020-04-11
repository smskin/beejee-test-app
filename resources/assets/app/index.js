import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Promise.all([
    import('jquery' /* webpackChunkName: "jquery" */).then((a) => {return a.default}),
    import('modules/user' /* webpackChunkName: "user-module" */).then((a) => {return a.default})
]).then(([jQuery, Bootstrap, User]) => {

});
