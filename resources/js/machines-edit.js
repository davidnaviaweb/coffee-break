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
        // Remove row
        machineProducts.live('click', '.actions .edit', (event) => {
            const row = event.target.closest('tr')
            const modal = document.getElementById('edit-machine-product')

            const name = row.querySelector('.name').innerText
            const price = row.querySelector('.price').innerText
            const stock = row.querySelector('.stock').innerText
            modal.querySelector('.name').innerText = name
            modal.querySelector('input[name=machine_id]').value = row.dataset.machine
            modal.querySelector('input[name=product_id]').value = row.dataset.product
            modal.querySelector('input[name=price]').value = price
            modal.querySelector('input[name=stock]').value = stock
        })
        machineProducts.live('click', '.update-product', (event) => {
            event.preventDefault()
            machineProducts.updateProduct(event.target);
        })

        machineProducts.live('click', '.actions .delete', (event) => {
            event.preventDefault()
            machineProducts.removeProduct(event.target);
        })
        // // Remove clone row on submit
        // machineProducts.live('submit', 'form', (event) => {
        //     document.querySelectorAll('.row-clone').forEach((item) => {
        //         item.parentNode.removeChild(item)
        //     })
        // })
    },
    addProduct: (form) => {
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
                let newRow = document.getElementById('product-row').content.cloneNode(true).querySelector('tr');

                fields.forEach((field, index) => {
                    const cell = newRow.querySelector('#product-row-' + field);
                    if (cell !== null) {
                        if (field === 'image') {
                            cell.querySelector('img').src = values[index]
                        } else {
                            cell.innerText = values[index]
                        }
                        cell.id = '';
                        cell.classList.add(field)
                    }
                })
                newRow.dataset.product = resp.success['product_id']
                newRow.dataset.csrf = resp.success['csrf']
                document.getElementById('machine-products-table').getElementsByTagName('tbody')[0].appendChild(newRow);
            }
        }).catch(error => {
            console.log(error)
        }).finally(() => {
            form.disabled = false;
            form.classList.remove('waiting')
            form.querySelector('button').disabled = false
        })
    },
    updateProduct: (button) => {
        button.disabled = true
        const form = button.closest('#form-container').querySelector('form')
        form.disabled = true
        form.classList.add('waiting')
        form.querySelectorAll('input').forEach((input) => {
            input.classList.add('border-gray-300')
            input.classList.remove('border-red-500')
            input.parentElement.querySelector('p').innerText = ''
        })
        let data = new FormData(form)
        data.append('_method', 'patch')

        fetch(route('machines.updateProduct'), {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': button.dataset.csrf,
            },
            body: data,
            dataType: 'json',
            credentials: 'same-origin'
        }).then(response => {
            return response.text()
        }).then(response => {
            const resp = JSON.parse(response)
            console.log(resp)
            if (resp.error) {
                console.log(resp.error)
            } else {
                const row = document.querySelector('tr[data-product="' + data.get('product_id')  + '"]');
                row.querySelector('.price').innerHTML = resp.success.price
                row.querySelector('.stock').innerHTML = resp.success.stock
                form.parentNode.querySelector('.cancel').click();
            }
        }).catch(error => {
            console.log(error)
        }).finally(() => {
            form.disabled = false
            form.classList.remove('waiting')
            button.disabled = false
        })
    },
    removeProduct: (button) => {
        button.disabled = true
        let data = new FormData()
        data.append('product_id', button.dataset.product)
        data.append('machine_id', button.dataset.machine)
        data.append('_method', 'delete')
        fetch(route('machines.deleteProduct'), {
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': button.dataset.csrf,
            },
            body: data,
            dataType: 'json',
            credentials: 'same-origin'
        }).then(response => {
            return response.text()
        }).then(response => {
            const resp = JSON.parse(response)
            console.log(resp)
            if (resp.error) {
            } else {
                const row = button.closest('tr');
                row.parentNode.removeChild(row);
            }
        }).catch(error => {
            console.log(error)
        }).finally(() => {
            button.disabled = false
        })
    },
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