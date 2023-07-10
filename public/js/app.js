import { countryList } from "./countries.js"

(() => {
    'use strict'

    $('#datepickerFrom').datepicker();
    $('#datepickerTo').datepicker();

    $('#myTable').DataTable({

        scrollX: true,

    });

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })

})()

let select = document.getElementById('country')

if (select) {
    countryList.forEach((country) => {
        let option = document.createElement('option')
        // if (country === 'Latvia') {
        //     // option.setAttribute('selected', 'selected')
        //     option.selected = true
        // }
        option.value = country
        option.text = country
        select.appendChild(option)
    })
}