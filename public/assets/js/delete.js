//iife -> expresión de función inmediatamente invocada
(function () {

    let modalDelete = document.getElementById('modalDelete');
    let span = document.getElementById('deleteData');
    modalDelete.addEventListener('show.bs.modal', function (event) {
        let element = event.relatedTarget;
        let action = element.getAttribute('data-url');
        let name = element.getAttribute('data-name');
        console.log(name)
        span.innerHTML = name;
        let form = document.getElementById('modalDeleteResourceForm');
        form.action = action;
    });
})();

