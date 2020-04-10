import "bootstrap/dist/css/bootstrap.min.css";

Promise.all([
    import('jquery' /* webpackChunkName: "jquery" */).then((a) => {return a.default}),
    import('bootstrap' /* webpackChunkName: "bootstrap" */).then((a) => {return a.default}),
]).then(([jQuery]) => {

});
