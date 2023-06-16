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

        // let passed = true
        // // form.querySelectorAll('select, input').each((element) => {
        // //     if (!machineProducts.validate(element)) passed = false
        // // })
        //
        // if (!passed) return

        form.querySelector('button').disabled = true
        form.disabled = true
        form.classList.add('waiting')
        form.querySelectorAll('input, select').forEach((input) => {
            input.classList.add('border-gray-300')
            input.classList.remove('border-red-500')
            input.parentElement.querySelector('p').innerText = ''
        })

        let data = new FormData(form)

        fetch(route('machines.addProduct'), {
            method: 'post',
            body: data,
            credentials: 'same-origin'
        }).then(response => {
            return response.text()
        }).then(response => {
            const resp = JSON.parse(response)
            if (resp.error) {
                console.log(resp.error)
                const fields = Object.keys(resp.error)
                const msgs = Object.values(resp.error)
                fields.forEach((field, index) => {
                    const input = form.querySelector('*[name="' + field + '"]')
                    input.classList.remove('border-gray-300')
                    input.classList.add('border-red-500')
                    input.parentElement.querySelector('p').innerText = msgs[index][0]
                })
            } else {
                const fields = Object.keys(resp.success)
                const values = Object.values(resp.success)
                let newRow = document.getElementById('product-row').content.cloneNode(true);

                fields.forEach((field, index) => {
                    const cell = newRow.querySelector('#product-row-' + field);
                    if (cell !== null) {
                        if (field === 'image') {
                            cell.querySelector('img').src = values[index]
                        } else {
                            cell.innerText = values[index]
                        }
                    }
                })

                document.getElementById('machine-products-table').getElementsByTagName('tbody')[0].appendChild(newRow);
            }
        }).catch(error => {
            console.log(error)
        }).finally(() => {
            form.querySelector('button').disabled = false
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