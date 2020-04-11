export const User = {
    authorized: false
};

const event = new CustomEvent('userLoaded', {
    detail: User
});

let axios;

function loadData(){
    axios.post(
        '/api/auth/status'
    ).then((response) => {
        window.userLoaded = true;
        User.authorized = response.data.authorized;
        document.dispatchEvent(event);
    })
}

Promise.all([
    import('modules/axios' /* webpackChunkName: "axios-module" */).then((a) => {return a.default})
]).then(([Axios]) => {
    axios = Axios;
    loadData();
});

document.addEventListener('logout', () => {
    loadData();
}, false);