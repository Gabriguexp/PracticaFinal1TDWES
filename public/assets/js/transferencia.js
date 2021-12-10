var btn = document.getElementById('transferenciabtn')
var checkboxes = document.querySelectorAll('.checkbox')
var edit = false
var submit = document.getElementById('submit')
var select = document.getElementById('form-selector')
var checkAllBtn = document.getElementById('check-all')
var unCheckAllBtn = document.getElementById('uncheck-all')
var thead = document.getElementById('thead-transferir')
console.log(thead)
btn.addEventListener('click', function(){
    edit = !edit
    if (edit){
        btn.classList.remove('btn-primary')
        btn.classList.add('btn-secondary')
        btn.value="Cancelar edición"
        checkboxes.forEach(element => element.classList.remove('hidden'))
        submit.classList.remove('hidden')
        select.classList.remove('hidden')
        checkAllBtn.classList.remove('hidden')
        unCheckAllBtn.classList.remove('hidden')
        thead.classList.remove('hidden')
    } else {
        btn.classList.add('btn-primary')
        btn.classList.remove('btn-secondary')
        btn.value="Habilitar edición"
        submit.classList.add('hidden')
        select.classList.add('hidden')
        checkboxes.forEach(element => element.checked = false)
        checkboxes.forEach(element => element.classList.add('hidden'))
        checkAllBtn.classList.add('hidden')
        unCheckAllBtn.classList.add('hidden')
        thead.classList.add('hidden')
    }
    
})

checkAllBtn.addEventListener('click', function(){
    checkboxes.forEach(element => element.checked = true)

})

unCheckAllBtn.addEventListener('click', function(){
    checkboxes.forEach(element => element.checked = false)

})