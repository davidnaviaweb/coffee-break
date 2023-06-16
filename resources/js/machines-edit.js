window.addEventListener('load', () => {
    machineProducts.init()
});

const machineProducts = {
    init: () => {
        const repeaterFields = document.querySelectorAll('.ucf-repeater-container');
        repeaterFields.forEach((repeaterField) => {
            machineProducts.initRepeater(repeaterField);
        })

        /* Register actions for buttons */
        // Add new product
        machineProducts.live('submit', '#addProduct', (event) => {
            event.preventDefault()
            machineProducts.addProduct(event.target);
        });
        // // Add row before
        // machineProducts.live('click', '.add-row-before', (event) => {
        //     const row = event.target.closest('.row');
        //     machineProducts.addRow(row, 'before');
        // })
        // // Remove row
        // machineProducts.live('click', '.remove-row', (event) => {
        //     const row = event.target.closest('.row');
        //     machineProducts.removeRow(row);
        // })
        // // Remove clone row on submit
        // machineProducts.live('submit', 'form', (event) => {
        //     document.querySelectorAll('.row-clone').forEach((item) => {
        //         item.parentNode.removeChild(item)
        //     })
        // })
    },
    addProduct: (form) => {

        let passed = true
        // form.querySelectorAll('select, input').each((element) => {
        //     if (!machineProducts.validate(element)) passed = false
        // })

        if (!passed) return

        form.querySelector('button').disabled = true

        console.table(form)
        form.disabled = true
        form.classList.add('waiting')

        let data = new FormData(form)

        fetch(route('machines.addProduct'), {
            method: 'post',
            body: data,
            credentials: 'same-origin'
        }).then(response => {
            return response.text()
        }).then(response => {
            const resp = JSON.parse(response)
            if (resp.success) {
                get_report()
                window.setTimeout(() => {
                    document.querySelectorAll('.validation-errors').forEach((item) => item.innerHTML = '')
                    document.querySelector('#import_process_errors').style.display = 'none'
                    document.querySelector('#import_process_errors').textContent = ''
                    form.disabled = false
                    form.classList.remove('waiting')
                }, 2000)
            }
        }).catch(function () {
        }).finally(function () {
        })

    },
    // validate: (element) => {
    //     Number.isInteger(element.value) && element.value > 0
    // },
    live: (eventType, elementQuerySelector, callback) => {
        document.addEventListener(eventType, function (event) {
            const items = document.querySelectorAll(elementQuerySelector);
            if (items) {
                let el = event.target, index = -1;
                while (el && ((index = Array.prototype.indexOf.call(items, el)) === -1)) {
                    el = el.parentElement;
                }
                if (index > -1) {
                    callback.call(el, event);
                }
            }
        });
    }
};