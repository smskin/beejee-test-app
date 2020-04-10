import Vue from 'vue';
import { ValidationProvider, ValidationObserver } from 'vee-validate';
import { extend } from 'vee-validate';
import * as rules from 'vee-validate/dist/rules';
import { messages } from 'vee-validate/dist/locale/ru.json';
import { configure } from 'vee-validate';
import axios from './axios';

Vue.prototype.$http = axios;

Vue.component('validation-provider', ValidationProvider);
Vue.component('validation-observer', ValidationObserver);
Object.keys(rules).forEach(rule => {
    extend(rule, {
        ...rules[rule], // copies rule configuration
        message: messages[rule] // assign message
    });
});
configure({
    classes: {
        valid: 'is-valid',
        invalid: 'is-invalid',
        dirty: ['is-dirty', 'is-dirty'], // multiple classes per flag!
        // ...
    }
});

export default Vue;
