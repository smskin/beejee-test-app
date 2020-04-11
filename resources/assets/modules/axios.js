import axios from 'axios';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};

// axios.interceptors.response.use((response) => {
//     return response;
// }, function (error) {
//     // Do something with response error
//     if (error.response.status === 401) {
//         this.$bvToast.toast(`Необходима авторизация (401)`, {
//             title: 'Ошибка',
//             autoHideDelay: 5000
//         })
//     }
//     if (error.response.status === 403) {
//         this.$bvToast.toast(`Доступ запрещен (403)`, {
//             title: 'Ошибка',
//             autoHideDelay: 5000
//         })
//     }
//     if (error.response.status === 404) {
//         this.$bvToast.toast(`Адрес не найден (404)`, {
//             title: 'Ошибка',
//             autoHideDelay: 5000
//         })
//     }
//     return Promise.reject(error.response);
// });

export default axios;
